<?php

namespace Core\controller;

use lb\libs\controller;

class IndexCr extends controller
{

    public function index(){

        return $this->showView('start');
    }

}