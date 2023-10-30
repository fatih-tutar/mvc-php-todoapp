<?php

if(route(0) == 'home') {
    view('home/home',[
        'name' => 'Fatih',
        'surname' => 'Tutar'
    ]);
}