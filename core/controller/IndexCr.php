<?php

namespace Core\controller;

use lb\libs\controller;
use lb\model\User;

class IndexCr extends controller
{

    public function index(){

        return $this->showView('start');
    }

    public function addUser(){
        $this->viewParam['layout'] = false;
        $res_error = [];
        if($_POST){
          $user = new User();
          $user->uploadData($_POST);

          if($_POST['pass'] == $_POST['repass']){
              $user->password = $_POST['pass'];
              $user->id = 0;
              if($user->save()) {
                  return $this->showView('success');
              } else {
                  $res_error = $user->errors;
              }
          }else{
              $res_error[] = 'Пароли не совпадают';
          }

        } else {
            $res_error[] = 'No Data enter';
        }

        return $this->showView('error_ans',[
            'errors' => $res_error,
        ]);
    }

}