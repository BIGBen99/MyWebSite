<?php
    require '../dev.ini';

    try {
        $database = new PDO($dsn, $username, $password);
    } catch(Exception $e) {
	die('Error : '.$e->getMessage());
    }

    $statement = $database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
    $posts = [];
    while (($row = $statement->fetch())) {
	$post = [
    	    'title' => $row['title'],
    	    'french_creation_date' => $row['date_creation_fr'],
    	    'content' => $row['content'],
	];
	$posts[] = $post;
    }

    require 'templates/homepage.php';
?>
