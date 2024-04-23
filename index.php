<?php

//On "use" le controller Cinema

use Controller\CinemaController;

//On autocharge les classes du projet
spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$id = (isset($_GET["id"])) ? $_GET["id"] : "";
//$type = (isset($_GET["type"])) ? $GET["type"] : null;

//On instancie le controller Cinema
$ctrlCinema = new CinemaController();
/*En fonction de l'action détectée dans l'URL via la propriété "action"
on interagit avec la bonne méthode du controller*/
if(isset($_GET["action"])){
    switch ($_GET["action"])
   {
     //Film
     case "listFilms" : 
        $ctrlCinema->listFilms(); break;
     case "film":
        $ctrlCinema->film($id); break;    
     case "listActeurs" : 
        $ctrlCinema->listActeurs(); break;
     case "listRealisateurs" : 
        $ctrlCinema->listRealisateurs(); break;
     case "listGenres" : 
        $ctrlCinema->listGenres(); break;
     case "listRoles" : 
        $ctrlCinema->listRoles(); break;
   }
}

/*Quand vous faîtes une requête dans lequel on a un élément variable(
comme ici l'id de l'acteur), il faut faire un "prepare" pour ensuite 
faire un "execute".
Dans le "execute", on fait passer un tableau associatif qui associe
le champ paramètré avec la valeur de l'id*/



