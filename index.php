<?php
// index.php

require '../dev.ini';
require_once 'controllers/add_comment.php';
require_once 'controllers/homepage.php';
require_once 'controllers/post.php';

if (isset($_GET['action']) && $_GET['action'] !== '') {
	if ($_GET['action'] === 'post') {
    	if (isset($_GET['id']) && $_GET['id'] > 0) {
        	$id = $_GET['id'];

        	post($dsn, $username, $password, $id);
    	} else {
        	echo 'Erreur : aucun identifiant de billet envoyé';

        	die;
    	}
	} elseif ($_GET['action'] === 'addComment') {
    	if (isset($_GET['id']) && $_GET['id'] > 0) {
        	$id = $_GET['id'];

        	addComment($dsn, $username, $password, $id, $_POST);
    	} else {
        	echo 'Erreur : aucun identifiant de billet envoyé';

        	die;
    	}
	} else {
    	echo "Erreur 404 : la page que vous recherchez n'existe pas.";
	}
} else {
	homepage($dsn, $username, $password);
}