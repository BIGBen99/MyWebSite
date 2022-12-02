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

function getPost($dsn, $username, $password, $id) {
    try {
    	$database = new PDO($dsn, $username, $password);
    } catch(Exception $e) {
    	die('Error : ' . $e->getMessage());
    }

    $statement = $database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?");
    $statement->execute([$id]);
    $row = $statement->fetch();
    $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['french_creation_date'],
        'content' => $row['content'],
    ];

  	return $post;
}

function getComments($dsn, $username, $password, $id) {
    try {
    	$database = new PDO($dsn, $username, $password);
    } catch(Exception $e) {
    	die('Error : ' . $e->getMessage());
    }

    $statement = $database->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
    $statement->execute([$id]);
    $comments = [];
    while (($row = $statement->fetch())) {
    	$comment = [
            'author' => $row['author'],
            'french_comment_date' => $row['french_comment_date'],
            'comment' => $row['comment'],
    	];

    	$comments[] = $comment;
    }
    return $comments;
}
