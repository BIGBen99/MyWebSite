<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post($postId) {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager();
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment) {
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: ?action=post&id=' . $postId);
    }
}

function modifyComment($postId, $commentId) {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager();
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = commentManager->getComment($postId);

    require('view/frontend/postView.php');
}