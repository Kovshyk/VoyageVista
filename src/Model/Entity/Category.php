<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\I18n\I18n;
use Cake\I18n\Time;

class Category extends Entity {
    protected function _getNiceCreated()
    {
        I18n::locale('ua');
        $created = new Time($this->_properties['created']);
        return  $created->i18nFormat('dd.MM.yyyy');
    }

    public function getEnableByLocale($locale)
    {
        if(isset($this->_properties['enable_'.$locale])) {
            return $this->_properties['enable_'.$locale];
        }
        return  '';
    }

    protected function _getXmlCreated()
    {
        $created = new Time($this->_properties['created']);
        return $created->i18nFormat("yyyy-MM-dd", 'Europe/Kiev');
    }

    public function getSlugByLocale($locale)
    {
        if(isset($this->_properties['slug_'.$locale])) {
            return $this->_properties['slug_'.$locale];
        }
        return  '';
    }
}