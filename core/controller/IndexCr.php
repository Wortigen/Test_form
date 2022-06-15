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
          $user->name .= ' ' . $_POST['surname'];
          if($_POST['pass'] == $_POST['repass']){
              $user->password = $_POST['pass'];
              if($user->save()) {
                  return $this->showView('success');
              } else {
                  $res_error = $user->errors;
              }
          }else{
              $user->CheckValidate();
              $res_error = $user->errors;
              array_push($res_error,'Пароли не совпадают');
          }

        } else {
            $res_error[] = 'No Data enter';
        }

        return $this->showView('error_ans',[
            'errors' => $res_error,
        ]);
    }

}