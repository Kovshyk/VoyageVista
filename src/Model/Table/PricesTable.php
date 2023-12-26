<?php
namespace App\Model\Table;

class PricesTable extends AppTable {

    public function initialize(array $config)
    {
        $this->table('prices');


        //$this->entityClass('Price');
    }

    public function clearCovers($entity)
    {
        foreach (['icon'] as $item) {
            if (!empty($entity->$item) && file_exists(WWW_ROOT_USE . $entity->$item) && is_file(WWW_ROOT_USE . $entity->$item))
                unlink(WWW_ROOT_USE . $entity->$item);
        }
    }

    public function beforeDelete($event, $entity, $options)
    {
        $this->clearCovers($entity);
    }

}