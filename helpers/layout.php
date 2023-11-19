<?php

function status($status){
    if($status == 'a'){
        return [
            'title' => 'Active',
            'color' => 'success',
            'icon'  => 'fa fa-check'
        ];
    }else if($status == 'p'){
        return [
            'title' => 'Passive',
            'color' => 'secondary',
            'icon'  => 'fa fa-trash'
        ];
    }else{
        return [
            'title' => 'Working',
            'color' => 'info',
            'icon'  => 'fa fa-info'
        ];
    }
}