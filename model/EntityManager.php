<?php
namespace BIGBen\MyWebSite\Model;

require_once('model/Manager.php');

class EntityManager extends \BIGBen\MyWebSite\Model\Manager {
    public function getEntities() {
        $queryResult = $this->executeQuery('SELECT id, siren, numeroInternedeClassement, name, parent_id, address_line1, address_line2, address_line3, address_zipCode, address_city, address_country, address_pliNonDistribuable, creation_date FROM bc_entities ORDER BY name');

        return $queryResult;
    }
    
    public function addEntity() {
        $queryResult = $this->executeQuery();
        
        return $queryResult;
    }
}
