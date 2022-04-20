<?php
namespace BIGBen\MyWebSite\Model;

require_once('model/Manager.php');

class EntityManager extends \BIGBen\MyWebSite\Model\Manager {
    public function getEntities() {
        $queryResult = $this->executeQuery('SELECT id, siren, numeroInternedeClassement, name, address_line1, address_line2, address_line3, address_zipCode, address_city, address_country, address_pliNonDistribuable, creation_date FROM entities ORDER BY name');

        return $queryResult;
    }
}
