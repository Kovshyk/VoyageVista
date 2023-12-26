<?php
namespace App\Model\Table;

class FormsTable extends AppTable {

    public function initialize(array $config)
    {
        $this->table('forms');


        $this->entityClass('Form');
    }

    public function beforeSave($event, $entity, $options)
    {
        if(!empty($entity->phone)){
            $entity->phone = strip_tags($entity->phone);
        }
        if(!empty($entity->name)){
            $entity->question = strip_tags($entity->question);
        }
        if(!empty($entity->message)){
            $entity->question = strip_tags($entity->question);
        }
        if ($entity->isNew()) {
            $entity->created = time();
        }
    }

}