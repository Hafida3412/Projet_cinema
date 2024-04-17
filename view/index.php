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
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
    }
}