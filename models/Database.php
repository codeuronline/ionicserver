<?php
class Database
{
    include_once 'config_bd.inc.php';
    private static $pdo;                        // variable d'instance PDO
    
    // Appliquer les paramètres à PDO
    //  
    private static function setBdd(){

            self::$pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";".self::$attribut,self::$user,self::$pwd);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            self::$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    }
        

    //  fonction :Obtenir une instance de PDO
    public function getPDO()  
    {
            if (self::$pdo === null) {
                self::setBdd();
            }
            return self::$pdo;

    }

}