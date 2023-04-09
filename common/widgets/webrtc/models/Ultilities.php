<?php
namespace common\widgets\webrtc\models;

class Ultilities
{

   public static function recursiveDirectoryCopy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);

        while (($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                $srcFile = $src . '/' . $file;
                $dstFile = $dst . '/' . $file;

                if (is_dir($srcFile)) {
                    self::recursiveDirectoryCopy($srcFile, $dstFile);
                } else {
                    copy($srcFile, $dstFile);
                }
            }
        }

        closedir($dir);
    }
}