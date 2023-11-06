<?php

const BASEDIR = '/Users/dijital/sites/localhost/patika/mvc-php-todoapp';
const URL = 'http://local.rg/Patika/mvc-php-todoapp';
const DEV_MODE = true;

try {
    $db = new PDO('mysql:host=127.0.0.1; dbname=mvp-php-todoapp;', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}
