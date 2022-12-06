<?php

function getPosts(string $dsn, string $username, string $password) {
   	$database = dbConnect($dsn, $username, $password);

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

function getPost(string $dsn, string $username, string $password, int $id) {
    $database = dbConnect($dsn, $username, $password);

    $statement = $database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?");
    $statement->execute([$id]);
    $row = $statement->fetch();
    $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['french_creation_date'],
        'content' => $row['content'],
        'id' => $row['id'],
    ];

  	return $post;
}

function dbConnect(string $dsn, string $username, string $password) {
    $database = new PDO($dsn, $username, $password);

    return $database;
}
