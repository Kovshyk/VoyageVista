<?php

namespace App\Model\Table;

use App\Helpers\StaticValuesHelper;
use Cake\I18n\I18n;

class PagesTable extends AppTable
{
    public function initialize(array $config)
    {
        $this->addBehavior('Translate', [
            'fields' => ['content', 'seo_title', 'seo_description'],
            'translationTable' => 'i18n',
            'allowEmptyTranslations' => StaticValuesHelper::$postsCategoriesTableOptions['allowEmptyTranslations']
        ]);
    }

    public function change($data)
    {
        $conf = $this->findByName($data['name'])->first();
        if (empty($conf)) {
            $conf = $this->newEntity(['name' => $data['name']]);
        }
        if(!empty($data['content'])){
            foreach ($data['content'] as $lang => $datum) {
                if($lang == 'uk') {
                    $data['content'] = serialize($datum);
                } else {
                    $data['_translations'][$lang]['content'] = serialize($datum);
                }
            }
        }
//        debug($data); die;
        $this->patchEntity($conf, $data);
        $this->save($conf);
        return true;
    }

    public function getByName($name)
    {

        $this->locale('uk');
        $conf = $this->find('translations')
            ->where(['name' => $name])
            ->first();
        $locale = I18n::locale();
        if($locale != 'uk') {
            if(!empty($conf->_translations[$locale]->seo_title)) {
                $conf->seo_title = $conf->_translations[$locale]->seo_title;
            }
            if(!empty($conf->_translations[$locale]->seo_description)) {
                $conf->seo_description = $conf->_translations[$locale]->seo_description;
            }
        }


        if(empty($conf)) {return false;}
//        debug($conf->getContentField(['seo_text'])); die;

        return $conf;
    }

}
