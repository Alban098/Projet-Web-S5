<?php

namespace connection;

use http\Exception;
use PDO;

class Connection {

    private static $host = "localhost";
    private static $user = "root";
    private static $pwd = "";
    private static $bd = "projetWeb";

    private static $bdd;

    private static function initializeConnection(){
        try {
            self::$bdd = new PDO('mysql:host='.self::$host.';dbname='.self::$bd.
                ';charset=utf8', self::$user, self::$pwd,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            exit('Unable to establish a connection : '.$e->getMessage());
        }
    }

    public static function getConnection() {
        if (!isset(self::$bdd)) {
           self::initializeConnection();
        }
        return self::$bdd;
    }
}
?>