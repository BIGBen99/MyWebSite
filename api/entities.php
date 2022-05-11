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
      $response .= "{\n";
      $response .= "\"id\": " . $row['id'];
      if(!empty($row['siren'])) $response .= ",\n \"siren\": \"" . $row['siren'] . "\"";
      if(!empty($row['numeroInternedeClassement'])) $response .= ",\n \"numeroInternedeClassement\": \"" . $row['numeroInternedeClassement'] . "\"";
      if(!empty($row['siren']) && !empty($row['numeroInternedeClassement'])) $response .= ",\n \"siret\": \"" . $row['siren'] . $row['numeroInternedeClassement'] . "\"";
      $response .= ",\"name\": \"" . $row['name'] . "\"\n";
      if(!empty($row['address_line1'])) {
        $response .= ", \"address\": {\n";
        $response .= "\"line1\": \"" . $row['address_line1'] . "\"\n";
        if(!empty($row['address_line2'])) $response .= "\"line2\": \"" . $row['address_line2'] . "\"\n";
        if(!empty($row['address_line3'])) $response .= "\"line3\": \"" . $row['address_line3'] . "\"\n";
        $response .= ", \"cityZipCodeCountry\": {\n";
        $response .= "}\n";
        $response .= ", \"pliNonDistribuable\": " . ($row['address_pliNonDistribuable']==0?"false":"true") . "\n";
        $response .= "}\n";
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
