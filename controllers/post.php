<?php
// controllers/post.php

require_once 'model/post.php';
require_once 'model/comment.php';

function post(string $dsn, string $username, string $password, int $id)
{
	$post = getPost($dsn, $username, $password, $id);
	$comments = getComments($dsn, $username, $password, $id);

	require 'views/post.php';
}
