<?php

if($process == 'add') {

    if(!$data['title']){
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Enter the category title, please.'
        ];
    }else{
        $title = $data['title'];
        $query = $db->prepare("INSERT INTO categories SET title = ?, user_id = ?");
        $query->execute([$title,get_session('id')]);
        
        if($query->rowCount()){

            return [
                'success' => true,
                'type' => 'success',
                'message' => 'Category added successfully.',
                'redirect' => '/categories/list'
            ];
        }else{
            return [
                'success' => false,
                'type' => 'danger',
                'message' => 'Error : Category could not be added!'
            ];
        }
    }
}elseif($process == 'list') {
    $query = $db->prepare("SELECT * FROM categories WHERE user_id = ?");
    $query->execute([get_session('id')]);
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        return [
            'success' => true,
            'type' => 'success',
            'data' => $categories
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'data' => []
        ];
    }
}elseif($process == 'remove'){
    $id = $data['id'];
    $query = $db->prepare("DELETE FROM categories WHERE id = ? && user_id = ?");
    $query->execute([$id,get_session('id')]);
    if($query->rowCount()){
        return[
            'success' => true,
            'type' => 'success',
            'message' => 'Category deleted successfully.',
            'redirect' => '/categories/list'
        ];
    }else{
        return[
            'success' => false,
            'type' => 'danger',
            'message' => 'Category could not be deleted!',
        ];
    }
}elseif($process == 'getsingle'){
    $id = $data['id'];
    $query = $db->prepare("SELECT * FROM categories WHERE id = ? && user_id = ?");
    $query->execute([$id,get_session('id')]);
    $category = $query->fetch(PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        return [
            'success' => true,
            'type' => 'success',
            'data' => $category
        ];
    }else{
        return [
            'success' => false,
            'type' => 'danger',
            'data' => []
        ];
    }
}elseif($process == 'edit'){
    $id = $data['id'];
    if(!$data['title']){
        return [
            'success' => false,
            'type' => 'danger',
            'message' => 'Enter the category title, please.'
        ];
    }else{
        $title = $data['title'];
        $query = $db->prepare("UPDATE categories SET title = ? WHERE id = ? && user_id = ?");
        $edit = $query->execute([$title,$id,get_session('id')]);
        if($edit){
            return[
                'success' => true,
                'type' => 'success',
                'message' => 'Category updated successfully.',
                'redirect' => '/categories/edit/'.$id
            ];
        }else{
            return[
                'success' => false,
                'type' => 'danger',
                'message' => 'Category could not be updated!',
            ];
        }
    }
}
