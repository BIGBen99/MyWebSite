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
      addEntities($dbLink);
      break;
    default:
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }

  function getEntities($dbLink, $id=0) {
    $query = 'SELECT * FROM bc_entities';
    if($id != 0) {
      $query .= ' WHERE id = ' . $id . ' LIMIT 1';
    }
    $response = array();
    foreach  ($dbLink->query($query) as $row) {
      $response[] = $row;
    }    
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }

  function AddProduct($dbLink) {
    $siren = $_POST['siren'];
    $nic = $_POST['numeroInternedeClassement'];
    
    echo $query="INSERT INTO entities(siren, numeroInternedeClassement, creation_date) VALUES('" . $siren . "', '" . $numeroInternedeClassement . "', NOW())";
    $dbLink->query($query);
/*    if(mysqli_query($conn, $query)) {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit ajoute avec succes.'
      );
    } else {
      $response=array(
        'status' => 0,
        'status_message' =>'ERREUR!.'. mysqli_error($conn)
      );
    }*/
    header('Content-Type: application/json');
    echo json_encode($response);
  }
