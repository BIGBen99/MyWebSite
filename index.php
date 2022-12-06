<?php
// index.php

require '../dev.ini';
require_once 'controllers/add_comment.php';
require_once 'controllers/homepage.php';
require_once 'controllers/post.php';

try {
	if (isset($_GET['action']) && $_GET['action'] !== '') {
		if ($_GET['action'] === 'post') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$id = $_GET['id'];
	
				post($dsn, $username, $password, $id);
			} else {
				throw new Exception('Aucun identifiant de billet envoyé');
			}
		} elseif ($_GET['action'] === 'addComment') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$id = $_GET['id'];
	
				addComment($dsn, $username, $password, $id, $_POST);
			} else {
				throw new Exception('Aucun identifiant de billet envoyé');
			}
		} else {
			throw new Exception("La page que vous recherchez n'existe pas.");
		}
	} else {
		homepage($dsn, $username, $password);
	}
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
	
    require 'views/error.php';
}
