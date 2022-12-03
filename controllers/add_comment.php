<?php
// controllers/add_comment.php

require_once 'model/comment.php';

function addComment($dsn, $username, $password, string $post, array $input)
{
	$author = null;
	$comment = null;
	if (!empty($input['author']) && !empty($input['comment'])) {
    	$author = $input['author'];
    	$comment = $input['comment'];
	} else {
    	die('Les données du formulaire sont invalides.');
	}

	$success = createComment($dsn, $username, $password, $post, $author, $comment);
	if (!$success) {
    	die('Impossible d\'ajouter le commentaire !');
	} else {
    	header('Location: index.php?action=post&id=' . $post);
	}
}