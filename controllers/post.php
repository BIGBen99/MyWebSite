<?php
// controllers/post.php

require_once 'model/model.php';

function post($dsn, $username, $password, $id)
{
	$post = getPost($dsn, $username, $password, $id);
	$comments = getComments($dsn, $username, $password, $id);

	require 'view/post.php';
}