<?php

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use App\Helpers\StaticValuesHelper;

class GalleryTable extends AppTable
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('GalleryCategories');
        $this->addBehavior('Translate', [
            'fields' => ['title'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
    }

    public function change($data)
    {
        if(isset($data['id'])) {
            $entity = $this->get($data['id']);
        } else {
            $entity = $this->newEntity();
        }
        $this->patchEntity($entity, $data);
        $this->save($entity);
    }


    public function deleteById($id)
    {
        $project = $this->get($id);
        $this->delete($project);
    }

    public function beforeDelete($event, $entity, $options)
    {
        $this->clearPhotos($entity);
    }

    public function clearPhotos($entity)
    {
        foreach (['img_src', 'img_medium', 'img_small'] as $item) {
            if (!empty($entity->$item) && file_exists(WWW_ROOT_USE . $entity->$item) && is_file(WWW_ROOT_USE . $entity->$item))
                unlink(WWW_ROOT_USE . $entity->$item);
        }
    }

}