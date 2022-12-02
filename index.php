<?php

require '../dev.ini';
require_once 'controllers/homepage.php';
require_once 'controllers/post.php';

if (isset($_GET['action']) && $_GET['action'] !== '') {
	if ($_GET['action'] === 'post') {
    	if (isset($_GET['id']) && $_GET['id'] > 0) {
        	$id = $_GET['id'];

        	post($dsn, $username, $password, $id);
    	} else {
        	echo 'Error : aucun identifiant de billet envoyé';
        	die;
    	}
	} else {
    	echo "Error 404 : la page que vous recherchez n'existe pas.";
	}
} else {
	homepage($dsn, $username, $password);
}