<?php
  require_once('db_connect.php');

  switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      if(!empty($_GET["code"])) {
        $code = $_GET["code"];
        getEntity($dbLink, $code);
      } else {
        getEntities($dbLink);
      }
      break;
    default:
      header("HTTP/1.1 405 Method Not Allowed");
      break;
  }

  function getEntity($dbLink, $code) {
    $query = 'SELECT bc_entities.code as code, siren, numeroInternedeClassement, bc_entities.name as name, address_line1, address_line2, address_line3, address_zipCode, address_city, bc_country.id as country_id, bc_country.name as country_name,address_pliNonDistribuable, parent_id FROM bc_entities LEFT JOIN bc_country ON bc_entities.address_country_id = bc_country.id WHERE bc_entities.code = ' . $code . ' LIMIT 1';
    foreach($dbLink->query($query) as $row) {
      $response = "{";
      $response .= "\"code\": " . $row['code'];
      if(!empty($row['siren'])) $response .= ", \"siren\": \"" . $row['siren'] . "\"";
      if(!empty($row['numeroInternedeClassement'])) $response .= ", \"numeroInternedeClassement\": \"" . $row['numeroInternedeClassement'] . "\"";
      if(!empty($row['siren']) && !empty($row['numeroInternedeClassement'])) $response .= ", \"siret\": \"" . $row['siren'] . $row['numeroInternedeClassement'] . "\"";
      $response .= ", \"name\": \"" . $row['name'] . "\"";
      if(!empty($row['address_line1'])) {
        $response .= ", \"address\": {";
        $response .= "\"line1\": \"" . $row['address_line1'] . "\"";
        if(!empty($row['address_line2'])) $response .= ", \"line2\": \"" . $row['address_line2'] . "\"";
        if(!empty($row['address_line3'])) $response .= ", \"line3\": \"" . $row['address_line3'] . "\"";
        $response .= "\"zipCode\": \"" . $row['zipCode'] . "\", ";
        $response .= "\"city\": \"" . $row['city'] . "\", ";
        $response .= ", \"country\": {";
        $response .= "\"id\": " . $row['country_id'] . ", ";
        $response .= "\"name\": \"" . $row['country_name'] . "\"";
        $response .= "}";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true");
        $response .= "}";
      }
      if(!empty($row['parent_id'])) $response .= ", \"parentId\": " . $row['parent_id'];
      $response .= "},\n";
    }
    if(isset($response)) {
      $response = substr($response, 0, -2) . "\n";
      header("HTTP/1.1 200 OK");
      header("Content-Type: application/json");
      echo $response;
    } else {
      header("HTTP/1.1 404 Not Found");
    }
  }

  function getEntities($dbLink) {
    $query = 'SELECT bc_entities.id as id, siren, numeroInternedeClassement, name, address_line1, address_line2, address_line3, address_cityZipCodeCountry_id, zipCode, city, country ,address_pliNonDistribuable, parent_id FROM bc_entities LEFT JOIN bc_cityZipCodeCountry ON bc_entities.address_cityZipCodeCountry_id = bc_cityZipCodeCountry.id';
    $response = "[\n";
    $noWhere = false;
    if(isset($_GET['name'])) {
      $query .= ' WHERE name like "%' . $_GET['name'] . '%"';
      $noWhere = true;
    }
    if(isset($_GET['siren'])) {
      if($noWhere) {
        $query .= ' AND siren like "' . $_GET['siren'] . '%"';
      } else {
        $query .= ' WHERE siren like "' . $_GET['siren'] . '%"';
      }
    }
    if(isset($_GET['siret'])) {
      if($noWhere) {
        $query .= ' AND CONCAT(siren, numeroInternedeClassement) like "' . $_GET['siret'] . '%"';
      } else {
        $query .= ' WHERE CONCAT(siren, numeroInternedeClassement) like "' . $_GET['siret'] . '%"';
      }
    }
    if(isset($_GET['rootOnly']) && strtoupper($_GET['rootOnly']) == 'TRUE') {
      if($noWhere) {
        $query .= ' AND parent_id is NULL';
      } else {
        $query .= ' WHERE parent_id is NULL';
      }
    }
    if(isset($_GET['sortBy']) && strtoupper($_GET['sortBy']) == 'DESC') {
      $query .= ' ORDER BY name DESC';
    } else {
      $query .= ' ORDER BY name ASC';
    }
    foreach($dbLink->query($query) as $row) {
      $response .= "{";
      $response .= "\"id\": " . $row['id'];
      if(!empty($row['siren'])) $response .= ", \"siren\": \"" . $row['siren'] . "\"";
      if(!empty($row['numeroInternedeClassement'])) $response .= ", \"numeroInternedeClassement\": \"" . $row['numeroInternedeClassement'] . "\"";
      if(!empty($row['siren']) && !empty($row['numeroInternedeClassement'])) $response .= ", \"siret\": \"" . $row['siren'] . $row['numeroInternedeClassement'] . "\"";
      $response .= ", \"name\": \"" . $row['name'] . "\"";
      if(!empty($row['address_line1'])) {
        $response .= ", \"address\": {";
        $response .= "\"line1\": \"" . $row['address_line1'] . "\"";
        if(!empty($row['address_line2'])) $response .= ", \"line2\": \"" . $row['address_line2'] . "\"";
        if(!empty($row['address_line3'])) $response .= ", \"line3\": \"" . $row['address_line3'] . "\"";
        $response .= ", \"cityZipCodeCountry\": {";
        $response .= "\"id\": " . $row['address_cityZipCodeCountry_id'] . ", ";
        $response .= "\"zipCode\": \"" . $row['zipCode'] . "\", ";
        $response .= "\"city\": \"" . $row['city'] . "\", ";
        $response .= "\"country\": \"" . $row['country'] . "\"";
        $response .= "}";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true");
        $response .= "}";
      }
      if(!empty($row['parent_id'])) $response .= ", \"parentId\": " . $row['parent_id'];
      $response .= "},\n";
    }
    if($response != "[\n" && $response != '') $response = substr($response, 0, -2) . "\n";
    $response .= "]\n";
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");
    echo $response;
  }
