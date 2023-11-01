<?php

if(get_session('login') && get_session('login') == true) redirect('/home');

if(route(0) == 'login') {
    if(isset($_POST['submit'])){
        $_SESSION['post'] = $_POST;
        $email = post('email');
        $password = post('password');

        $result = model('auth/login',['email' => $email,'password' => $password],'login');

        if($result['success'] == true) {
            if(isset($result['redirect'])){
                redirect($return['redirect']);
            }
        }else{
            add_session('error',[
                'message' => $result['message'] ?? '',
                'type' => $result['type'] ?? ''            
            ]);
        }
    }
    view('auth/login');
}