<?php

if($process == 'login') {

    if(!$data['email']){
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Enter your email address, please.'
        ];
    }
    if(!$data['password']){
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Enter your password, please.'
        ];
    }

    $email = $data['email'];
    $password = md5($data['password']);
    $query = $db->prepare("SELECT *, CONCAT(name,' ',surname) as fullname FROM users WHERE email=? && password=?");
    $query->execute([$email,$password]);
    
    if($query->rowCount()){
        $user = $query->fetch(PDO::FETCH_ASSOC); 
        
        add_session('id',$user['id']);
        add_session('name',$user['name']);
        add_session('surname',$user['surname']);
        add_session('fullname',$user['fullname']);
        add_session('password',$user['password']);
        add_session('email',$user['email']);
        add_session('login',true);

        return [
            'success' => true,
            'type' => 'success',
            'message' => 'Login successful',
            'data' => $user,
            'redirect' => '/home'
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Username or password is incorrect'
        ];
    }
}