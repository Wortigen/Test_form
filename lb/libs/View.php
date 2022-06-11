<?php
/**
 * Created by PhpStorm.
 * User: worti
 * Date: 04.04.2022
 * Time: 20:10
 */

namespace lb\libs;

use lb\libs\Route;

class View
{
    private $Config = null;
    private $content = null;
    private $params = null;
    public $variable = null;
    private $Build = false;

    public function __construct($viewParam, $config)
    {
        $this->params = $viewParam;
        $this->Config = $config;
    }

    private function head(){

        foreach ($this->Config['css'] as $style){
            echo '<link rel="stylesheet" href="'.Route::BuildUrl($style).'"/>';
        }
    }

    private function footer(){

        foreach ($this->Config['js'] as $script){
            echo '<script type="text/javascript" src="'.Route::BuildUrl($script).'"></script>';
        }
    }

    private function BuildContent($name){

        if($this->variable != null && is_array($this->variable)) {
            extract($this->variable, EXTR_OVERWRITE);
        }

        ob_start();

        include __DIR__ . '/../..' . $this->Config['pathView'] . $name . '.php';

        $cont = ob_get_contents();
        ob_end_clean();

        return $cont;
    }

    private function BuildLayout(){
        $lay = (isset($this->params['newL']))? $this->params['newL'] : $this->Config['dLayout'];

        $variable = $this->LayoutVariable();
        extract($variable, EXTR_OVERWRITE);

        ob_start();

        include __DIR__ . '/../..' . $this->Config['pathView'] . $lay . '.php';

        $view = ob_get_contents();
        ob_end_clean();

        return $view;

    }

    private function LayoutVariable(){
        $var = [];
        foreach ($this->params as $key => $value){
            switch ($key){
                case 'content':
                    $var[$key] = $this->content;
                    break;
                case 'title':
                    $var[$key] = $this->params['title'];
                    break;
                case 'lang':
                    $var[$key] = $value;
                    break;
                default:break;
            }
        }

        return $var;
    }

    public function draw($name){

        $this->content = $this->BuildContent($name);

        if(!isset($this->params['layout']) || $this->params['layout'] == true){
            $this->Build = $this->BuildLayout();
        } else{
            $this->Build = $this->content;
        }

        return $this->Build;
    }
}