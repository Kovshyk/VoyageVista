<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Admin extends Entity {
    protected function _setPass($pass)
    {
        if (strlen($pass) > 0) {
            return (new DefaultPasswordHasher)->hash($pass);
        }
    }

}