<?php
  require_once('db_connect.php');
  $request_method = $_SERVER['REQUEST_METHOD'];

  switch($request_method) {
    case 'GET':
      if(!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        getEntities($id);
      } else {
        getEntities();
      }
      break;
    default:
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }

  function getEntities() {
    $query = "SELECT * FROM bc_entities";
    $response = array();
    foreach  ($dbLink->query($query) as $row) {
      $response[] = $row;
    }    
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}
