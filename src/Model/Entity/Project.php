<?php
namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;
use Cake\I18n\Time;
use Cake\I18n\I18n;
use Cake\Utility\Text;


class Project extends Entity {
    use TranslateTrait;

    public function _getTranslatedSlugByLang($lang)
    {
        if(isset($this->_properties['slug_'.$lang])) {
            return $this->_properties['slug_'.$lang];
        }
        return $this->_properties['slug_uk'];
    }

    protected function _getTranslatedSlug()
    {
        return $this->_getTranslatedSlugByLang(I18n::locale());
    }

    public function _getHref($lang = false)
    {
        if(!$lang) {
            return '/project/'.$this->_getTranslatedSlug();
        }
        return '/project/'.$this->_getTranslatedSlugByLang($lang);
    }

    protected function _getXmlCreated()
    {
        $created = new Time($this->_properties['created']);
        return $created->i18nFormat("yyyy-MM-dd", 'Europe/Kiev');
    }

// SEO
    protected function _getNiceSeoTitle()
    {
        return (empty($this->_properties['seo_title'])) ? $this->_properties['name'] : $this->_properties['seo_title'];
    }

    protected function _getNiceSeoDescription()
    {
        return (empty($this->_properties['seo_description'])) ? $this->_properties['short_description'] : $this->_properties['seo_description'];
    }

    protected function _getNiceSeoImg()
    {
        return (empty($this->_properties['photos'][0]['img_medium'])) ? '' : $this->_properties['photos'][0]['img_medium'];
    }

}