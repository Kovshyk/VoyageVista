<?php

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use App\Helpers\StaticValuesHelper;
use App\Helpers\LanguagesHelper;
use Cake\I18n\I18n;

class ProjectsTable extends AppTable
{

    public function initialize(array $config)
    {
        $this->table('projects');
        $this->entityClass('Project');
        $this->hasMany('Photos', [
            'foreignKey' => 'project_id'
        ]);

        $this->addBehavior('Translate', [
            'fields' => ['name', 'short_description', 'seo_title', 'seo_description',
                'complet', 'construct', 'materials', 'plan'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);

        $this->hasMany('CategoriesProjects');


    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
        if($entity->isNew()) {
            $this->formSlugs($entity);
        }
    }

    private function formSlugs($entity) {
        foreach (LanguagesHelper::getLanguages() as $lang) {
            if($lang['type'] == 'main' || empty($entity->_translations[$lang['Locale']]->name)) {
                $name = $entity->name;
            } else {
                $name = $entity->_translations[$lang['Locale']]->name;
            }
            $slug_layout = $this->formSlug($name);
            $ent_name = 'slug_'.$lang['Locale'];
            $entity->$ent_name = $slug_layout;

            $i = 1;

            $conditions = (!empty($entity->id)) ? ['Projects.id != ' => $entity->id] : [];
            $conditions['Projects.slug_'.$lang['Locale']] = $entity->$ent_name;
            while ($this->exists($conditions)) {
                $entity->$ent_name = $slug_layout . '-' . $i;
                $conditions['Projects.slug_'.$lang['Locale']] = $entity->$ent_name;
                $i++;
            }
        }
    }

    public function updateSlugs()
    {
        $entities = $this->find('translations');

        foreach ($entities as $entity) {
            if($entity->name == 'ІТАКА') {
                $layout = $entity;
            }
        }
        foreach ($entities as $entity) {
            if ($entity->name != 'ІТАКА') {
                foreach (['ru','en', 'de','pl'] as $lang) {
//                    $entity->translation($lang)->complet = $layout->_translations[$lang]->complet;
//                    $entity->translation($lang)->construct = $layout->_translations[$lang]->construct;
//                    $entity->translation($lang)->materials = $layout->_translations[$lang]->materials;
//                    $entity->translation($lang)->plan = $layout->_translations[$lang]->plan;
                    //                    debug($entity); die;
                }
//                $this->save($entity);
//                debug($entity);die;
            }
        }
//        die;

//        debug($entities->toArray());
//        die;
//        foreach ($entities as $entity) {
//            $this->formSlugs($entity);
//            $this->save($entity);
//        }

    }


    public function deleteByIdWithPhotos($id)
    {
        $project = $this->find('all')
            ->where(['Projects.id' => $id])
            ->contain('Photos')
            ->first();
        $photosTable = TableRegistry::get('Photos');
        foreach ($project->photos as $photo) {
            $photosTable->delete($photo);
        }
        $this->delete($project);
    }

    public function getToDataTable($category_id)
    {
        $conditions = [];
        if(!empty($category_id)) {
            $project_ids = $this->CategoriesProjects->find('all')
                ->where(['category_id' => $category_id])
                ->extract('project_id')
                ->toArray();
            $conditions = (!empty($project_ids)) ? ['Projects.id IN' => $project_ids] : ['Projects.id' => 0];
        }
        $projects = $this->find('all')
            ->contain(['Photos' => function ($q1) {
                return $q1->order(['sort' => 'DESC']);
            }])
            ->where($conditions)
            ->order(['Projects.created' => 'DESC']);

        foreach ($projects as $project) {
            $project->created = [
                'display' => $project->nice_created,
                'timestamp' => $project->created
            ];
            if (!empty($project->photos)) {
                $small = $project->photos[0]->img_small;
                $project->img = "<img src = '$small'>";
            }
            $project->action = "
            <a href='/admindom/projects/change/$project->id'
                    class=\"btn - xs btn btn - inverse \">
                    Змінити
            </a>
             <button type=\"button\"
                    class=\"btn-xs btn btn-danger \"
                    data-id=\"$project->id\"
                    onclick=\"deleteProduct('$project->id')\">
                    Видалити
            </button>
            ";
        }
        return $projects->toArray();
    }

    public function findBySlug($slug)
    {
        return $this->find('all')
            ->where(['slug_'.I18n::locale() => $slug])
            ->contain(['Photos' => function ($q1) {
                return $q1->order(['sort' => 'DESC'])
                    ->limit(6);
            }])
            ->first();
    }

}