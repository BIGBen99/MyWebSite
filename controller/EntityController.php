<?php
namespace BIGBen\MyWebSite\Controller;

require_once('framework/Controller.php');
require_once('model/EntityManager.php');

class EntityController extends \BIGBen\MyWebSite\Framework\Controller {
    private $entityManager;

    public function __construct() {
        $this->entityManager = new \BIGBen\MyWebSite\Model\EntityManager();
    }

    public function index() {
        $entities = $this->entityManager->getEntities();
        $this->generateView(array('entities' => $entities));
    }
    
    // A revoir
    public function addEntity($siren, $numeroInternedeClassement, $name, $parent_id, $address_line1, $address_line2, $address_line3, $address_zipCode, $address_city, $address_country, $address_pliNonDistribuable) {
        $affectedLines = $this->entityManager->addEntity($siren, $numeroInternedeClassement, $name, $parent_id, $address_line1, $address_line2, $address_line3, $address_zipCode, $address_city, $address_country, $address_pliNonDistribuable);

        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter l\'entité !');
        } else {
            header('Location: ?action=listEntities');
        }
    }
}
