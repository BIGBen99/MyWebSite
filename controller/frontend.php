<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/EntityManager.php');

function listPosts() {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
}

function post($postId) {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager();
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);

    require('view/postView.php');
}

function addComment($postId, $author, $comment) {
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: ?action=post&id=' . $postId);
    }
}

function modifyComment($postId, $commentId) {
    $postManager = new \BIGBen\MyWebSite\Model\PostManager();
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);

    require('view/postView.php');
}

function updateComment($postId, $commentId, $author, $comment) {
    $commentManager = new \BIGBen\MyWebSite\Model\CommentManager();

    $affectedLines = $commentManager->updateComment($commentId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible de mettre à jour le commentaire !');
    } else {
        header('Location: ?action=post&id=' . $postId);
    }
}

function listEntities() {
    $entityManager = new \BIGBen\MyWebSite\Model\EntityManager();
    $entities = $entityManager->getEntities();

    require('view/listEntitiesView.php');
}
