<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('view/View.php');

class PostController {
    private $postManager;
    private $commentManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function post($post_id) {
        $post = $this->postManager->getPost($post_id);
        $comments = $this->commentManager->getComments($post_id);
        $view = new View("post");
        $view->generate(array('post' => $post, 'comments' => $comments));
    }
}