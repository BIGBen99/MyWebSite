<?php
require('../mywebsite.php');

$_SESSION['dsn'] = $dsn;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'modifyComment') {
            if(isset($_GET['postId']) && $_GET['postId'] > 0 && isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                modifyComment($_GET['postId'], $_GET['commentId']);
            } else {
                throw new Exception('Identifiant de billet et/ou de commentaire absent');
            }
        } elseif ($_GET['action'] == 'updateComment') {
            if (isset($_GET['postId']) && $_GET['postId'] > 0 && isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    updateComment($_GET['postId'], $_GET['commentId'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        } else {
            throw new Exception('Action inconnue');
        }
    } else {
        listPosts();
    }
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}