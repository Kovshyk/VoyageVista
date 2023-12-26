<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\I18n\I18n;
use Cake\I18n\Time;

class Form extends Entity {
    protected function _getNiceCreated()
    {
        I18n::locale('ua');

        $created = new Time($this->_properties['created']);

//        if($created->isThisYear()) {
//            return $created->i18nFormat("d MMMM | HH:mm");
//        } else {
//            return $created->i18nFormat("d MMMM | yyyy");
//        }
        return  $created->i18nFormat('dd.MM.yyyy');
    }
    protected function _getNiceNumber()
    {
        $phone = $this->_properties['number'];
        $phone = '+38('.substr($phone, 0, 3).') '.substr($phone, 3, 2). ' ' .substr($phone, 5, 2). ' ' .substr($phone, 7, 3)  ;
        return  $phone;
    }
}