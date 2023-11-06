<?php

if($process == 'add') {

    if(!$data['title']){
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Enter the category title, please.'
        ];
    }

    $title = $data['title'];
    $query = $db->prepare("SELECT *, CONCAT(name,' ',surname) as fullname FROM users WHERE email=? && password=?");
    $query->execute([$email,$password]);
    
    if($query->rowCount()){
        $user = $query->fetch(PDO::FETCH_ASSOC); 
        
        add_session('id',$user['id']);
        add_session('name',$user['name']);
        add_session('surname',$user['surname']);
        add_session('fullname',$user['fullname']);
        add_session('email',$user['email']);
        add_session('login',true);

        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Login successful',
            'data' => $user,
            'redirect' => 'home'
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Username or password is incorrect'
        ];
    }
}