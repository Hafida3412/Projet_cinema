<?php

/*"namespace" pour catégoriser virtuellement dans un espace de nom 
la classe en question. Ainsi, on pourra "use" la classe sans connaître
son emplacement physique*/
namespace Model;

abstract class Connect{

    const HOST = "localhost";
    const DB = "cinema_hafida";
    const USER = "root";
    const PASS = "";

    public static function seConnecter(){
        try{
            return new \PDO( //la barre "\" devant PDO indique au framework que PDO est une classe native et non une classe du projet
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8",
                self::USER,
                self::PASS
            );
        } catch(\PDOException $ex){
            return $ex->getMessage();
        }
    }
}