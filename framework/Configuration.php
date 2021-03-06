<?php
namespace BIGBen\MyWebSite\Framework;

class Configuration {
    private static $parameters;

    public static function get($name, $defaultValue = null) {
        if (isset(self::getParameters()[$name])) {
            $value = self::getParameters()[$name];
        } else {
            $value = $defaultValue;
        }
        return $value;
    }

    private static function getParameters() {
        if (self::$parameters == null) {
            $filePath = '../prod.ini';
            if (!file_exists($filePath)) {
                $filePath = '../dev.ini';
            }
            if (!file_exists($filePath)) {
                throw new \Exception('Aucun fichier de configuration trouvé');
            } else {
                self::$parameters = parse_ini_file($filePath);
            }
        }
        return self::$parameters;
    }
}