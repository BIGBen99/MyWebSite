<?php
// controllers/homepage.php

require_once 'model/model.php';

function homepage() {
	$posts = getPosts();

	require 'view/homepage.php';
}