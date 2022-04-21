<?php
namespace BIGBen\MyWebSite\Controller;

require_once('framework/Controller.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostController extends \BIGBen\MyWebSite\Framework\Controller {
    private $postManager;
    private $commentManager;

    public function __construct() {
        $this->postManager = new \BIGBen\MyWebSite\Model\PostManager();
        $this->commentManager = new \BIGBen\MyWebSite\Model\CommentManager();
    }

    public function index() {
        $post_id = $this->request->getParameter('id');
        
        $post = $this->postManager->getPost($post_id);
        $comments = $this->commentManager->getComments($post_id);
        
        $this->generateView(array('post' => $post, 'comments' => $comments));
    }
    
    public function addComment() {
        $post_id = $this->request->getParameter('id');
        $author = $this->request->getParameter('author');
        $comment = $this->request->getParameter('comment');
        
        $this->commentManager->postComment($post_id, $author, $comment);
        
        $this->executeAction('index');
    }

    // A revoir
    public function modifyComment($post_id, $comment_id) {
        $post = $this->postManager->getPost($post_id);
        $comments = $this->commentManager->getComments($post_id);
        $view = new \BIGBen\MyWebSite\View\View("post");
        $view->generate(array('post' => $post, 'comments' => $comments, 'comment_id' => $comment_id));
    }

    // A revoir
    public function updateComment($post_id, $comment_id, $author, $comment) {
        $affectedLines = $this->commentManager->updateComment($comment_id, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible de mettre à jour le commentaire !');
        } else {
            header('Location: ?action=post&id=' . $post_id);
            $this->post($post_id);
        }
    }
}
