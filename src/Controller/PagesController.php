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

use Cake\Network\Exception\NotFoundException;
use Cake\Mailer\Email;
use App\Helpers\ProjectPriceHelper;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Projects');
        $this->loadModel('Prices');
    }

    public function index()
    {
        $session = $this->request->session();
        if ($session->check('loader')) {
            $this->set('showLoader', false);
        } else {
            $this->set('showLoader', true);
            $session->write('loader', true);
        }

        $this->set('page', $this->Pages->getByName('home'));

        $this->loadModel('Posts');
        $this->set('last_posts', $this->Posts->getLastsPublishedPostsToHome());
    }


    public function aboutUs()
    {
        $this->set('page', $this->Pages->getByName('about_us'));
//        $this->Pages->getByName('about_us')->getContentField(['jj']);
//        die;
    }

    public function contacts()
    {
        $this->set('page', $this->Pages->getByName('contacts'));
//        $this->Pages->getByName('contacts')->getContentField(['jj']);
//        die;
    }

    public function invest()
    {

    }


    public function getPrj()
    {


    }

    public function category()
    {
        $this->set('page', $this->Pages->getByName('projects'));

        $this->loadModel('Categories');
        $category = $this->Categories->find('all')
            ->where(['slug_'.$this->lang => $this->request->param('category_slug')])
            ->contain(['CategoriesProjects.Projects.Photos' => function ($q) {
                return $q->order(['Photos.sort' => 'DESC']);
            }])
            ->first();
        if (empty($category)) {
            throw new NotFoundException('Project not found', 404);
        }
        $price_lang='price_uk';

        $this->set('active_category', $category);

        $lower_price_r = $this->Prices
            ->find('all')
            ->order([$price_lang => 'ASC'])
            ->first();

        $projects = [];
        foreach ($category->categories_projects as $categories_project) {
            $project = $categories_project->project;

            $pricesArray = json_decode($project->prices, true);
            $filteredPrices = array_map('intval', $pricesArray);

            $lower_price_r = $this->Prices
                ->find('all')
                ->where(['id IN' => $filteredPrices])
                ->order(['price_uk' => 'ASC'])
                ->first();
            $lower_price_uk = $this->Prices
                ->find('all')
                ->where(['id IN' => $filteredPrices])
                ->order(['price_uk' => 'ASC'])
                ->first();
            $price_in=$lower_price_r->$price_lang != 0 ? $lower_price_r->$price_lang : $lower_price_uk->price_uk;
            $project->price = ($project->area * $price_in) ;
            $project->price = ProjectPriceHelper::getPrice($project->price);
            $projects[] = $project;
        }
        usort($projects, function($a, $b) {
            return $b->modified - $a->modified;
        });
        $this->loadModel('Categories');
        $categories = $this->Categories->find('all')
            ->contain('CategoriesProjects')
            ->order(['Categories.sort' => 'ASC']);



        $this->set(compact(['projects', 'categories']));
        $this->render('projects');
    }

    public function projects()
    {
        $this->set('page', $this->Pages->getByName('projects'));
$price_lang='price_uk';
        $projects = $this->Projects
            ->find('all')
            ->contain(['Photos' => function ($q) {
                return $q->order(['Photos.sort' => 'DESC']);
            }])
            ->order(['modified' => 'DESC']);

        foreach ($projects as $project) {
            $pricesArray = json_decode($project->prices, true);
            $filteredPrices = array_map('intval', $pricesArray);

            $lower_price_r = $this->Prices
                ->find('all')
                ->where(['id IN' => $filteredPrices])
                ->order(['price_uk' => 'ASC'])
                ->first();
            $lower_price_uk = $this->Prices
                ->find('all')
                ->where(['id IN' => $filteredPrices])
                ->order(['price_uk' => 'ASC'])
                ->first();
            $price_in=$lower_price_r->$price_lang != 0 ? $lower_price_r->$price_lang : $lower_price_uk->price_uk;
            $project->price = ($project->area * $price_in);
            $project->price = ProjectPriceHelper::getPrice($project->price);
        }

        $this->loadModel('Categories');
        $categories = $this->Categories->find('all')
            ->contain('CategoriesProjects')
            ->order(['Categories.sort' => 'ASC']);

        $this->set(compact(['projects', 'categories']));
    }

    public function project($str = null)
    {
        $project = $this->Projects->findBySlug($str);
        if (empty($project)) {
            $id = explode('_', $str);
            $id = $id[count($id) - 1];
            if ($this->Projects->exists(['Projects.id' => $id])) {
                $project = $this->Projects->get($id);
                return $this->redirect($project->href, 301);
            }
            throw new NotFoundException('Project not found', 404);
        }


        $prices = $this->Prices
            ->find('all')
            ->order(['name' => 'ASC']);

        $project_modal = true;


        $this->set(compact(['project', 'prices', 'project_modal']));
        $this->set('page', $this->Pages->getByName('projects'));
    }

    public function gallery()
    {
        $this->loadModel('Gallery');

        $galleries = $this->Gallery->find('all')
            ->contain('GalleryCategories')
            ->order(['created' => 'DESC']);
        $categories_ids = [];
        foreach ($galleries as $gallery) {
            if (!in_array($gallery->gallery_category_id, $categories_ids)) {
                $categories_ids[] = $gallery->gallery_category_id;
            }
        }
        $categories = [];
        if (!empty($categories_ids)) {
            $this->loadModel('GalleryCategories');
            $categories = $this->GalleryCategories->find('all')
                ->where(['GalleryCategories.id IN' => $categories_ids])
                ->order(['GalleryCategories.sort' => 'ASC']);
        }

        $this->set('page', $this->Pages->getByName('gallery'));
        $this->set('galleries', $galleries);
        $this->set('categories', $categories);
    }

    private function setType($type, $data)
    {
        $types = [
             'formAbout' => 'Форма (Про нас)',
            'formContact' => 'Форма зв\'язку (Контакти)',
            'formPhone' => 'Форма (Телефон)',
            'formProject' => 'Форма (Тур) ',
        ];

        if (array_key_exists($type, $types)) {
            $data['type'] = $types[$type];
        } else {
            $data['type'] = 'Загальна форма';
        }
        if (!empty($data['projectName']) && $type == 'formProject') {
            $data['type'] .= $data['projectName'] . ')';
        }
        $data['type'] .= ' ('.$this->lang.')';



        return $data;
    }

    private function sendEmail($data)
    {
        $this->loadModel('Config');
        $configs = $this->Config->getConfigs();
        $to = (!empty($configs['email_contact'][0])) ? $configs['email_contact'][0] : 'info.voyage@gmail.com';
        $email_user = new Email();
        $email_user
            ->template('form', 'default')
            ->emailFormat('html')
            ->from(['voyage@site' => 'VoyageVista'])
            ->viewVars(['data' => $data])
            ->to($to)
            ->subject('Нова заявка')
            ->send();
    }

    private function setToBD($data)
    {
        $this->loadModel('Forms');
        $form = $this->Forms->newEntity($data);
        $this->Forms->save($form);
    }


    public function getDocument($type = null)
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            extract($data);
            if (!empty($phone)) {
                $data = $this->setType($type, $data);
                $this->sendEmail($data);
                $this->setToBD($data);
                $section = 'document_src';
                if($this->lang !== 'uk') {
                    $section = $section.'_'.$this->lang;
                }
                $conf = $this->Config->findBySection($section)->first();
                if(empty($conf) && $this->lang !== 'uk' ) {
                    $conf = $this->Config->findBySection('document_src')->first();
                }
                if (!empty($conf)) {
                    $this->response->body(json_encode(['error' => false, 'src' => $conf->value]));
                    $this->response->statusCode(200);
                    return $this->response;
                }
            }
        }
        $this->response->body(json_encode(['error' => true]));
        $this->response->statusCode(200);
        return $this->response;
    }

    public function googleRecaptchaVerify($data)
    {
        if (!$data["g-recaptcha-response"]) {
            return false;
        } else {
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $query = array(
                "secret" => '6LcvACspAAAAAIFd8UBCHl4BilJ1py3m4CDnzOcC',
                "response" => $data["g-recaptcha-response"],
                "remoteip" => $_SERVER['REMOTE_ADDR']
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
            $data = json_decode(curl_exec($ch), $assoc=true);
            curl_close($ch);

            if (!$data['success']) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function sendForm($type = null)
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if(!$this->googleRecaptchaVerify($data)) {
                return $this->redirect($this->referer());
            }
            unset($data['g-recaptcha-response']);
            extract($data);
            if (isset($phone)) {
                $data = $this->setType($type, $data);
                $this->sendEmail($data);
                $this->setToBD($data);
                return $this->niceRedirect('/thanks');
//                $this->response->body(json_encode(['error' => false]));
//                $this->response->statusCode(200);
//                return $this->response;
            }
            debug(22); die;

        }
        debug(22); die;

        $this->response->body(json_encode(['error' => true]));
        $this->response->statusCode(200);
        return $this->response;
    }

    public function thanks()
    {
        $this->set('page', $this->Pages->getByName('thanks'));

    }




}
