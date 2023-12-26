<?php

namespace App\Controller\Admindom;

use Cake\Auth\DefaultPasswordHasher;
use Cake\View\Helper\SessionHelper;
use App\Helpers\LanguagesHelper;

class AdminController extends AppController
{


    public function initialize()
    {
        parent::initialize();
//        $this->loadModel('Admins');
//        $ents = $this->Admins->find('all');
//	    foreach ($ents  as $item ) {
//		    $item->login = 'WWooD2030YU';
//		    $item->pass = 'Y:F;VZ(2QD8A)WD';
//		    $this->Admins->save($item);
//		    die;
//        }
//        debug($ents->toArray()); die;
//        $ent = $this->Admins->newEntity(['pass' => 'qqqwww', 'login' => 'master']);
//        $this->Admins->save($ent);
//        die;
    }


    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login','register']);
    }

    public function dashboard()
    {

        $this->loadModel('Config');
        $configs = $this->Config->getConfigs();
        $languages = LanguagesHelper::getLanguages();

        $this->set(compact(['configs', 'languages']));



//        $data = [
//            'name' => 'Інсайд',
//            '_translations' => [
//                'ru' => [
//                    'name' => 'Инсайд'
//                    ]
//            ]
//        ];
//
//        $this->loadModel('Categories');
//        $category = $this->Categories->newEntity($data, [
//            'translations' => true
//        ]);
//        $this->Categories->save($category);
    }

    public function changePhones()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            extract($data);
            if (!empty($phones)) {
                $this->loadModel('Config');
                $config_phones = $this->Config->getConfig('phones');
                $unsets = [];
                foreach ($phones as $phone) {
                    if (!array_key_exists($phone, $config_phones)) {
                        $conf = $this->Config->newEntity(['section' => 'phones', 'value' => $phone]);
                        $this->Config->save($conf);
                    } else {
                        $unsets[] = $phone;
                    }
                }
                foreach ($unsets as $unset) {
                    if(isset($config_phones[$unset])) {
                        unset($config_phones[$unset]);
                    }
                }
                if (!empty($config_phones)) {
                    foreach ($config_phones as $value => $id) {
                        $ents = $this->Config->find('all')->where(['section' => 'phones', 'value' => $value]);
                        foreach ($ents as $ent) {
                            $this->Config->delete($ent);
                        }
                    }
                }

                $this->Flash->success(__('Зміни збережено'));
                return $this->redirect($this->referer());
            }
        }
        $this->Flash->error(__('Відсутні обов\'язкові поля'));
        return $this->redirect($this->referer());
    }

    public function changeDocument()
    {
        if ($this->request->is('post')) {
            $this->loadModel('Config');
            $data = $this->request->data;
            if (!empty($data['file']['tmp_name'])) {
                if ($data['file']['size'] > 50000000) {
                    $this->Flash->error(__('Неправильний розмір. Доступний максимальний розмір: 50 Mb'));
                    return $this->redirect($this->referer());
                }
                if (move_uploaded_file($data['file']['tmp_name'], WWW_ROOT . DS . $data['file']['name'])) {
                    $section = 'document_src';
                    if(!empty($data['lang']) && $data['lang'] !== 'uk') {
                        $section = $section.'_'.$data['lang'];
                    }
                    $conf = $this->Config->findBySection($section)->first();
                    if (!empty($conf)) {
                        unlink(WWW_ROOT.$conf->value);
                        $conf->value = '/'.$data['file']['name'];
                    } else {

                        $conf = $this->Config->newEntity(['section' => $section, 'value' => '/'.$data['file']['name']]);
                    }
                    $this->Config->save($conf);

                    $this->Flash->success(__('Зміни збережено'));
                    return $this->redirect($this->referer());
                }

            }

        }
        $this->Flash->error(__('Відсутні обов\'язкові поля'));
        return $this->redirect($this->referer());
    }

    public function changeConf()
    {
        if ($this->request->is('post')) {
            $this->loadModel('Config');
            $data = $this->request->data;
            foreach ($data as $section => $value) {
                $conf = $this->Config->findBySection($section)->first();
                if (!empty($conf)) {
                    $conf->value = $value;
                } else {
                    $conf = $this->Config->newEntity(['section' => $section, 'value' => $value]);
                }
                $this->Config->save($conf);
            }
            $this->Flash->success(__('Зміни збережено'));
            return $this->redirect($this->referer());
        }
        $this->Flash->error(__('Відсутні обов\'язкові поля'));
        return $this->redirect($this->referer());
    }


    public function login()
    {
        $this->viewBuilder()->layout('');
        $remember = false;

        if ($this->request->is('post')) {
            if (isset($this->request->data['rememberMe']) && $this->request->data['rememberMe'] == 'on') {
                unset($this->request->data['rememberMe']);
                $remember = true;
            }

            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);

                $session = $this->request->session();
                $session->write('KCEDITOR.disabled', false);
              //  debug($name = $this->request->session()->read()); die;

                if ($remember) {
                    $this->Cookie->write('admin', $this->request->data);
                    $this->Cookie->write('KCEDITOR.disabled', false);
                } elseif ($this->Cookie->check('admin')) {
                    $this->Cookie->delete('admin');
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Пароль або логін не правильний'));
            }
        }
        if ($this->Cookie->check('admin')) {
            $this->request->data = $this->Cookie->read('admin');
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

    }

    public function register(){
        $this->viewBuilder()->layout('');
        if ($this->request->is('post')) {
            $data = $this->Admins->newEntity();

            $data = $this->Admins->patchEntity($data, $this->request->data());
            // debug($data); die;
            $this->Admins->save($data);
            return $this->redirect('/admindom/login');
        }

    }

    public function logout()
    {
        if ($this->Cookie->check('admin')) {
            $this->Cookie->delete('admin');
            $session = $this->request->session();
            $session->write('KCEDITOR.disabled', true);
        }
        if( $this->Cookie->check('KCEDITOR.disabled', false)){
            $this->Cookie->write('KCEDITOR.disabled', true);
        }

        return $this->redirect($this->Auth->logout());
    }


    public function changePassword()
    {

        if ($this->request->is('post')) {
            $data = $this->request->data;
            extract($data);
            if (isset($old_pass, $pass, $conf_pass)) {
                if ($pass != $conf_pass) {
                    $this->Flash->error(__('Паролі не співпадають'));
                    return $this->redirect(['action' => 'change_password']);
                }
                $tmp_user = $this->Admins->get($this->Auth->user('id'));
                if ((new DefaultPasswordHasher)->check($old_pass, $tmp_user->pass)) {
                    $tmp_user->pass = $pass;
                    $this->Admins->save($tmp_user);
                    $this->Flash->success(__('Пароль змінено'));
                    return $this->redirect(['action' => 'change_password']);
                } else {
                    $this->Flash->error(__('Не правильно введений пароль'));
                    return $this->redirect(['action' => 'change_password']);
                }
            } else {
                $this->Flash->error(__('Відсутні обов\'язкові поля'));
                return $this->redirect(['action' => 'change_password']);
            }
        }

    }


}