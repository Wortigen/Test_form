<?php

include __DIR__ . '/core/App.php';

$path_dynamic = __DIR__ .'/lb/libs';
$path_dynamic = scandir($path_dynamic);

foreach ($path_dynamic as $item){
    if(strpos($item,'.php') != null){
        include  __DIR__ . '/lb/libs/'.$item;
    }
}

$path_dynamic = __DIR__ .'/core/controller';
$path_dynamic = scandir($path_dynamic);

foreach ($path_dynamic as $item){
    if(strpos($item,'.php') != null){
        include  __DIR__ . '/core/controller/'.$item;
    }
}