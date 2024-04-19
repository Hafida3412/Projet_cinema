<?php

namespace Controller;
//Utilisation de "use" pour accéder à la classe Connect située dans le namespace "Model"
use Model\Connect;

class CinemaController{
    /**
     * Lister les films
     */
    public function listFilms(){
        //On se connecte
        $pdo = Connect::seConnecter();
        //On exécute la requête de notre choix
        $requete = $pdo->query("
            SELECT titre, annee_sortie FROM film"
        );
        //On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listFilms.php";
    }

    public function detActeur($id){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM acteur WHERE id_acteur = :id");
        $requete->execute(["id"=>$id]);
        require "view/acteur/detailActeur.php";
    }

    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare('SELECT * FROM film WHERE id_film = :id');
        $requeteFilm->execute([':id' => $id]);
        
        require "view/detailFilm.php";
    }
}

/*// prepare la requête avec un paramètre variable 
$stmt = $pdo->prepare("SELECT * FROM acteurs WHERE id = :id");

// execute la requête en passant l'id sous forme de tableau associatif 
$stmt->execute(array('id' => $id));

// récupère le résultat de la requête et l'affiche 
$result = $stmt->fetch(); 
echo $result['nom']; // exemple de récupération d'un champ "nom"*/