<?php

namespace lb\libs;


class Route
{
    private static $Route = null;
    private static $act = null;
    public $domain = null;
    public $urlPathDomain = null;
    public static $request = null;
    public $params = null;

    function __construct($r)
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->urlPathDomain = $_SERVER['HTTP_REFERER'];
        self::$request = $_SERVER['REQUEST_URI'];
        self::$Route = $r;
    }

    static function getController(){

        if(isset(self::$Route[self::$request])) {
            $cr_name = '\Core\controller\\' . self::$Route[self::$request]['cr'];
            return new $cr_name;
        } else {
            return null;
        }

    }

    static function getAction(){
        return self::$Route[self::$request]['action'];
    }

    static function BuildUrl($link = ''){
        return $_SERVER['HTTP_REFERER'].$link;
    }




}