<?php
namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use App\Helpers\StaticValuesHelper;
use App\Helpers\LanguagesHelper;

class CategoriesTable extends AppTable {
    public function initialize(array $config)
    {
        $this->addBehavior('Translate', [
            'fields' => ['name', 'seo_text', 'seo_description', 'seo_title', 'short_description'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);

        $this->hasMany('CategoriesProjects', [
            'joinType' => 'LEFT',
        ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
        if ($entity->isNew()) {
            $last = $this->find('all')
                ->order(['sort' => 'DESC'])
                ->first();
            if (empty($last)) {
                $entity->sort = 1;
            } else {
                $entity->sort = $last->sort + 1;
            }
        }
        foreach ( LanguagesHelper::getLanguages() as $language ) {
            $slug = 'slug_'.$language['Locale'];
            if(!empty($entity->$slug)) {
                $slug_layout = $this->formSlug($entity->$slug);
                if(!empty($entity->id)) {
                    $conditions = ['Categories.id != ' => $entity->id, 'Categories.slug_'.$language['Locale'] => $slug_layout];
                } else {
                    $conditions = ['Categories.slug_'.$language['Locale'] => $slug_layout];
                }

                $entity->$slug = $slug_layout;
                $i = 1;
                while ($this->exists($conditions)) {
                    $entity->$slug = $slug_layout . '-' . $i;
                    if(!empty($entity->id)) {
                        $conditions = ['Posts.id != ' => $entity->id, 'Posts.slug_'.$language['Locale'] => $entity->$slug];
                    } else {
                        $conditions = ['Posts.id != ' => $entity->id, 'Posts.slug_'.$language['Locale'] => $entity->$slug];
                    }
                    $i++;
                }
            } else {
                $entity->$slug = null;
            }
        }
    }

    public function deleteByIdWithProjects($id)
    {
        $category = $this->find('all')
            ->where(['Categories.id' => $id])
            ->contain('CategoriesProjects')
            ->first();
        foreach ($category->categories_projects as $project) {
            $this->CategoriesProjects->delete($project);
        }
        $this->delete($category);

    }


    public function change($data)
    {
        $entity = (!empty($data['id'])) ? $this->get($data['id']) : $this->newEntity();
        foreach (LanguagesHelper::getLanguages() as $language) {
            if(empty($data['enable_'.$language['Locale']])) {
                $data['enable_'.$language['Locale']] = 0;
            }
        }
        $projects = [];
        if(isset($data['projects'])) {
            $projects = $data['projects'];
            unset($data['projects']);
        }
        $this->patchEntity($entity, $data);
        $this->save($entity);
        $this->CategoriesProjects->change($projects, 'project_id', $entity->id, 'category_id');
    }


}