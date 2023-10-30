<?php

function route($index){
    global $config;
    return $config['route'][$index] ?? false;
}