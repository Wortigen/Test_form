<?php

namespace lb\libs;


class FileLog
{
    private static $File = '';

    public static function AddLog($message = 'None', $fileLog = ''){
        $config = include __DIR__ . '/../../config/config.php';
        self::CheckExistFile($config['log'],$fileLog);

        $file = fopen(self::$File,'a');
        fwrite($file,$message."\n\r");
        fclose($file);
    }

    private static function CheckExistFile($config,$fileName){
        if($fileName != ''){
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= $config['path'].'/'.$fileName;
        } else {
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= $config['path'].'/'.$config['default'];
        }

        if(!file_exists($path)){
            $file = fopen($path,'w');
            fwrite($file,"\n\r");
            fclose($file);
        }

        self::$File = $path;
    }
}