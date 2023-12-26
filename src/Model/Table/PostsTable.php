<?php

namespace App\Model\Table;

use App\Helpers\StaticValuesHelper;
use App\Helpers\LanguagesHelper;
use App\Helpers\ConstructorHelper;
use App\Helpers\ImagesHelper;
use Cake\I18n\I18n;
use claviska\SimpleImage;
use App\Helpers\TinyPngHelper;


class PostsTable extends AppTable
{

    public function initialize(array $config)
    {
        $this->addBehavior('Translate', [
            'fields' => ['name', 'description', 'seo_title', 'seo_description', 'content'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);

        $this->belongsTo('Categories', [
            'className' => 'PostsCategories',
        ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        parent::beforeSave($event, $entity, $options);
        $this->formSlugs($entity);
    }

    public function afterSave($event, $entity, $options)
    {
        parent::afterSave($event, $entity, $options);
    }


    public function beforeDelete($event, $entity, $options)
    {
        ConstructorHelper::deleteFolder(WWW_ROOT.$this->formRoot($entity->id));
    }

    public function getLastsPublishedPostsToHome($count = 3)
    {
        return $this->find('all')
            ->where(['Posts.status' => 1, 'Categories.status' => 1])
            ->contain('Categories')
            ->order(['Posts.created' => 'DESC'])
            ->limit($count);
    }

    private function formSlugs($entity) {
        foreach (LanguagesHelper::getLanguages() as $lang) {
            $conditions = (!empty($entity->id)) ? ['Posts.id != ' => $entity->id] : [];

            if($lang['type'] == 'main' || empty($entity->_translations[$lang['Locale']]->name)) {
                $name = $entity->name;
            } else {
                $name = $entity->_translations[$lang['Locale']]->name;
            }
            $slug_layout = $this->formSlug($name);
            $ent_name = 'slug_'.$lang['Locale'];
            $entity->$ent_name = $slug_layout;

            $i = 1;

            $conditions['Posts.slug_'.$lang['Locale']] = $entity->$ent_name;
            while ($this->exists($conditions)) {
                $entity->$ent_name = $slug_layout . '-' . $i;
                $conditions['Posts.slug_'.$lang['Locale']] = $entity->$ent_name;
                $i++;
            }
        }
    }

    public function change($data)
    {
        $ent = (!empty($data['id'])) ? $this->get($data['id']) : $this->newEntity();
        if(isset($data['id'])) {
            unset($data['id']);
        }
        $cover = false;
        if(isset($data['cover'])) {
            $cover = $data['cover'];
            unset($data['cover']);
        }

        $this->patchEntity($ent, $data);

        $this->save($ent);
        if($cover) {
            if(!empty($cover['tmp_name'])) {

                if(!empty($ent->cover)){
                    if(file_exists(WWW_ROOT_USE.$ent->cover)){unlink(WWW_ROOT_USE.$ent->cover);}
                }
                $ent->cover = $this->uploadImage($cover, $this->formRoot($ent->id));
                $this->save($ent);
            }
        }
    }

    public function formRoot($id) {
        return 'src/upload/blog/'.$id.'/';
    }


    public function findBySlug($slug)
    {
        return $this->find('all')
            ->where(['status' => 1, 'slug_'.I18n::locale() => $slug])
            ->first();
    }


    public function uploadImage($data, $root, $name = false)
    {
        $file = $data;
        $root_service = WWW_ROOT . $root;
        ImagesHelper::generateFolder($root_service);
        $root_site = '/' . $root;
        if(!$name){
            $name = ImagesHelper::generateName($root_service, $file['name']);
        } else {
            $explode = explode('.', $file['name']);
            $ext = '.' . end($explode);
            $name = $name.$ext;
        }

        $o_serv_name = $root_service . $name;
        $w_serv_name = $root_service . 'w_'.$name;
        move_uploaded_file($file['tmp_name'], $o_serv_name);

//        TinyPngHelper::tinify($o_serv_name);
//
        $to_width = 445;
//        if(!TinyPngHelper::fitToWidth($to_width, $o_serv_name, $w_serv_name)) {
            $img_small = new SimpleImage();
            $img_small
                ->fromFile($o_serv_name)
                ->fitToWidth($to_width)
                ->toFile($w_serv_name, '', 100);
//        }


        return $root_site . $name;
    }

}