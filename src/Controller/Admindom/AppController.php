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
namespace App\Controller\Admindom;

use App\Traits\XmlTrait;
use Cake\Controller\Controller;
use Cake\Event\Event;

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
    use XmlTrait;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('colorAdmin');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $this->loadComponent('Cookie');

        $this->set('site_locale', 'uk');
        $this->Cookie->config([
            'expires' => '+10 days',
            'httpOnly' => false,
            'key'=>'@qgm@rq290i92q3fnverjfmwaeidfse9@jgf9034j0g@vns@09enf[an@oiw4nth9048ngna@wnf8na8g2ivierni',
        ]);


//        $this->loadModel('Projects');
//        $this->Projects->updateSlugs();



    }

    public function beforeFilter(Event $event) {
        if (strpos($this->request->prefix, 'admin') !== false) {
            $this->Auth->config([
                'loginRedirect' => [
                    'controller' => 'Admin',
                    'action' => 'dashboard'
                ],
                'logoutRedirect' => [
                    'prefix' => 'admindom',
                    'controller' => 'Admin',
                    'action' => 'login',
                ],
                'loginAction' => [
                    'controller' => 'Admin',
                    'action' => 'login',
                ],
                'authenticate' => [
                    'Form' => [
                        'passwordHasher' => 'Default',
                        'fields' => ['username' => 'login', 'password' => 'pass'],
                        'userModel' => 'Admins',
                    ]
                ],
                'storage' => [
                    'className' => 'Session',
                    'key' => 'Auth.Admin',
                ],
                'flash' => [
                    'key' => 'auth',
                    'element' => 'error',
                ],
                'authError' => 'You are not authorized to access this page.'
            ]);

            $user = $this->Auth->user();
            if($user && !empty($user)){
                $session = $this->request->session();
                $session->write('KCEDITOR.disabled', false);

            }
//            $session = $this->request->session();
//            $name = $session->read();
//            debug($session); die;
            $this->loadModel('Forms');
            $orders_forms_sidebar_count = $this->Forms->find('all')->where(['viewed' => 0])->count();



            $this->set(compact(['user', 'orders_forms_sidebar_count']));
        }
    }


}