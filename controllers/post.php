<?php
// controllers/post.php

require_once 'model/post.php';
require_once 'model/comment.php';

function post(string $dsn, string $username, string $password, int $id) {
    $postRepository = new PostRepository();
    $post = $postRepository->getPost($dsn, $username, $password, $id);
    $comments = getComments($dsn, $username, $password, $id);

    require 'views/post.php';
}
