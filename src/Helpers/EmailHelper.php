<?php


namespace App\Helpers;

use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

class EmailHelper
{
    private static $siteName = 'cataloglutck.com';

    private static function getFrom(){
        return ['no-reply@'.self::$siteName => self::$siteName];
    }

    public static function sendEmailToAdminCall($name,$phone){
        $configTable = TableRegistry::get('Configs');
        $admin_email = $configTable->getConfig('admin_email');

        $mail = new Email();
        $mail
            ->setTemplate('email_call')
            ->setEmailFormat('html')
            ->setFrom(self::getFrom())
            ->setViewVars(['name' => $name,
                           'phone' => $phone])
            ->setTo($admin_email)
            ->setSubject(_('Замовлено дзвінок на сайті '.self::$siteName))
            ->send();

    }

    public static function sendEmailToAdminForm($name, $phone, $product)
    {

        $configTable = TableRegistry::get('Configs');

        $admin_email = $configTable->getConfig('admin_email');
       
        $mail = new Email();
        $mail
            ->setTemplate('email_form')
            ->setEmailFormat('html')
            ->setFrom(self::getFrom())
            ->setViewVars(['name' => $name,
                           'phone' => $phone,
                           'product' => $product ])
            ->setTo($admin_email)
            ->setSubject('Замовлення на сайті'.self::$siteName)
            ->send();

    }

}