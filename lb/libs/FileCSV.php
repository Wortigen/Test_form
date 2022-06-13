<?php

namespace lb\libs;


class FileCSV
{
    private $File = null;
    private $end = '.csv';
    private $path = '';
    public $error = '';
    private $array_column = [];
    private $array_values = [];
    private $array_filter = [];

    public function __construct($path = '')
    {
        $this->path = $path;
    }

    public function fileExist(){
        $result = false;

        if(file_exists($this->path . $this->end)){
            $result = true;
        } else {
            $this->error = 'File not exist';
        }

        return $result;
    }

    public function openFile($t = ''){
        if($this->fileExist()) {
            $this->File = fopen($this->path . $this->end,$t);
            if(!$this->File){
                ini_set('display_errors',1);
                error_reporting(E_ALL);
            }
        }
    }

    public function createFile($column = []){
        $this->File = fopen($this->path . $this->end,'w');
        fputcsv($this->File, $column);
        $this->closeFile();
    }

    public function updateFile($data = []){
        if($this->fileExist()) {
            $this->openFile("a");
            fputcsv($this->File, $data);
            $this->closeFile();
        }
    }

    public function readFile(){
        if($this->fileExist()) {
            $this->openFile("r");

            $f = true;

            while($data = fgetcsv($this->File, null, ",") !== false){
                if($f == true){
                    $this->array_column = $data;
                    $f = false;
                } else{
                    $this->array_values[] =  $data;
                }
            }

            $this->closeFile();

        }
    }

    public function get_columns(){
        return $this->array_column;
    }

    public function get_rows(){
        return $this->array_values;
    }

    public function get_count(){
        return count($this->array_values);
    }

    public function get_filter_count(){
        return count($this->array_filter);
    }

    public function filter_array($filter = []){

    }

    private function SaveUpload(){

    }

    public function closeFile(){
        if($this->File != null) {
            fclose($this->File);
            $this->File = null;
        }
    }
}