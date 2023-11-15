<?php

if($process == 'list') {
    $query = $db->prepare("SELECT todos.*, categories.title as category_title FROM todos 
                            LEFT JOIN categories on categories.id = todos.category_id
                            WHERE todos.user_id = ?");
    $query->execute([get_session('id')]);
    $todos = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        return [
            'success' => true,
            'type' => 'success',
            'data' => $todos
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'data' => []
        ];
    }
}elseif($process == 'getsingle'){
    $id = $data['id'];
    $user_id = get_session('id');
    
    $query = $db->query("SELECT * FROM categories WHERE user_id = '$user_id'");
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT todos.*, c.title as category_title FROM todos 
                        LEFT JOIN categories c on c.id = todos.category_id
                        WHERE todos.id = ? && todos.user_id = ?");
    $query->execute([$id,$user_id]);
    $todos = $query->fetch(PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        return [
            'success' => true,
            'type' => 'success',
            'data' => ['todos' => $todos, 'categories' => $categories]
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'data' => []
        ];
    }
}