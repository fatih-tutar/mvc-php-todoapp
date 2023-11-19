<?php

if($process == 'list') {

    $query = $db->prepare('SELECT todos.*, categories.title as category_title FROM todos 
                            LEFT JOIN categories ON todos.category_id = categories.id
                            WHERE todos.user_id = ? && status = ? 
                            ORDER BY start_date ASC');
    $query->execute([get_session('id'), 'w']);
    $workingTodos = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT status, count(todos.id) as statusSum, (count(todos.id) * 100 / (SELECT COUNT(id) FROM todos WHERE user_id = ?)) as generalSum FROM todos WHERE todos.user_id = ? GROUP BY todos.status");
    $query->execute([get_session('id'),get_session('id')]);
    $todos = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        return [
            'success' => true,
            'type' => 'success',
            'data' => ['todos' => $todos, 'workingTodos' => $workingTodos]
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'data' => []
        ];
    }
}