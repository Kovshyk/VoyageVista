<?php
namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use App\Helpers\StaticValuesHelper;

class CategoriesProjectsTable extends AppTable {
    public function initialize(array $config)
    {

        $this->belongsTo('Categories');
        $this->belongsTo('Projects');
    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
    }

    public function deleteAllByKey($key, $key_id)
    {
        $bd_ents = $this->find('all')
            ->where([$key => $key_id]);
        foreach ($bd_ents as $bd_ent) {
            $this->delete($bd_ent);
        }
    }
    public function getToChange($key, $key_id)
    {
        $bd_ents = $this->find('all')
            ->where([$key => $key_id]);
        $new_array = [];
        foreach ($bd_ents as $bd_ent) {
            $new_array[$bd_ent->id] = 0;
        }
        return $new_array;
    }

    public function change($ids_change, $id_change_name, $id_from, $id_from_name)
    {
        $bd_data = $this->getToChange($id_from_name, $id_from);
        foreach ($ids_change as $id_change) {
            if (array_key_exists($id_change, $bd_data)) {
                unset($bd_data[$id_change]);
            } else {
                $ent = $this->newEntity([$id_from_name => $id_from, $id_change_name => $id_change]);
                $this->save($ent);
            }
        }
        foreach ($bd_data as $key => $ingredient) {
            $this->delete($this->get($key));
        }
    }


}