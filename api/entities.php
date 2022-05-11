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
    $query = 'SELECT bc_entities.id as id, siren FROM bc_entities LEFT JOIN bc_cityZipCodeCountry ON bc_entities.address_cityZipCodeCountry_id = bc_cityZipCodeCountry.id';
    $response = '[';
    if($id != 0) {
      $query .= ' WHERE id = ' . $id . ' LIMIT 1';
      $response = '';
    }
    foreach  ($dbLink->query($query) as $row) {
      $response .= '{';
      $response .= '"id": ' . $row['id'];
      $response .= ',"siren":' . $row['siren'];
      $response .= '},';
    }
    $response = substr($response, 0, -1);
    if($id == 0) {
      $response .= ']';
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
