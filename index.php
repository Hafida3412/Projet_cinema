<?php

//On "use" le controller Cinema
use Controller\CinemaController;

//On autocharge les classes du projet
spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

//On instancie le controller Cinema
$ctrlCinema = new CinemaController();
/*En fonction de l'action détectée dans l'URL via la propriété "action"
on interagit avec la bonne méthode du controller*/
if(isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listFilms" : $ctrlCinema->listFilms(); break;
        /*case "listActeurs" : $ctrlCinema->listActeurs(); break;*/
    }
}

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
//$type = (isset($_GET["type"])) ? $GET["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        //Films
        case "listFilms": $ctrlCinema->listFilms(); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;  
        case "detActeur": $ctrlCinema->detActeur($id); break;
    }
}


/*Quand vous faîtes une requête dans lequel on a un élément variable(
comme ici l'id de l'acteur), il faut faire un "prepare" pour ensuite 
faire un "execute".
Dans le "execute", on fait passer un tableau associatif qui associe
le champ paramètré avec la valeur de l'id*/

