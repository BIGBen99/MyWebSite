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
                } elseif($_GET['action'] == 'listPosts') {
                    $this->homeController->home();
                } elseif($_GET['action'] == 'addComment') {
                    if(isset($_GET['id'])) {
                        $post_id = intval($_GET['id']);
                        if($post_id != 0) {
                            if(!empty($_POST['author']) && !empty($_POST['comment'])) {
                                $this->postController->addComment($post_id, $_POST['author'], $_POST['comment']);
                            } else {
                                throw new \Exception('Tous les champs (auteur, commentaire) ne sont pas remplis !');
                            }
                        } else {
                            throw new \Exception('Identifiant de billet non valide');
                        }
                    } else {
                        throw new \Exception('Identifiant de billet non défini');
                    }
                } elseif($_GET['action'] == 'modifyComment') {
                    if(isset($_GET['postId'])) {
                        $post_id = intval($_GET['postId']);
                        if($post_id != 0) {
                            if(isset($_GET['commentId'])) {
                                $comment_id = intval($_GET['commentId']);
                                if($comment_id != 0) {
                                    $this->postController->modifyComment($post_id, $comment_id);
                                } else {
                                    throw new \Exception('Identifiant de commentaire non valide');
                                }
                            } else {
                                throw new \Exception('Identifiant de commentaire non défini');
                            }
                        } else {
                            throw new \Exception('Identifiant de billet non valide');
                        }
                    } else {
                        throw new \Exception('Identifiant de billet non défini');
                    }
                } elseif($_GET['action'] == 'updateComment') {
                    if(isset($_GET['postId'])) {
                        $post_id = intval($_GET['postId']);
                        if($post_id != 0) {
                            if(isset($_GET['commentId'])) {
                                $comment_id = intval($_GET['commentId']);
                                if($comment_id != 0) {
                                    if(!empty($_POST['author']) && !empty($_POST['comment'])) {
                                        $this->postController->updateComment($post_id, $comment_id, $_POST['author'], $_POST['comment']);
                                    } else {
                                        throw new \Exception('Tous les champs (auteur, commentaire) ne sont pas remplis !');
                                    }
                                } else {
                                    throw new \Exception('Identifiant de commentaire non valide');
                                }
                            } else {
                                throw new \Exception('Identifiant de commentaire non défini');
                            }
                        } else {
                            throw new \Exception('Identifiant de billet non valide');
                        }
                    } else {
                        throw new \Exception('Identifiant de billet non défini');
                    }
                } elseif($_GET['action'] == 'listEntities') {
                        $this->entityController->listEntities();
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
}
