<?php

namespace App\Controller\Admindom;
use App\Helpers\LanguagesHelper;


class GalleryCategoriesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $categories = $this->GalleryCategories->find('translations')
            ->order(['sort' => 'ASC']);
        $this->set('languages', LanguagesHelper::getLanguages());

        $this->set('categories', $categories);
    }

    public function change()
    {
        if ($this->request->is('post')) {
            $this->GalleryCategories->change($this->request->data);
            $this->Flash->success('Збережено');
            return $this->redirect($this->referer());
        }
        $this->Flash->error('Missing required fields!');
        return $this->redirect($this->referer());
    }

    public function delete($id)
    {
        $this->GalleryCategories->deleteByIdWithGallery($id);
        $this->Flash->success('Збережено');
        return $this->redirect($this->referer());
    }
}