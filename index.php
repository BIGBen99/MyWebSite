<?php
require('../mywebsite.php');

$_SESSION['dsn'] = $dsn;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

require('controller/Router.php');

$router = new \BIGBen\MyWebSite\Controller\Router();
$router->routeRequest();
