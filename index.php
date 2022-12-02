<?php
    require '../dev.init';
    require 'model/model.php';

    $post = getPosts($dsn, $username, $password);

    require 'view/homepage.php';
?>
