<?php

if(!get_session('login') || get_session('login') != true) redirect('/login');

if(route(0) == 'cetagories' && !route(1)) {
    // if(isset($_POST['submit'])){
    //     $_SESSION['post'] = $_POST;
    //     $email = post('email');
    //     $password = post('password');

    //     $result = model('auth/login',['email' => $email,'password' => $password],'login');

    //     if($result['success'] == true) {
    //         if(isset($result['redirect'])){
    //             redirect($return['redirect']);
    //         }
    //     }else{
    //         add_session('error',[
    //             'message' => $result['message'] ?? '',
    //             'type' => $result['type'] ?? ''            
    //         ]);
    //     }
    // }
    view('categories/home');
}else if(route(0) == 'categories' && route(1) == 'add'){
    if(isset($_POST['submit'])){
        $_SESSION['post'] = $_POST;
        $title = post('title');

        $result = model('categories',['title' => $title],'add');

        if($result['success'] == true) {
            if(isset($result['redirect'])){
                redirect($result['redirect']);
            }
        }else{
            add_session('error',[
                'message' => $result['message'] ?? '',
                'type' => $result['type'] ?? ''            
            ]);
        }
    }
    view('categories/add');
}else if(route(0) == 'categories' && route(1) == 'edit' && is_numeric(route(2))){
    view('categories/edit');
}