<?php
namespace BIGBen\MyWebSite\Controller;

require_once('framework/Controller.php');
require_once('model/PostManager.php');

class HomeController extends \BIGBen\MyWebSite\Framework\Controller {
    private $postManager;

    public function __construct() {
        $this->postManager = new \BIGBen\MyWebSite\Model\PostManager();
    }

    public function index() {
        $posts = $this->postManager->getPosts();
        $this->generateView(array('posts' => $posts));
    }
}
