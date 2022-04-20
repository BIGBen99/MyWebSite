<?php
namespace BIGBen\MyWebSite\Controller;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('view/View.php');

class PostController {
    private $postManager;
    private $commentManager;

    public function __construct() {
        $this->postManager = new \BIGBen\MyWebSite\Model\PostManager();
        $this->commentManager = new \BIGBen\MyWebSite\Model\CommentManager();
    }

    public function post($post_id) {
        $post = $this->postManager->getPost($post_id);
        $comments = $this->commentManager->getComments($post_id);
        $view = new \BIGBen\MyWebSite\View\View("post");
        $view->generate(array('post' => $post, 'comments' => $comments));
    }

    public function addComment($post_id, $author, $comment) {
        $affectedLines = $this->commentManager->postComment($post_id, $author, $comment);

        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: ?action=post&id=' . $post_id);
        }
    }

    public function modifyComment($post_id, $comment_id) {
        $post = $this->postManager->getPost($post_id);
        $comments = $this->commentManager->getComments($post_id);
        $view = new \BIGBen\MyWebSite\View\View("post");
        $view->generate(array('post' => $post, 'comments' => $comments, 'comment_id' => $comment_id));
    }

    public function updateComment($post_id, $comment_id, $author, $comment) {
        $affectedLines = $this->commentManager->updateComment($comment_id, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible de mettre à jour le commentaire !');
        } else {
            header('Location: ?action=post&id=' . $postId);
        }
    }
}