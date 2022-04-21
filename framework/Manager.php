<?php
namespace BIGBen\MyWebSite\Framework;

require_once('Configuration.php');

abstract class Manager {
    private static $dbLink;

    protected function executeQuery($sql, $params = null) {
        if($params == null) {
            $queryResult = self::dbConnect()->query($sql);
        } else {
            $queryResult = self::dbConnect()->prepare($sql);
            $queryResult->execute($params);
        }
        return $queryResult;
    }

    private static function dbConnect() {
        if(self::$dbLink === null) {
            $dsn = Configuration::get('dsn');
            $username = Configuration::get('username');
            $password = Configuration::get('password');
            self::$dbLink = new \PDO($dsn, $username, $password);
        }
        return self::$dbLink;
    }
}
