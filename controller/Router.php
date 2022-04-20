<?php
namespace BIGBen\MyWebSite\Controller;

require_once('controller/HomeController.php');
require_once('controller/PostController.php');
require_once('view/View.php');

class Router {
    private $homeController;
    private $postController;

    public function __construct() {
        $this->homeController = new \BIGBen\MyWebSite\Controller\HomeController();
        $this->postController = new \BIGBen\MyWebSite\Controller\PostController();
    }

    public function routeRequest() {
        try {
            if(isset($_GET['action'])) {
                if($_GET['action'] == 'post') {
                    if(isset($_GET['id'])) {
                        $post_id = intval($_GET['id']);
                        if($post_id != 0) {
                            $this->postController->post($post_id);
                        } else {
                            throw new \Exception('Identifiant de billet non valide');
                        }
                    } else {
                        throw new \Exception('Identifiant de billet non défini');
                    }
                } else {
                    throw new \Exception('Action non valide');
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
}