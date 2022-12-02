<?php

require 'model/model.php';
 
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
} else {
    echo 'Error : invalid post id';
    die;
}

$post = getPost($id);
$comments = getComments($id);
 
require('view/post.php');
