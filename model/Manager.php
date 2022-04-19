<?php
namespace BIGBen\MyWebSite\Model;

class abstract Manager {
private $dbLink;

protected function executeQuery($sql, $params = null) {
    if($params == null) {
        $queryResult = $this->dbConnect()->query($sql);
    } else {
        $queryResult = $this->dbConnect()->prepare($sql);
        $queryResult->execute($params);
    }

    return $queryResult;
}

private function dbConnect() {
    if($this->dbLink == null) {
        $this->dbLink = new \PDO($_SESSION['dsn'], $_SESSION['username'], $_SESSION['password']);
    }

    return $this->dbLink;
}