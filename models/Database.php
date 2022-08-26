<?php
class Database
{
    private static $host    = "localhost";          // chemin d'acces de lhote contenant la Base de donnée
    private static $dbname  = "ionicfoundlost";     // nom de la base de donnée
    private static $attribut= "charset=utf8";       // attribut de la Base de donnée    
    private static $user    = "root";               // login de connection
    private static $pwd     = "";                   // mot de pass de connection à la BD
    private static $pdo;                            // variable d'instance PDO
    
    // Appliquer les paramètres à PDO
    //  
    private static function setBdd(){

            self::$pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";".self::$attribut,self::$user,self::$pwd);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            self::$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    }
    //  fonction Obtenir une instance de PDO
    public function getPDO()  
    {
            if (self::$pdo === null) {
                self::setBdd();
            }
            return self::$pdo;

    }

}