<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    require_once '../database/mysql.php';
    $db = new DB();
    //$db->con->query('CREATE TABLE admins(id INTEGER PRIMARY KEY, email TEXT, password TEXT, name TEXT)');
    var_dump($db->con->query('SELECT * FROM posts'));
    var_dump($db->isAdmin('fares', '123456'));
    //header('Location: categories.php');