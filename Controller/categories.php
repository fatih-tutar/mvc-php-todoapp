<?php

if(!get_session('login') || get_session('login') != true) redirect('/login');

if(route(0) == 'cetagories' && !route(1)) {
    view('categories/home');
}else if(route(0) == 'categories' && route(1) == 'list'){
    $result = model('categories',[],'list');
    view('categories/list', $result['data']);
}else if(route(0) == 'categories' && route(1) == 'add'){
    if(isset($_POST['submit'])){
        $_SESSION['post'] = $_POST;
        $title = post('title');

        $result = model('categories',['title' => $title],'add');
        add_session('error',[
            'message' => $result['message'] ?? '',
            'type' => $result['type'] ?? ''            
        ]);
        if($result['success'] == true) {
            if(isset($result['redirect'])){
                redirect($result['redirect']);
            }
        }
    }
    view('categories/add');
}else if(route(0) == 'categories' && route(1) == 'remove' && is_numeric(route(2))){
    $result = model('categories',['id' => route(2)],'remove');
    add_session('error',[
        'message' => $result['message'] ?? '',
        'type' => $result['type'] ?? ''            
    ]);
    if($result['success'] == true) {
        if(isset($result['redirect'])){
            redirect($result['redirect']);
        }
    }
}else if(route(0) == 'categories' && route(1) == 'edit' && is_numeric(route(2))){
    if(isset($_POST['submit'])){
        $_SESSION['post'] = $_POST;
        $title = post('title');
        $result = model('categories',['id' => route(2), 'title' => $title],'edit');
        add_session('error',[
            'message' => $result['message'] ?? '',
            'type' => $result['type'] ?? ''            
        ]);
        if($result['success'] == true) {
            if(isset($result['redirect'])){
                redirect($result['redirect']);
            }
        }
    }else{
        $result = model('categories',['id' => route(2)],'getsingle');
        view('categories/edit', $result['data']);
    }    
}