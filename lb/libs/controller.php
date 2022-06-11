<?php
/**
 * Created by PhpStorm.
 * User: worti
 * Date: 04.04.2022
 * Time: 20:07
 */

namespace lb\libs;

use lb\libs\View;

class controller
{

    public $Route = null;
    public $Config = null;
    private $View = null;
    public $viewParam = [
        'content' => 'content',
        'title' => 'App',
        'lang' => 'RU',
        'layout' => true,
    ];

    function __construct()
    {

    }

    function showView($name, $variable = [])
    {
        $this->View = new View($this->viewParam, $this->Config);
        $this->View->variable = $variable;

        return $this->View->draw($name);
    }

}