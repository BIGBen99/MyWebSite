<?php
namespace BIGBen\MyWebSite\Controller;

require_once('controller/HomeController.php');
require_once('controller/PostController.php');
require_once('controller/EntityController.php');
require_once('view/View.php');

class Router {
    private $homeController;
    private $postController;
    private $entityController;

    public function __construct() {
        $this->homeController = new \BIGBen\MyWebSite\Controller\HomeController();
        $this->postController = new \BIGBen\MyWebSite\Controller\PostController();
        $this->entityController = new \BIGBen\MyWebSite\Controller\EntityController();
    }

    public function routeRequest() {
        try {
            if(isset($_GET['action'])) {
                if($_GET['action'] == 'post') {
                    $post_id = intval($this->getParameter($_GET, 'id'));
                    if($post_id != 0) {
                        $this->postController->post($post_id);
                    } else {
                        throw new \Exception('Identifiant de billet non valide');
                    }
                } elseif($_GET['action'] == 'listPosts') {
                    $this->homeController->home();
                } elseif($_GET['action'] == 'addComment') {
                    $post_id = $this->getParameter($_POST, 'post_id');
                    $author = $this->getParameter($_POST, 'author');
                    $comment = $this->getParameter($_POST, 'comment');
                    $this->postController->addComment($post_id, $author, $comment);
                } elseif($_GET['action'] == 'modifyComment') {
                    $post_id = intval($this->getParameter($_GET, 'postId'));
                    if($post_id != 0) {
                        $comment_id = intval($this->getParameter($_GET, 'commentId'));
                        if($comment_id != 0) {
                            $this->postController->modifyComment($post_id, $comment_id);
                        } else {
                            throw new \Exception('Identifiant de commentaire non valide');
                        }
                    } else {
                        throw new \Exception('Identifiant de billet non valide');
                    }
                } elseif($_GET['action'] == 'updateComment') {
                    $post_id = $this->getParameter($_POST, 'post_id');
                    $comment_id = $this->getParameter($_POST, '$comment_id');
                    $author = $this->getParameter($_POST, '$author');
                    $comment = $this->getParameter($_POST, '$comment');
                    $this->postController->updateComment($post_id, $comment_id, $author, $comment);
                } elseif($_GET['action'] == 'listEntities') {
                    $this->entityController->listEntities();
                } elseif($_GET['action'] == 'addEntity') {
                    if (!empty($_POST['name'])) {
                        $this->entityController->addEntity($_POST['siren'], $_POST['numeroInternedeClassement'], $_POST['name'], $_POST['parent_id'], $_POST['address_line1'], $_POST['address_line2'], $_POST['address_line3'], $_POST['address_zipCode'], $_POST['address_city'], $_POST['address_country'], isset($_POST['address_pliNonDistribuable'])?true:false);
                    } else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }                    
                } else {
                    throw new \Exception('Action (' . $_GET['action'] . ') non valide');
                }
            } else {
                $this->homeController->home();
            }
        } catch(Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function error($errorMessage) {
        $view = new \BIGBen\MyWebSite\View\View("error");
        $view->generate(array('errorMessage' => $errorMessage));
    }
    
    private function getParameter($table, $name) {
        if(isset($table[$name])) {
            return $table[$name];
        } else {
            throw new \Exception('Paramètre ' . $nom . ' absent');
        }
    }
}
