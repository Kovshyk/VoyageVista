<?php

namespace App\Controller\Admindom;

use App\Helpers\ImagesHelper;

use App\Model\Table\ProjectsTable;
use Cake\View\Helper\SessionHelper;
use App\Helpers\LanguagesHelper;

class ProjectsController extends AppController
{
    private $minHeight = 500;
    private $minWight = 700;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Prices');

    }

    public function prices()
    {
        $minHeight = 32;
        $minWight = 32;

        $prices = $this->Prices->find('all')->order(['name'=> "ASC"]);

        $this->set(compact(['minHeight','minWight','prices']));

        if ($this->request->is('post')) {
            $data = $this->request->data();
            extract($data);
            if(!empty($name)){

                if (!empty($id) && $this->Prices->exists(['id' => $id])) {
                    $price = $this->Prices->get($id);
                } else {
                    $price = $this->Prices->newEntity();
                }
                if (!empty($icon['tmp_name'])) {
                    ImagesHelper::$minHeight = $minHeight;
                    ImagesHelper::$minWight = $minWight;
                    $upload_img = ImagesHelper::uploadImage($icon, IMG_ROOT);

                    if ($upload_img['error']) {
                        $this->Flash->error($upload_img['error']);
                        return $this->redirect($this->referer());
                    }
                    $this->Prices->clearCovers($price);
                    $price->icon = $upload_img['road'];
                }
                if (!empty($data['icon'])) {
                    unset($data['icon']);
                }
                $this->Prices->patchEntity($price, $data);

                $this->Prices->save($price);

                $this->Flash->success(__('Збережено'));
                $this->redirect($this->referer());
            }
        }


    }


    public function deletePrice($id)
    {
        $price = $this->Prices->get($id);



        $this->Prices->delete($price);

        $this->Flash->success(__('Видалено'));
        return $this->redirect($this->referer());
    }


    public function change($id = null)
    {
        $this->loadModel('Categories');
        $categories = $this->Categories->find('all')
            ->order(['sort' => 'ASC']);
        $this->set('categories', $categories);
        if ($id != null) {
            $project = $this->Projects->find('translations')
                ->contain(['Photos'  => function ($q1) {
                    return $q1->order(['sort' => 'DESC']);
                }])
                ->where(['id' => $id])
                ->first();
            $this->set('project', $project);


            $this->loadModel('CategoriesProjects');
            $category_ids = $this->CategoriesProjects->find('all')
                ->where(['project_id' => $project->id])
                ->extract('category_id')
                ->toArray();
            $this->set('category_ids', $category_ids);
        } else {
            $this->loadModel('Photos');
            if(!$this->request->is('post')){
                $this->Photos->clearTemp();
            }
        }
        $minHeight = $this->minHeight;
        $minWight = $this->minWight;

        $this->set(compact(['minHeight', 'minWight']));
        $languages = LanguagesHelper::getLanguages();
        $this->set('languages', $languages);
        $this->loadModel('Prices');
        $this->set('prices', $this->Prices->find('all')->order(['name'=> "ASC"]));


        if ($this->request->is('post')) {
            $data = $this->request->data();
            $data['prices'] = (!empty($data['prices'])) ? json_encode($data['prices']) : json_encode([]);

            extract($data);
            if(!empty($name) && !empty($short_description) && !empty($area)){
                $new = false;
                if(empty($project)) {
                    $project = $this->Projects->newEntity();
                    $new = true;
                }
                foreach ($languages as $language) {
                    foreach (['complet', 'construct', 'materials', 'plan'] as $item) {
                        if(!empty($data['_translations'][$language['Locale']][$item]) && trim($data['_translations'][$language['Locale']][$item]) == '<p>&nbsp;</p>') {
                            $data['_translations'][$language['Locale']][$item] = '';
                        }
                    }
                }

                $categories = [];
                if(isset($data['categories'])) {
                    $categories = $data['categories'];
                    unset($data['categories']);
                }
                $this->Projects->patchEntity($project, $data);
                $this->Projects->save($project);

                $this->loadModel('CategoriesProjects');
                $this->CategoriesProjects->change($categories, 'category_id', $project->id, 'project_id');
                if($new) {
                    $this->loadModel('Photos');
                    $this->Photos->moveTemp($project->id);
                }
                $this->Flash->success('Збережено');
                return $this->redirect($this->referer());
            }
            $this->Flash->error('Відсутні обовязкові поля!');
            return $this->redirect('/admindom/projects/index');
        }
    }


    public function uploadImages($project_id = null)
    {
        $minHeight = $this->minHeight;
        $minWight = $this->minWight;

        $w_medium = 620;
        $h_medium = 465;

        $w_small = 105;
        $h_small = 70;



        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('POST')) {
            ini_set('max_execution_time', 4000);
            ini_set('memory_limit', '2560M');
            $files = $this->request->data('file');

            if (!empty($files)) {
                ImagesHelper::$minHeight = $minHeight;
                ImagesHelper::$minWight = $minWight;
                foreach ($files as $i => $file) {
                    $check = ImagesHelper::checkFile($file);
                    if ($check) {
                        $this->response->body(json_encode(['delete' => 0, 'error' => ['message' => $check]]));
                        $this->response->statusCode(200);
                        return $this->response;
                    };
                }
                $this->loadModel('Photos');
                $images = [];
                foreach ($files as $i => $file) {
                    $upload_img = ImagesHelper::uploadImage($file, IMG_ROOT_PROJECTS);
                    if ($upload_img['error']) {
                        $this->Flash->error($upload_img['error']);
                        return $this->redirect($this->referer());
                    }
                    $image_medium = ImagesHelper::resize_file($upload_img['road'], $w_medium, $h_medium, 'm_', $upload_img['name']);
                    $image_small = ImagesHelper::resize_file($upload_img['road'], $w_small, $h_small, 's_', $upload_img['name']);
                    $images[$i] =
                        [
                            'img_original' => $upload_img['road'],
                            'img_medium' => $image_medium,
                            'img_small' => $image_medium,
                            'project_id' => $project_id
                        ];

                    $img = $this->Photos->newEntity(
                        [
                            'project_id' => $project_id,
                            'img_src' => $upload_img['road'],
                            'img_medium' => $image_medium,
                            'img_small' => $image_small,
                        ]
                    );
                    $this->Photos->save($img);
                    $images[$i] = $images[$i] + ['id' => $img->id];

                    if (is_null($project_id)) {
                        $tmp_images = $this->Photos->find('all')
                            ->where(function ($exp, $q) {
                                return $exp->isNull('project_id');
                            })
                            ->order(['sort' => 'DESC'])
                            ->toArray();
                    } else {
                        $tmp_images = $this->Photos->find('all')
                            ->where(['project_id' => $project_id])
                            ->order(['sort' => 'DESC'])
                            ->toArray();
                    }
                    $i = count($tmp_images);
                    foreach ($tmp_images as $tmp_image) {
                        $tmp_image->sort = $i;
                        $this->Photos->save($tmp_image);
                        $i--;
                    };
                }
                $response = ['error' => false, "images" => $images];
                $this->response->body(json_encode($response));
                $this->response->statusCode(200);
                return $this->response;
            }
        }

    }

    public function sortingImages($project_id = null)
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('POST')) {
            if (!empty($this->request->data['sort'])) {
                $sort = $this->request->data['sort'];
                $this->loadModel('Photos');
                if (is_null($project_id)) {
                    $tmp_images = $this->Photos->find('all')->where(function ($exp, $q) {
                        return $exp->isNull('project_id');
                    })->order(['sort' => 'DESC'])
                        ->toArray();
                } else {
                    $tmp_images = $this->Photos->find('all')
                        ->where(['project_id' => $project_id])
                        ->order(['sort' => 'DESC'])
                        ->toArray();
                }
                $sorted_img = [];
                foreach ($tmp_images as $tmp_image) {
                    $sorted_img[$tmp_image->sort] = $tmp_image;
                }
                $i = count($sort);
                $response = ['sorted' => 1];
                foreach ($sort as $key => $sorted) {
                    $sorted_img[$sorted]->sort = $i;
                    if (!$this->Photos->save($sorted_img[$sorted])) {
                        $response = ['sorted' => 0, 'error' => ['message' => 'System error!']];
                    }
                    $i--;
                }
                $this->response->body(json_encode($response));
                $this->response->statusCode(200);
                return $this->response;
            }
        }
        $this->response->body(json_encode(['sorted' => 0, 'error' => ['message' => 'Missing required fields!']]));
        $this->response->statusCode(200);
        return $this->response;
    }

    public function deleteImg($project_id = null)
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('POST')) {
            ini_set('max_execution_time', 4000); // обробка php максимум 4000 секунд (1 година)
            ini_set('memory_limit', '2560M');
            if (!empty($this->request->data('sort')) && !empty($this->request->data('id'))) {
                $this->loadModel('Photos');
                if (!is_null($project_id)) {
                    if (count($this->Photos->find('all')->where(['project_id' => $project_id])->toArray()) < 2) {
                        $this->response->body(json_encode(['delete' => 0,
                            'error' => ['message' => 'Останню фотографію видаляти не дозволено.']]));
                        $this->response->statusCode(200);
                        return $this->response;
                    }
                }
                $id = $this->request->data('id');
                $img = $this->Photos->get($id);
                if ($this->Photos->delete($img)) {
                    if (is_null($project_id)) {
                        $tmp_images = $this->Photos->find('all')->where(function ($exp, $q) {
                            return $exp->isNull('project_id');
                        })->order(['sort' => 'DESC'])->toArray();
                    } else {
                        $tmp_images = $this->Photos->find('all')->where(['project_id' => $project_id])->order(['sort' => 'DESC'])->toArray();
                    }
                    $i = count($tmp_images);
                    $response = ['delete' => 1];
                    foreach ($tmp_images as $tmp_image) {
                        $tmp_image->sort = $i;
                        if (!$this->Photos->save($tmp_image)) {
                            $response = ['delete' => 0, 'error' => ['message' => 'System error!']];
                        }
                        $i--;
                    }
                    $this->response->body(json_encode($response));
                    $this->response->statusCode(200);
                    return $this->response;
                }
            }
        }
        $this->response->body(json_encode(['delete' => 0, 'error' => ['message' => 'Missing required fields!']]));
        $this->response->statusCode(200);
        return $this->response;
    }

    public function index()
    {
        $this->loadModel('Categories');
        $categories = $this->Categories->find('all')
            ->order(['sort' => 'ASC']);

        $this->set('categories', $categories);
    }

    public function getProduct()
    {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->body(json_encode(['data' => $this->Projects->getToDataTable($this->request->query('category_id'))]));
        $this->response->statusCode(200);

        return $this->response;
    }

    public function sortPosts()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if (!empty($data)) {

                $this->Projects->saveSort($data);
            }

        }
        $this->response->body(json_encode('Change saved.'));
        $this->response->statusCode(200);
        return $this->response;
    }

    public function deleteProject($id)
    {
        if (!empty($id)) {
            $this->Projects->deleteByIdWithPhotos($id);
            $this->createXmlFile();
            $this->Flash->success('Проект видалено');
            $this->redirect($this->referer());
        }
    }


}