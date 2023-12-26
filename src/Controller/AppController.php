<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Network\Exception\NotFoundException;
use App\Helpers\StaticValuesHelper;
use App\Traits\XmlTrait;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $lang = 'uk';
    public $blog_on = true;

    private function bot_detected() {
        if(in_array($_SERVER['REMOTE_ADDR'], ['66.249.93.11', '66.249.93.9'])) {
            return true;
        }
        file_put_contents(WWW_ROOT.'tmp.txt', json_encode($_SERVER));
        file_put_contents(WWW_ROOT.'tmp2.txt', $_SERVER['REMOTE_ADDR']);
        return (
            isset($_SERVER['HTTP_USER_AGENT'])
            && preg_match('/bot|googlebot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
        );
    }

    public function initialize()
    {
        parent::initialize();

//        debug('error'); die;
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadModel('Config');
        $configs = $this->Config->getConfigs();

        $this->set(compact('configs'));
        StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations'] = false;


        $this->setLang();
//        if(in_array($_SERVER['REMOTE_ADDR'], ['94.231.78.3'])) {
//            $br_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//            debug($_SERVER);
//            debug($br_lang);
//        }
//        if(!$this->bot_detected()){
//            $this->redirectToLang();
//        }

        $this->set('blog_on', $this->blog_on);
    }

    private function setLang()
    {
        $lang_query = $this->request->param('lang');
        if (!empty($lang_query)) {
            if (in_array($lang_query, ['ru', 'en', 'de', 'pl'])) {
                $this->lang = $lang_query;
            } else {
                return $this->redirect('/', '301');
            }
        }
        I18n::locale($this->lang);
        $this->set('lang', $this->lang);
    }

    private function setLayoutPage()
    {
        $this->loadModel('Pages');
        $layout_page = $this->Pages->getByName('layout');
        $this->set('layout_page', $layout_page);
    }

    public function niceRedirect($url)
    {
        if(empty($this->lang) || $this->lang == 'uk') {
            return $this->redirect($url);
        }
        return $this->redirect('/'.$this->lang.$url);
    }


    public function beforeRender(Event $event)
    {
        $this->setLayoutPage();

        $this->loadModel('PostsCategories');
        $this->set('blog_category', $this->PostsCategories->getFirstPublishedCategory());

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    private function redirectToLang()
    {
        if(!isset($_COOKIE['lang_cook'])) {
            $br_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (in_array($br_lang, ['ru', 'en', 'de', 'uk', 'pl'])) {
                setcookie("lang_cook", $br_lang, time()+3600);
                $_COOKIE['lang_cook'] = $br_lang;
            }
        }
        $denyed_actions = [
            'Pages' => ['project' => 1, 'post' => 1, 'blog' => 1],
        ];
        if (strpos($this->referer(), DOMAIN) === false) {
            if (isset($_COOKIE['lang_cook']) && $_COOKIE['lang_cook'] !== $this->lang) {
                $lang_cookie = $_COOKIE['lang_cook'];
                $href = $this->request->here;
                if ($this->lang !== 'uk') {
                    $href = substr($href, 3);
                }
                if ($lang_cookie !== 'uk') {
                    $redirect = ($href !== '/') ? '/' . $lang_cookie . $href : '/' . $lang_cookie;
                } else {
                    $redirect = $href;
                }
                if (isset($denyed_actions[$this->request->param('controller')][$this->request->param('action')])) {
                    if($this->request->param('action') == 'blog') {
                        $this->loadModel('PostsCategories');
                        $posts_categories = $this->PostsCategories->getPublishedCategories();
                        $category_slug = $this->request->param('category_slug');
                        if (!$category_slug) {
                            foreach ($posts_categories as $category) {
                                return $this->redirect($category->href, 301);
                            }
                        }
                        $category = $this->PostsCategories->findBySlug($category_slug);
                        if (empty($category)) {
                            throw new NotFoundException(__('Category not found'));
                        }
                        $redirect = '/'.$lang_cookie.$category->_getHref($lang_cookie);
                    }

                    if($this->request->param('action') == 'post') {
                        $this->loadModel('PostsCategories');
                        $posts_categories = $this->PostsCategories->getPublishedCategories();
                        $post_slug = $this->request->param('post_slug');
                        if (!$post_slug) {
                            foreach ($posts_categories as $category) {
                                return $this->redirect($category->href, 301);
                            }
                        }
                        $this->loadModel('Posts');
                        $post = $this->Posts->findBySlug($post_slug);
                        if (empty($post)) {
                            throw new NotFoundException('Post not found', 404);
                        }
                        $redirect = '/'.$lang_cookie.$post->_getHref($lang_cookie);
                    }
                    if($this->request->param('action') == 'project') {
                        $this->loadModel('Projects');
                        $project = $this->Projects->findBySlug($this->request->param('pass')[0]);
                        if (empty($project)) {
                            $id = explode('_', $this->request->param('pass')[0]);
                            $id = $id[count($id) - 1];
                            if ($this->Projects->exists(['Projects.id' => $id])) {
                                $project = $this->Projects->get($id);
                                return $this->redirect($project->href, 301);
                            }
                            throw new NotFoundException('Project not found', 404);
                        }
                        $redirect = '/'.$lang_cookie.$project->_getHref($lang_cookie);
                    }
                }
                if(empty($redirect)) {$redirect = '/';}
                return $this->redirect($redirect);
            }
            return false;
        }
        if (!isset($_COOKIE['lang_cook']) || $_COOKIE['lang_cook'] !== $this->lang) {
            setcookie("lang_cook", $this->lang, time()+3600);
        }
    }

}
