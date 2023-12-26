<?php

namespace App\Controller\Admindom;
use App\Helpers\LanguagesHelper;


class CategoriesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $categories = $this->Categories->find('translations')
            ->order(['sort' => 'ASC']);
        $this->set('languages', LanguagesHelper::getLanguages());
        $this->set('categories', $categories);
    }

    public function change($id = null)
    {
//        debug(1); die;
//        debug($this->request->is('post')); die;
//        debug($this->request->data); die;

        if ($this->request->is('post')) {
            $this->Categories->change($this->request->data);
            $this->createXmlFile();
            $this->Flash->success('Збережено');
            return $this->redirect('/admindom/categories/index');
        }
        if ($id != null) {
            $category = $this->Categories->find('translations')
                ->contain(['CategoriesProjects'])
                ->where(['id' => $id])
                ->first();
            $this->set('category', $category);

            $this->loadModel('CategoriesProjects');
            $project_ids = $this->CategoriesProjects->find('all')
                ->where(['category_id' => $category->id])
                ->extract('project_id');
            $this->set('project_ids', $project_ids);
        }

        $this->loadModel('Projects');
        $this->set('projects', $this->Projects->find('all')->order(['modified' => 'DESC']));
        $this->set('languages', LanguagesHelper::getLanguages());
    }

    public function delete($id)
    {
        $this->Categories->deleteByIdWithProjects($id);
        $this->createXmlFile();
        $this->Flash->success('Збережено');
        return $this->redirect($this->referer());
    }

}
