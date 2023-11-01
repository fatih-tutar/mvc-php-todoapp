<?php

function route($index){
    global $config;
    return $config['route'][$index] ?? false;
}

function view($viewName, $pageData = []){
    $data = $pageData;
    if(file_exists(BASEDIR.'/View/'.$viewName.'.php')) require BASEDIR.'/View/'.$viewName.'.php';
    else return false;
}

function model($modelName, $pageData = [], $data_process = null){
    global $db;
    if($data_process != null) $process = $data_process;
    $data = $pageData;
    if(file_exists(BASEDIR.'/model/'.$modelName.'.php')) return require BASEDIR.'/model/'.$modelName.'.php';
    else return false;
}

function assets($assetName) {
    return file_exists(BASEDIR.'/public/'.$assetName) ? URL.'/public/'.$assetName : false;
}

function lang($text) {
    global $lang;
    return isset($lang[$text]) ? $lang[$text] : $text;
}

function add_session($index,$value){
    $_SESSION[$index] = $value;
}

function get_session($index){
    return isset($_SESSION[$index]) ? $_SESSION[$index] : false;
}

function get_cookie($index){
    return isset($_COOKIE[$index]) ? $_COOKIE[$index] : false;
}

function post($index){
    return isset($_POST[$index]) ? htmlspecialchars(trim($_POST[$index])) : false;
}

function get($index){
    return isset($_GET[$index]) ? htmlspecialchars(trim($_GET[$index])) : false;
}

function redirect($link){
    header('Location:'.URL.$link);
}

function url($url){
    global $config;
    return URL.'/'.$config['lang'].'/'.$url;
}