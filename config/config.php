<?php

const BASEDIR = '/Applications/MAMP/htdocs/Patika/mvc-php-todoapp';
const URL = 'http://localhost:8888/Patika/mvc-php-todoapp';
const DEV_MODE = true;

try {
    $db = new PDO('mysql:host=localhost; dbname=patika;', 'root', 'root');
} catch (PDOException $e) {
    echo $e->getMessage();
}