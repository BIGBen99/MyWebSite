<?php

function getPosts($dsn, $username, $password) {
    try {
    	$database = new PDO($dsn, $username, $password);
    } catch(Exception $e) {
    	die('Error : ' . $e->getMessage());
    }

    $statement = $database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
    $posts = [];
    while (($row = $statement->fetch())) {
    	$post = [
            'title' => $row['title'],
            'french_creation_date' => $row['french_creation_date'],
            'content' => $row['content'],
            'id' => $row['id'],
    	];

    	$posts[] = $post;
    }
    return $posts;
}
