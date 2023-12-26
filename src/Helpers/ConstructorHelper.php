<?php

namespace App\Helpers;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;


class ConstructorHelper
{
    public static function mySort($f1,$f2)
    {
        if(strlen($f1) < strlen($f2)) return 1;
        elseif(strlen($f1) > strlen($f2)) return -1;
        else return 0;
    }

    public static function deleteFolder($rootPath)
    {
        if(!is_dir($rootPath)) {return false;}
        $pr = dirname($rootPath);
        $filesToDelete = array();
        $dirsToDelete = array();
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $filesToDelete[] = $filePath;
            } else {
                if ($file->getRealPath() != realpath($pr)) {
                    $dirsToDelete[] = $file->getRealPath();
                }
            }
        }
        $dirsToDelete = array_unique($dirsToDelete);
//        debug($filesToDelete); die;
        foreach ($filesToDelete as $file) {
            unlink($file);
        }
        uasort($dirsToDelete,["app\helpers\ConstructorHelper", "mySort"]);
        foreach ($dirsToDelete as $dir) {
            if ($dir !== realpath($rootPath)) {
                rmdir($dir);
            }
        }
        rmdir(realpath($rootPath));
    }
}