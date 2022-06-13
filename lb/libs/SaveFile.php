<?php
namespace lb\libs;

use lb\libs\FileCSV;

class SaveFile
{
    public $table = '';
    private $config = [];
    public $fields = [];
    public $errors = [];
    private $file = null;

    public function __construct()
    {

        $config = include $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
        $this->config = $config['resources']['fileSave'];
        if(!empty($this->config)){
            $this->LoadFileTable();
            $this->attachFile();
        }

    }

    private function LoadFileTable(){
        $this->fields = include $_SERVER['DOCUMENT_ROOT'] . $this->config['path'] . $this->config['table'] . '/' . $this->table .'.php';

        foreach ($this->fields as $key => $attr){
            $this->{$key} = null;
        }
    }

    private function attachFile(){
        $this->file = new FileCSV($_SERVER['DOCUMENT_ROOT'] . $this->config['path'] . $this->config['savePath'] . '/' . $this->table);
        if(!$this->fileLoad() && (isset($this->config['exist']) && $this->config['exist'] == 'always')){
            $column = [];
            foreach($this->fields as $key => $attr){
                $column[] = $key;
            }
            $this->file->createFile($column);
        }
    }

    public function uploadData($data){

        if(isset($data[$this->table])){
            $data = $data[$this->table];
        }

        foreach ($this->fields as $key => $value){
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }

    }

    private function fileLoad(){
        $result = false;
        if($this->file instanceof FileCSV){
            $result = $this->file->fileExist();
            if(!$result){
                $this->errors[] = 'File not exist';
            }
        } else {
            $this->errors[] = 'Object file base does not match need value';
        }
        return $result;
    }

    private function validate(){
        $result = true;
//        $this->attachFile();
//        $result = ($this->fileLoad())? true : false;
//        if($result) {
//            $this->file->readFile();
//            echo '<pre>'.print_r($this->file->get_rows(), true).'</pre>';
//            die():
//            foreach ($this->fields as $key => $attr) {
//
//            }
//        } else {
//            $result = false;
//        }

        $result = $this->BeforeAction($result);
        return $result;
    }

    public function CheckValidate(){
        return $this->validate();
    }

    public function BeforeAction($result = false){
        return $result;
    }

    public function save($data = []){
        $result = true;
        if($this->fileLoad()) {
            if (!empty($data)) {
                $data = $this->uploadData($data);
            }

            if ($this->validate()) {
                $this->WriteToFile();
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        $this->AfterAction($result,$data);
        return $result;
    }

    public function update($data = []){
        $result = true;

        if($this->fileLoad()) {
            if (!empty($data)) {
                $data = $this->uploadData($data);
            }

            if ($this->validate()) {
                $this->WriteToFile();
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        $this->AfterAction($result);
        return $result;
    }

    public function Delete($field_search = []){
        $result = true;

        if($this->fileLoad()) {

        } else {
            $result = false;
        }

        $this->AfterAction();
        return $result;
    }

    public function AfterAction($result= false){

    }

    private function WriteToFile(){
        $data = [];
        foreach($this->fields as $key => $attr){
            $data[] = $this->{$key};
        }

        $this->file->updateFile($data);
    }

    public function AsArray(){
        $result = [];

        foreach ($this->fields as $key => $value){
            $result[$key] = $this->{$key};
        }

        return $result;

    }

}