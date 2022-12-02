<?php
require '../dev.ini';
require 'model/model.php';

$posts = getPosts($dsn, $username, $password);

require 'view/homepage.php';
