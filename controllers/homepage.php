<?php
// controllers/homepage.php

require_once 'model/post.php';

function homepage(string $dsn, string $username, string $password) {
	$posts = getPosts($dsn, $username, $password);

	require 'views/homepage.php';
}
