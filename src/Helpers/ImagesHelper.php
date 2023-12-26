<?php


namespace App\Helpers;

use claviska\SimpleImage;
use Cake\Utility\Text;
use PhpParser\Node\Stmt\DeclareDeclare;
use App\Helpers\TinyPngHelper;

class ImagesHelper
{
    public $maxSize = 8000000; //8Mb
    public static $minWight = 1110; //px
    public static $minHeight = 580; //px
    public static $resize = false;

    public static function generateFolder($path = '', $cmod = 0777, $recursive = true){

        if (!is_dir($path)) {
            return mkdir($path, $cmod, $recursive);
        }
        return false;
    }

    public static function generateName($uploadDir, $name) {
        self::generateFolder($uploadDir);
        $explode = explode('.', $name);
        $ext = '.' . end($explode);
        $name = explode('-', Text::uuid())[0] . $ext;
        while (file_exists($uploadDir . $name)) {
            $name = explode('-', Text::uuid())[0] . $ext;
        }
        return $name;
    }
    public static function checkFile($tmpImg){

        if(empty($tmpImg['tmp_name'])) return ['error' => 'Failed upload'];
        $allow_types = array("1", "2", "3", "9", "10", "11");
        $imagetype = exif_imagetype($tmpImg['tmp_name']);
        if (!in_array($imagetype, $allow_types)) {
            return 'Формат зоображення має бути: .jpg чи .png';
        }
        if(self::$minWight && self::$minWight){
            $size = getimagesize($tmpImg['tmp_name']);
            if($size[0] < self::$minWight || $size[1] < self::$minHeight){
                return 'Обкладинка повнинна мати розширення не менше ніж <b>' . self::$minWight . 'x' . self::$minHeight . '</b>';
            }
        }
        return false;
    }
    public static function uploadBlogContentImage($data, $root, $name = false)
    {
        $file = $data;
        $root_service = WWW_ROOT . $root;
        $root_site = '/' . $root;
        if(!$name){
            $name = self::generateName($root_service, $file['name']);
        } else {
            $explode = explode('.', $file['name']);
            $ext = '.' . end($explode);
            $name = $name.$ext;
        }
        move_uploaded_file($file['tmp_name'], $root_service . $name);
//        TinyPngHelper::tinify($root_service . $name);
        return $root_site . $name;
    }

    public static function uploadImage($data, $root)
    {
        $file = $data;
        $check = self::checkFile($data);
        if($check){
            return ['error' => $check];
        }
        $root_service = WWW_ROOT . $root;
        $root_site = '/' . $root;
        $name = self::generateName($root_service, $file['name']);
        $bool = move_uploaded_file($file['tmp_name'], $root_service . $name);
        if (!$bool) {
            return ['error' => 'Внутрішня помилка'];
        } else if(self::$minWight && self::$minWight && self::$resize){
            $img = new SimpleImage($root_service.$name);
            $img->fitToWidth(self::$minWight);
            $img->toFile($root_service.$name, '', 100);
        }
        return ['error' => false, 'name' => $name, 'road' => $root_site.$name];
    }

    public static function resize_file($path_to_file, $new_width, $new_height, $prefix, $name){
        $size = getimagesize(WWW_ROOT_USE.$path_to_file);
        $img_small = new SimpleImage(WWW_ROOT_USE.$path_to_file);
        $new_name = $prefix.$name;
        $path_to_file = str_replace($name, $new_name, $path_to_file);
//        if($img_small->getHeight() > $img_small->getWidth()){
        if($size[1] > $size[0]){
            $new_width = null;
        } else {
            $new_height = null;
        }
        $img_small->resize($new_width, $new_height);
        $img_small->toFile(WWW_ROOT_USE.$path_to_file,'',100);
        return $path_to_file;
    }

}