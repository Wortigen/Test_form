<?php

namespace lb\model;

use lb\libs\SaveFile;
use lb\libs\FileLog;

class User extends SaveFile
{
    public $table = 'Users';

    public function __construct()
    {
        return parent::__construct();
    }

    public function AfterAction($result = false)
    {
        $message = '';
        $message = 'User ' . $this->name .' ';
        $message .= 'with e-mail:'.$this->mail .' ';
        if($result == true){
            $message .= 'was success';
        } else {
            $message .= 'was failed';
            $message .= "\n\r";
            foreach ($this->errors as $error){
                $message .= 'Error: '.$error."\n\r";
            }
        }

        $message .= "\n\r";
        FileLog::AddLog($message);
    }
}