<?php
namespace App\Model\Table;
use App\Helpers\StaticValuesHelper;

class PhotosTable extends AppTable {

    public function initialize(array $config)
    {
        $this->table('photos');

        $this->belongsTo('Projects');
        $this->addBehavior('Translate', [
            'fields' => ['title'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);
        //$this->entityClass('Price');
    }

    public function change($data)
    {
        if(isset($data['id'])) {
            $entity = $this->get($data['id']);
        } else {
            return false;
        }
        $this->patchEntity($entity, $data);
        $this->save($entity);
    }


    public function clearTemp()
    {
        $tmp_images = $this->find('all')
            ->where(function ($exp, $q) {
                return $exp->isNull('project_id');
            });
        foreach ($tmp_images as $tmp_image) {
            $this->delete($tmp_image);
        }
    }

    public function moveTemp($project_id)
    {
        $tmp_images = $this->find('all')
            ->where(function ($exp, $q) {
                return $exp->isNull('project_id');
            });
        foreach ($tmp_images as $tmp_image) {
            $tmp_image->project_id = $project_id;
            $this->save($tmp_image);
        }
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