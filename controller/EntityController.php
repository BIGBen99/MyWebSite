<?php
namespace BIGBen\MyWebSite\Controller;

require_once('model/EntityManager.php');
require_once('view/View.php');

class EntityController {
    private $entityManager;

    public function __construct() {
        $this->entityManager = new \BIGBen\MyWebSite\Model\EntityManager();
    }

    public function listEntities() {
        $entities = $this->entityManager->getEntities();
        $view = new \BIGBen\MyWebSite\View\View("listEntities");
        $view->generate(array('entities' => $entities));
    }
}
