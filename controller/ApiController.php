<?php
namespace BIGBen\MyWebSite\Controller;

require_once('framework/Controller.php');
require_once('model/EntityManager.php');

class ApiController extends \BIGBen\MyWebSite\Framework\Controller {
    private $entityManager;
    
    public function __construct() {
        $this->entityManager = new \BIGBen\MyWebSite\Model\EntityManager();
    }

    public function index() {
        echo '<a href="/api/entities">entities</a>';
    }
    
    public function entities() {
        $entities = $this->entityManager->getEntities();
        echo "[\n";
        foreach($entities as $entity):
            echo "\t{\n";
            echo "\t\t\"id\": " . $entity['id'] . ",\n";
            echo "\t\t\"siren\": " . $entity['siren'] . ",\n";
            echo "\t}\n";
        endforeach;            
        echo ']';
    }
}
