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
        $first = true;
        
        $entities = $this->entityManager->getEntities();
        echo "[\n";
        foreach($entities as $entity):
            if($first) {
                $first = false;
            } else {
                echo ", \n";
            }
            echo "\t{\n";
            echo "\t\t\"id\": " . $entity['id'];
            echo ",\n\t\t\"siren\": \"" . $entity['siren'] . "\"";
            if(!empty($entity['numeroInternedeClassement'])) {
                echo ",\n\t\t\"numeroInternedeClassement\": \"" . $entity['numeroInternedeClassement'] . "\"";
                echo ",\n\t\t\"siret\": \"" . $entity['siren'] . $entity['numeroInternedeClassement'] . "\"";
            }
            echo ",\n\t\t\"name\": \"" . $entity['name'] . "\"";
            if(!empty($entity['address_line1']) || !empty($entity['address_line2']) || !empty($entity['address_line3']) || !empty($entity['address_zipCode']) || !empty($entity['address_city']) || !empty($entity['address_country']) || !empty($entity['address_pliNonDistribuable'])) {
                echo ",\n\t\t\"address\": {\n";
                if(!empty($entity['address_line1'])) {
                    echo "\t\t\t\"line1\": \"" . $entity['address_line1'] . "\"\n";
                }
                echo "\t\t}";
            }
            echo "\n\t}";
        endforeach;            
        echo "\n]";
    }
}
