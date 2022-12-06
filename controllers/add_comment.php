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
    	throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = createComment($dsn, $username, $password, $post, $author, $comment);
    if (!$success) {
    	throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $post);
    }
}
