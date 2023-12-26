<?php
namespace App\Model\Table;

class VideosTable extends AppTable {

    public function initialize(array $config)
    {
        $this->table('videos');

        $this->belongsTo('Projects');

        //$this->entityClass('Price');
    }



}