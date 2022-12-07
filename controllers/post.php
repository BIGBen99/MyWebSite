<?php
// controllers/post.php

require_once 'model/post.php';
require_once 'model/comment.php';

function post(string $dsn, string $username, string $password, int $id) {
    $postRepository = new PostRepository();
    $commentRepository = new CommentRepository();
    
    $postRepository->connection = new DatabaseConnection();
    $post = $postRepository->getPost($dsn, $username, $password, $id);
    
    $commentRepository->connection = new DatabaseConnection();
    $comments = $commentRepository->getComments($dsn, $username, $password, $id);

    require 'views/post.php';
}
