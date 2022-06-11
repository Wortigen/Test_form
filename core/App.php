<?php

namespace Core;

use lb\libs\Route;
use lb\libs\View;
use lb\libs\db;

class App
{
    private $params = null;
    private $errors = [];

    public function __construct($p = null)
    {
        $this->params = $p;
        if(!$this->Required()){
            $this->errorShow();
        }
    }

    public function run()
    {
        if ($this->params) {

            if ($this->Required()) {
                $rout = new Route($this->params['route']);
                $controller = $rout::getController();

                $controller->Route = $rout;
                $controller->Config = $this->params['config'];

                echo $controller->{$rout::getAction()}();
            }

        } else {
            $this->errors[] = [
                'title' => 'Ошибка параметров запуска->',
                'message' => 'Ошибка файлов конфигурации',
            ];
        }
    }

    private function errorShow()
    {
        $viewParam = [
            'title' => 'App error',
            'lang' => 'RU',
            'layout' => false,
        ];

        $view = new View($viewParam, $this->params['config']);
        $view->variable = [
            'errors' => $this->errors,
        ];
        echo $view->draw($this->params['config']['error']['default']);
    }

    private function Required()
    {
        $ok = true;
        $err = [];

        if (isset($this->params['config']['requirements']['PHP'])) {
            if(doubleval($this->params['config']['requirements']['PHP']) > phpversion()) {
                $ok = false;
                $err = [
                    'title' => 'Версия PHP не подходит->',
                    'message' => 'PHP текущая ' . phpversion() . '; необходима ' . $this->params['config']['requirements']['PHP'],
                ];
                $this->errors[] = $err;
            }
            $err = [];
        } elseif (isset($this->params['config']['requirements']['MySql'])) {
            $db = new db($this->params['db']);
            if (!$db::TestConnect()) {
                $ok = false;
                $err = [
                    'title' => 'MySql ошибка->',
                    'message' => self::errorShow(),
                ];
                $this->errors[] = $err;

            }

            if($this->params['config']['requirements']['MySql'] != $db::GetVer() && !empty($err)){
                $ok = false;
                $err = [
                    'title' => 'MySql ошибка->',
                    'message' => 'MySql текущая версия ' . $db::GetVer() . '; необходима ' . $this->params['config']['requirements']['MySql'],
                ];
                $this->errors[] = $err;
            }
            $err = [];
        }

        return $ok;
    }
}