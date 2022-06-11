<?php
/**
 * Created by PhpStorm.
 * User: worti
 * Date: 04.04.2022
 * Time: 20:11
 */

namespace lb\libs;


class db
{
    private static $SERVER  = null;
    private static $user = null;
    private static $password = null;
    private static $status = null;
    private static $error = null;
    private static $db = null;
    private static $ver = null;

    public function __construct($params = [])
    {
        if(count($params) > 0){
            self::$SERVER = (isset($params['server']))? $params['server'] : null;
            self::$user = (isset($params['user']))? $params['user'] : null;
            self::$password = (isset($params['password']))? $params['password'] : null;
        }

        self::CheckParams();
    }

    public static function isConnect(){
        if(self::$status == 'connect' || self::$status == 'off'){
            return true;
        } else {
            return false;
        }
    }

    private static function CheckParams()
    {
        if(self::$SERVER == null && self::$user == null && self::$password == null){
            self::$status = 'off';
        } elseif(self::$SERVER != null && self::$user != null && self::$password != null){
            self::$status = 'weitConnection';
        } elseif(self::$SERVER == null || self::$user == null || self::$password == null){
            self::$status = 'beforeConnection';
            self::$error = 'Error parameters for connection';
        }
    }

    private static function buildConnection()
    {
        self::CheckParams();
        if (self::$status == 'weitConnection') {
            self::$db = new mysqli(self::$SERVER, self::$user, self::$password);

            if (mysqli_connect_errno()) {
                self::$error = mysqli_connect_error();
            }else{
                self::$status = 'connect';
            }

            self::$ver = self::$db->server_version;
        }
    }

    public static function GetStatus(){
        return self::$status;
    }

    public static function GetVer(){
        return self::$ver;
    }

    private static function clouseConnection(){
        if(self::$status == 'connect') {
            self::$db->close();
            self::$status = 'weitConnection';
        }
    }

    public static function TestConnect(){
        self::buildConnection();
        if(self::isConnect()){
            self::clouseConnection();
            return true;
        }

        return false;
    }
}