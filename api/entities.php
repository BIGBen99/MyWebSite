<?php
  require_once('db_connect.php');
  $request_method = $_SERVER['REQUEST_METHOD'];

  switch($request_method) {
    case 'GET':
      if(!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        getProducts($id);
      } else {
        getProducts();
      }
      break;
    default:
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }
