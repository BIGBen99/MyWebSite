<?php
// controllers/post.php

require_once 'model/model.php';

function post(string $id)
{
	$post = getPost($id);
	$comments = getComments($id);

	require 'view/post.php';
}