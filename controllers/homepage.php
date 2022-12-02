<?php
// controllers/homepage.php

require_once 'model/model.php';

function homepage($dsn, $username, $password) {
	$posts = getPosts($dsn, $username, $password);

	require 'view/homepage.php';
}