<?php
    require '../dev.ini';
    require 'model/model.php';

    $post = getPosts($dsn, $username, $password);

    require 'view/homepage.php';
?>
