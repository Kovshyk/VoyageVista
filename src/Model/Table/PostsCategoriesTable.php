<?php

namespace App\Model\Table;

use App\Helpers\StaticValuesHelper;
use App\Helpers\LanguagesHelper;
use Cake\I18n\I18n;

class PostsCategoriesTable extends AppTable
{
    private $publishedCategories = false;

    public function initialize(array $config)
    {
        $this->addBehavior('Translate', [
            'fields' => ['name', 'seo_title', 'seo_description', 'seo_text'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);

        $this->hasMany('Posts', [
            'foreignKey' => 'category_id',
            'joinType' => 'LEFT',
        ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
        $this->formSlugs($entity);
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
            $conditions = ['PostsCategories.slug_'.$lang['Locale'] => $entity->$ent_name];
            if(!empty($entity->id)) {$conditions['PostsCategories.id != '] = $entity->id;}

            while ($this->exists($conditions)) {
                $entity->$ent_name = $slug_layout . '-' . $i;
                $conditions = ['PostsCategories.slug_'.$lang['Locale'] => $entity->$ent_name];
                if(!empty($entity->id)) {$conditions['PostsCategories.id != '] = $entity->id;}
                $i++;
            }
        }
    }

    public function afterSave($event, $entity, $options)
    {
        parent::afterSave($event, $entity, $options);

    }

    public function change($data)
    {
        $ent = (!empty($data['id'])) ? $this->get($data['id']) : $this->newEntity();
        if(isset($data['id'])) {
            unset($data['id']);
        }
        $this->patchEntity($ent, $data);
        $this->save($ent);
    }


    public function getPublishedCategories()
    {
        if(!$this->publishedCategories) {
            $publishedCategoriesIds = $this->Posts->find('all')
                ->where(['status' => 1])
                ->select(['Posts.id', 'Posts.category_id', 'Posts.status'])
                ->group('category_id')
                ->combine('id', 'category_id')
                ->toArray();
            if(empty($publishedCategoriesIds)) {
                return [];
            }
            $this->publishedCategories = $this->find('all')
                ->order(['created' => 'ASC'])
                ->where(['PostsCategories.id IN' => $publishedCategoriesIds, 'status' => 1]);
        }
        return $this->publishedCategories;
    }

    public function findBySlug($slug)
    {
        return $this->find('all')
            ->where(['status' => 1, 'slug_'.I18n::locale() => $slug])
            ->first();
    }

    public function getFirstPublishedCategory()
    {
        $categories = $this->getPublishedCategories();
        foreach ($categories as $category) {
            return $category;
        }
        return false;
    }


}