<?php

session_start();

require __DIR__.'/config/config.php';

if(DEV_MODE == true){
    error_reporting(E_ALL);
    ini_set('error_reporting', true);
}else{
    error_reporting(0);
    ini_set('error_reporting', false);
}

foreach(glob(__DIR__.'/helpers/*.php') as $file){
    require $file;
}

$config = array(
    'route' => ['home'],
    'lang'  => 'tr'
);

if(isset($_GET['route'])){
    $regex = '@(?<lang>\b[a-z]{2}\b)?/?(?<route>.+)/?@';
    preg_match($regex, $_GET['route'],$result);
}

if(isset($result['lang'])){
    if(file_exists(BASEDIR.'/language/'.$result['lang'].'.php')){
        $config['lang'] = $result['lang'];
    }
}
require BASEDIR.'/language/'.$config['lang'].'.php';

if(isset($result['route'])){
    $config['route'] = explode("/", $result['route']);
}

if(file_exists(BASEDIR.'/controller/'.$config['route'][0].'.php')){
    require BASEDIR.'/controller/'.$config['route'][0].'.php';
}else{
    echo 'sayfa bulunamadı';
}