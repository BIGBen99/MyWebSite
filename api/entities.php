<?php
  require_once('db_connect.php');
  $request_method = $_SERVER['REQUEST_METHOD'];

  switch($request_method) {
    case 'GET':
      if(!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        getEntities($dbLink, $id);
      } else {
        getEntities($dbLink);
      }
      break;
    case 'POST':
      addEntity($dbLink);
      break;
    default:
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }

  function getEntities($dbLink, $id=0) {
    $query = 'SELECT bc_entities.id as id, siren, numeroInternedeClassement, name, address_line1, address_line2, address_line3, address_pliNonDistribuable FROM bc_entities LEFT JOIN bc_cityZipCodeCountry ON bc_entities.address_cityZipCodeCountry_id = bc_cityZipCodeCountry.id';
    $response = "[\n";
    if($id != 0) {
      $query .= ' WHERE bc_entities.id = ' . $id . ' LIMIT 1';
      $response = '';
    }
    foreach  ($dbLink->query($query) as $row) {
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
        $response .= "}";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true");
        $response .= "}";
      }
      $response .= "},\n";
    }
    $response = substr($response, 0, -2) . "\n";
    if($id == 0) {
      $response .= "]\n";
    }
    header('Content-Type: application/json');
    echo $response;
  }

  function AddEntity($dbLink) {
    $siren = $_POST['siren'];
    $nic = $_POST['numeroInternedeClassement'];
    
    $query="INSERT INTO bc_entities(siren, numeroInternedeClassement, creation_date) VALUES('" . $siren . "', '" . $nic . "', NOW())";
//    echo $query;
    if($response = $dbLink->query($query)) {
      header("HTTP/1.0 200 OK");
    } else {
      header("HTTP/1.0 400 Method Not Allowed");
    }
  }
