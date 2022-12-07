<?php
// controllers/homepage.php

require_once 'model/post.php';

function homepage(string $dsn, string $username, string $password) {
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $posts = $postRepository->getPosts($dsn, $username, $password);

    require 'views/homepage.php';
}
