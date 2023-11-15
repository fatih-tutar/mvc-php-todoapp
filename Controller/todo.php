<?php

if (!get_session('login') || get_session('login') != true) redirect('/login');

if (route(0) == 'categories' && !route(1)) {

    view('categories/home');

}else if (route(0) == 'todo' && route(1) == 'add'){
    
    $result = model('categories',[],'list');
    view('todo/add', $result['data']);

}else if (route(0) == 'todo' && route(1) == 'list'){

    $result = model('todo',[],'list');
    view('todo/list', $result['data']);

}else if(route(0) == 'todo' && route(1) == 'edit' && is_numeric(route(2))){

    $result = model('todo',['id' => route(2)],'getsingle');
    view('todo/edit', $result['data']);    
}