<?php

namespace App\Controller\Admindom;
use App\Helpers\ImagesHelper;
use App\Helpers\LanguagesHelper;


class GalleryController extends AppController
{
    private $minHeight = 200;
    private $minWight = 200;

    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $this->loadModel('GalleryCategories');
        $categories = $this->GalleryCategories->find('all')
            ->order(['sort' => 'ASC']);

        $gallery = $this->Gallery->find('all')
            ->contain('GalleryCategories')
            ->order(['created' => 'DESC']);

        $minHeight = $this->minHeight;
        $minWight = $this->minWight;

        $this->set('minHeight', $minHeight);
        $this->set('minWight', $minWight);

        $this->set('gallery', $gallery);
        $this->set('categories', $categories);
    }

    public function imageTitles()
    {
        $languages = LanguagesHelper::getLanguages();
        $this->set('languages', $languages);

        $gallery = $this->Gallery->find('translations')
            ->where(['type' => 'photo'])
            ->order(['created' => 'DESC']);
        $this->set('gallery', $gallery);



        $this->loadModel('Projects');
        $projects = $this->Projects
            ->find('translations')
            ->contain(['Photos' => function ($q) {
                return $q->find('translations')->order(['Photos.sort' => 'DESC']);
            }])
            ->order(['modified' => 'DESC']);
//        debug($projects->toArray()); die;
        $this->set('projects', $projects);

    }

    public function changePhotosTitles()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->loadModel('Photos');
            foreach ($data['items'] as $item) {
                $this->Photos->change($item);
            }
            $this->Flash->success('Збережено');
            return $this->redirect($this->referer());
        }
    }
    public function changeImageTitles()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            foreach ($data['items'] as $item) {
                $this->Gallery->change($item);
            }
            $this->Flash->success('Збережено');
            return $this->redirect($this->referer());
        }
    }

    public function change()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($data['type'] == 'video') {
                $parts = parse_url($data['video_href']);
                parse_str($parts['query'], $query);
                if(empty($query['v'])) {
                    $this->Flash->error('Incorrect URL');
                    return $this->redirect($this->referer());
                }
                $data['video_href'] = 'https://www.youtube.com/embed/'.$query['v'];
                $this->Gallery->change($data);
                $this->Flash->success('Збережено');
                return $this->redirect($this->referer());
            }
            if ($data['type'] == 'photo') {
                $minHeight = $this->minHeight;
                $minWight = $this->minWight;


                ini_set('max_execution_time', 4000);
                ini_set('memory_limit', '2560M');

                $files = $data['img'];

                ImagesHelper::$minHeight = $minHeight;
                ImagesHelper::$minWight = $minWight;

                foreach ($files as $i => $file) {
                    $check = ImagesHelper::checkFile($file);
                    if ($check) {
                        $this->Flash->error($check);
                        return $this->redirect($this->referer());
                    };
                }
                foreach ($files as $i => $file) {
                    $upload_img = ImagesHelper::uploadImage($file, IMG_ROOT_GALLERY);
                    if ($upload_img['error']) {
                        $this->Flash->error($upload_img['error']);
                        return $this->redirect($this->referer());
                    }
                    $item = $this->Gallery->newEntity(
                        [
                            'gallery_category_id' => $data['gallery_category_id'],
                            'type' => 'photo',
                            'img_src' => $upload_img['road'],
                        ]
                    );
                    $this->Gallery->save($item);
                }
                $this->Flash->success('Збережено');
                return $this->redirect($this->referer());
            }

        }
        $this->Flash->error('Missing required fields!');
        return $this->redirect($this->referer());
    }

    public function delete($id)
    {
        $this->Gallery->deleteById($id);
        $this->Flash->success('Збережено');
        return $this->redirect($this->referer());
    }
}