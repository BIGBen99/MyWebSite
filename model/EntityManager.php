<?php
namespace BIGBen\MyWebSite\Model;

require_once('framework/Manager.php');

class EntityManager extends \BIGBen\MyWebSite\Framework\Manager {
    public function getEntities() {
        $queryResult = $this->executeQuery('SELECT id, siren, numeroInternedeClassement, name, parent_id, address_line1, address_line2, address_line3, address_zipCode, address_city, address_country, address_pliNonDistribuable, creation_date FROM bc_entities ORDER BY name');

        return $queryResult;
    }
    
    public function addEntity($siren, $numeroInternedeClassement, $name, $parent_id, $address_line1, $address_line2, $address_line3, $address_zipCode, $address_city, $address_country, $address_pliNonDistribuable) {
        $affectedLines = $this->executeQuery('INSERT INTO bc_entities(siren, numeroInternedeClassement, name, parent_id, address_line1, address_line2, address_line3, address_zipCode, address_city, address_country, address_pliNonDistribuable, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())', array(trim($siren), trim($numeroInternedeClassement), trim($name), empty($parent_id)?NULL:$parent_id, empty($address_line1)?NULL:trim($address_line1), empty($address_line2)?NULL:trim($address_line2), empty($address_line3)?NULL:trim($address_line3), empty($address_zipCode)?NULL:trim($address_zipCode), empty($address_city)?NULL:trim(strtoupper($address_city)), empty($address_country)?NULL:trim(strtoupper($address_country)), empty($address_line1)?NULL:$address_pliNonDistribuable));
        
        return $affectedLines;
    }
}
