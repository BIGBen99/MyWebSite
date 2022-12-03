<?php
// model/comment.php

function getComments($dsn, $username, $password, $post)
{
	$database = commentDbConnect($dsn, $username, $password);
	$statement = $database->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
	$statement->execute([$post]);

	$comments = [];
	while (($row = $statement->fetch())) {
    	$comment = [
        	'author' => $row['author'],
        	'french_creation_date' => $row['french_creation_date'],
        	'comment' => $row['comment'],
    	];

    	$comments[] = $comment;
	}

	return $comments;
}

function createComment($dsn, $username, $password, $post, $author, $comment)
{
	$database = commentDbConnect($dsn, $username, $password);
	$statement = $database->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	$affectedLines = $statement->execute([$post, $author, $comment]);

	return ($affectedLines > 0);
}

function commentDbConnect($dsn, $username, $password)
{
	try {
    	$database = new PDO($dsn, $username, $password);

    	return $database;
	} catch(Exception $e) {
    	die('Error : '.$e->getMessage());
	}
}