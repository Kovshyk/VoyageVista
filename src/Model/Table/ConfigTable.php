<?php
namespace App\Model\Table;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Table;

class ConfigTable extends AppTable {
    public function initialize(array $config)
    {
        $this->table('config');

    }

    public function getConfig($section = null)
    {
        $result = [];
        $configs = $this->findBySection($section);
        foreach ($configs as $config) {
            $result[$config->value] = $config->id;
        }
        return $result;

    }

    public function getConfigs()
    {
        $result = [];
        $configs = $this->find('all');
        foreach ($configs as $config) {
//            debug($config); die;
            $result[$config->section][] = $config->value;
        }
        return $result;

    }
}