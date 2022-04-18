<?php
namespace BIGBen\MyWebSite\Model;

class Manager {
    protected function dbConnect() {
        $db = new PDO($_SESSION['dsn'], $_SESSION['username'], $_SESSION['password']);
        return $db;
    }
}