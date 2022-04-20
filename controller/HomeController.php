<?php
namespace BIGBen\MyWebSite\Controller;

require_once('model/PostManager.php');
require_once('view/View.php');

class HomeController {
    private $postManager;

    public function __construct() {
        $this->postManager = new \BIGBen\MyWebSite\Model\PostManager();
    }

    public function home() {
        $posts = $this->postManager->getPosts();
        $view = new BIGBen\MyWebSite\View\View("listPosts");
        $view->generate(array('posts' => $posts));
    }
}