<?php


if(!get_session('login') && get_session('login') == false) redirect('/login');

if(route(0) == 'home') {
    view('home/home',[
        'name' => 'Fatih',
        'surname' => 'Tutar'
    ]);
}