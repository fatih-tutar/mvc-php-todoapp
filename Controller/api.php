<?php

if (route(1) == 'addtodo') {
    $post = filter($_POST);
    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

    if (!$post['title']) {

        $status = 'error';
        $title = 'Ops! Warning!';
        $msg = 'Please enter a title.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();

    }

    if (!$post['description']) {

        $status = 'error';
        $title = 'Ops! Warning!';
        $msg = 'Please enter a description.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();

    }

    if ($post['start_date_time'] && $post['start_date']) $start_date = $post['start_date'].' '.$post['start_date_time'];
    if ($post['end_date_time'] && $post['end_date']) $end_date = $post['end_date'].' '.$post['end_date_time'];

    if($post['category_id']){
        $user_id = get_session('id');
        $c_id = $post['category_id'];
        $query = $db->query("SELECT id FROM categories WHERE user_id = '$user_id' && id = '$c_id' ");
        $category = $query->fetch(PDO::FETCH_ASSOC);
        if(!$category){
            $status = 'error';
            $title = 'Operation failed';
            $msg = 'You can only add categories that you have created.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }

    $query = $db->prepare("INSERT INTO todos SET
        todos.title=?,
        todos.description=?,
        todos.color=?,
        todos.progress=?,
        todos.status=?,
        todos.start_date=?,
        todos.end_date=?,
        todos.category_id=?,
        todos.user_id=?
    ");

    $insert = $query->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        intval($post['progress']) ?? 1,
        $post['status'] ?? 'a',
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        get_session('id')
    ]);

    if(isset($insert)){
        $status = 'success';
        $title = 'Transaction successful';
        $msg = 'Added to your todo list';
        echo json_encode([
            'status' => $status, 
            'title' => $title, 
            'msg' => $msg,
            'redirect' => url('todo/list')
        ]);
        exit();
    }else{
        $status = 'error';
        $title = 'Operation failed';
        $msg = 'An unexpected error occurred';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
}else if(route(1) == 'removetodo'){
    $post = filter($_POST);
    if(!$post['id']){
        $status = 'error';
        $title = 'Ops! Warning!';
        $msg = 'ID information could not be obtained';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    } else {
        $id = $post['id'];
        $user = get_session('id');
        $query = $db->query("DELETE FROM todos WHERE todos.id = '$id' && todos.user_id = '$user' ");
        if($query){
            $status = 'success';
            $title = 'Transaction successul';
            $msg = 'It removed from the list';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'id' => $id]);
            exit();
        }else{
            $status = 'error';
            $title = 'Ops! Warning!';
            $msg = 'An error occurred';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }
}else if (route(1) == 'edittodo') {
    $post = filter($_POST);
    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

    if (!$post['title']) {

        $status = 'error';
        $title = 'Ops! Warning!';
        $msg = 'Please enter a title.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();

    }

    if (!$post['description']) {

        $status = 'error';
        $title = 'Ops! Warning!';
        $msg = 'Please enter a description.';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();

    }

    if ($post['start_date_time'] && $post['start_date']) $start_date = $post['start_date'].' '.$post['start_date_time'];
    if ($post['end_date_time'] && $post['end_date']) $end_date = $post['end_date'].' '.$post['end_date_time'];

    if($post['category_id']){
        $user_id = get_session('id');
        $c_id = $post['category_id'];
        $query = $db->query("SELECT id FROM categories WHERE user_id = '$user_id' && id = '$c_id' ");
        $category = $query->fetch(PDO::FETCH_ASSOC);
        if(!$category){
            $status = 'error';
            $title = 'Operation failed';
            $msg = 'You can only add categories that you have created.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }

    $query = $db->prepare("UPDATE todos SET
        todos.title=?,
        todos.description=?,
        todos.color=?,
        todos.progress=?,
        todos.status=?,
        todos.start_date=?,
        todos.end_date=?,
        todos.category_id=?,
        todos.user_id=?
        WHERE todos.id = ? && todos.user_id = ?
    ");

    $update = $query->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        intval($post['progress']) ?? 1,
        $post['status'] ?? 'a',
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        get_session('id'),
        $post['id'],
        get_session('id')
    ]);

    if(isset($update)){
        $status = 'success';
        $title = 'Transaction successful';
        $msg = 'Updated to your todo list item';
        echo json_encode([
            'status' => $status, 
            'title' => $title, 
            'msg' => $msg,
            'redirect' => url('todo/edit/'.$post['id'])
        ]);
        exit();
    }else{
        $status = 'error';
        $title = 'Operation failed';
        $msg = 'An unexpected error occurred';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }
}