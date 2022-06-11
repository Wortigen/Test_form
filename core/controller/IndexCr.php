<?php

namespace Core\controller;

use lb\libs\controller;

class IndexCr extends controller
{

    public function index(){

        return $this->showView('start');
    }

    public function addUser(){
        $this->viewParam['layout'] = false;

        return $this->showView('error_ans',[
            'errors' => [],
        ]);
//        return $this->showView('success');
    }

}