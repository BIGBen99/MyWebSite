<?php

require '../dev.ini';
require 'model/model.php';
 
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
} else {
    echo 'Error : invalid post id';
    die;
}

$post = getPost($dsn, $username, $password, $id);
$comments = getComments($dsn, $username, $password, $id);
 
require('view/post.php');
