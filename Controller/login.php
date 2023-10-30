<?php

if(route(0) == 'login') {
    if(isset($_POST['submit'])){
        add_session('error','Your message added.');
        $email = post('email');
        $password = post('password');
        echo $email."<br/>".$password;
    }
    view('auth/login');
}