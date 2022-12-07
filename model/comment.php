<?php
// model/comment.php

require_once 'lib/database.php';

class Comment {
    public int $id;
    public string $author;
    public string $frenchCreationDate;
    public string $content;
}

class CommentRepository {
    public DatabaseConnection $connection;

    function getComments(string $dsn, string $username, string $password, string $postId): array {
        $statement = $this->connection->getConnection($dsn, $username, $password)->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
        $statement->execute([$postId]);

        $comments = [];
        while (($row = $statement->fetch())) {
    	    $comment = new Comment();
	    $comment->id = $row['id'];
	    $comment->author = $row['author'];
	    $comment->frenchCreationDate = $row['french_comment_date'];
	    $comment->content = $row['comment'];

    	    $comments[] = $comment;
        }

        return $comments;
    }

    function createComment($dsn, $username, $password, $postId, $author, $comment) {
	$statement = $this->connection->getConnection($dsn, $username, $password)->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	$affectedLines = $statement->execute([$postId, $author, $comment]);

	return ($affectedLines > 0);
    }
	
    function updateComment($dsn, $username, $password, $commentId, $comment) {
	$statement = $this->connection->getConnection($dsn, $username, $password)->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
	$statement->execute([$comment, $commentId]);
    }
}
