<?php
namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use App\Helpers\StaticValuesHelper;

class GalleryCategoriesTable extends AppTable {
    public function initialize(array $config)
    {
        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);

        $this->hasMany('Gallery', [
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
    }

    public function deleteByIdWithGallery($id)
    {
        $category = $this->find('all')
            ->where(['GalleryCategories.id' => $id])
            ->contain('Gallery')
            ->first();

        $galleryTable = TableRegistry::get('Gallery');
        foreach ($category->gallery as $project) {
            $galleryTable->deleteById($project->id);
        }
        $this->delete($category);
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


}