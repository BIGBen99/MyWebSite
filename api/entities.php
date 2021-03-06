<?php
  require_once('db_connect.php');

  switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      if(!empty($_GET["id"])) {
        $id = $_GET["id"];
        getEntity($dbLink, $id);
      } else {
        getEntities($dbLink);
      }
      break;
    default:
      header("HTTP/1.1 405 Method Not Allowed");
      break;
  }

  function getEntity($dbLink, $id) {
    $query = 'SELECT bc_entities.id as id, code, siren, numeroInternedeClassement, bc_entities.name as name, address_line1, address_line2, address_line3, address_zipCode, address_city, bc_country.id as country_id, bc_country.name as country_name,address_pliNonDistribuable, parent_id, subsidiaries FROM bc_entities LEFT JOIN bc_country ON bc_entities.address_country_id = bc_country.id WHERE bc_entities.id = ' . $id . ' LIMIT 1';
    foreach($dbLink->query($query) as $row) {
      $response = "{";
      $response .= "\"id\": " . $row['id'];
      $response .= ", \"code\": \"" . $row['code'] . "\"";
      if(!empty($row['siren'])) $response .= ", \"siren\": \"" . $row['siren'] . "\"";
      if(!empty($row['numeroInternedeClassement'])) $response .= ", \"numeroInternedeClassement\": \"" . $row['numeroInternedeClassement'] . "\"";
      if(!empty($row['siren']) && !empty($row['numeroInternedeClassement'])) $response .= ", \"siret\": \"" . $row['siren'] . $row['numeroInternedeClassement'] . "\"";
      $response .= ", \"name\": \"" . $row['name'] . "\"";
      if(!empty($row['address_line1'])) {
        $response .= ", \"address\": {";
        $response .= "\"line1\": \"" . $row['address_line1'] . "\"";
        if(!empty($row['address_line2'])) $response .= ", \"line2\": \"" . $row['address_line2'] . "\"";
        if(!empty($row['address_line3'])) $response .= ", \"line3\": \"" . $row['address_line3'] . "\"";
        $response .= ", \"zipCode\": \"" . $row['address_zipCode'] . "\"";
        $response .= ", \"city\": \"" . $row['address_city'] . "\"";
        $response .= ", \"country\": {";
        $response .= "\"id\": " . $row['country_id'] . ", ";
        $response .= "\"name\": \"" . $row['country_name'] . "\"";
        $response .= "}";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true");
        $response .= "}";
      }
      if(!empty($row['parent_id'])) $response .= ", \"parentId\": " . $row['parent_id'];
      if(!empty($row['subsidiaries'])) $response .= ", \"subsidiaries\": " . $row['subsidiaries'];
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
    $query = 'SELECT bc_entities.id as id, code, siren, numeroInternedeClassement, bc_entities.name as name, address_line1, address_line2, address_line3, address_zipCode, address_city, bc_country.id as country_id, bc_country.name as country_name, address_pliNonDistribuable, parent_id, subsidiaries FROM bc_entities LEFT JOIN bc_country ON bc_entities.address_country_id = bc_country.id';
    $response = "[\n";
    $noWhere = false;
    if(isset($_GET['name'])) {
      $query .= ' WHERE bc_entities.name like "%' . $_GET['name'] . '%"';
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
    if(isset($_GET['parentId'])) {
      if($noWhere) {
        $query .= ' AND parent_id';
      } else {
        $query .= ' WHERE parent_id';
      }
      if($_GET['parentId']=='null') {
        $query .= ' is null';
      } else {
        $query .= '=' . $_GET['parentId'];
      }
    }
    if(isset($_GET['code'])) {
      if($noWhere) {
        $query .= ' AND code=' . $_GET['code'];
      } else {
        $query .= ' WHERE code='  . $_GET['code'];
      }
    }
    if(isset($_GET['sort']) && $_GET['sort'] == '-name') {
      $query .= ' ORDER BY name DESC';
    } else {
      $query .= ' ORDER BY name ASC';
    }
    foreach($dbLink->query($query) as $row) {
      $response .= "{";
      $response .= "\"id\": " . $row['id'];
      $response .= ", \"code\": \"" . $row['code'] . "\"";
      if(!empty($row['siren'])) $response .= ", \"siren\": \"" . $row['siren'] . "\"";
      if(!empty($row['numeroInternedeClassement'])) $response .= ", \"numeroInternedeClassement\": \"" . $row['numeroInternedeClassement'] . "\"";
      if(!empty($row['siren']) && !empty($row['numeroInternedeClassement'])) $response .= ", \"siret\": \"" . $row['siren'] . $row['numeroInternedeClassement'] . "\"";
      $response .= ", \"name\": \"" . $row['name'] . "\"";
      if(!empty($row['address_line1'])) {
        $response .= ", \"address\": {";
        $response .= "\"line1\": \"" . $row['address_line1'] . "\"";
        if(!empty($row['address_line2'])) $response .= ", \"line2\": \"" . $row['address_line2'] . "\"";
        if(!empty($row['address_line3'])) $response .= ", \"line3\": \"" . $row['address_line3'] . "\"";
        $response .= ", \"zipCode\": \"" . $row['address_zipCode'] . "\"";
        $response .= ", \"city\": \"" . $row['address_city'] . "\"";
        $response .= ", \"country\": {";
        $response .= "\"id\": " . $row['country_id'] . ", ";
        $response .= "\"name\": \"" . $row['country_name'] . "\"";
        $response .= "}";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true");
        $response .= "}";
      }
      if(!empty($row['parent_id'])) $response .= ", \"parentId\": " . $row['parent_id'];
      if(!empty($row['subsidiaries'])) $response .= ", \"subsidiaries\": " . $row['subsidiaries'];
      $response .= "},\n";
    }
    if($response != "[\n" && $response != '') $response = substr($response, 0, -2) . "\n";
    $response .= "]\n";
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");
    echo $response;
  }
