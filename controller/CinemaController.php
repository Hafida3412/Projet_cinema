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
        $requete = $pdo->query("SELECT titre, annee_sortie_france FROM film
        ORDER BY annee_sortie_france DESC");

        //On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listFilms.php";
    }
    
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT nom, prenom
        FROM personne 
        inner join acteur ON personne.id_personne = acteur.id_personne ORDER BY nom ASC");
       require "view/listActeurs.php";
       }

    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT nom, prenom
        FROM personne 
        inner join realisateur ON personne.id_personne = realisateur.id_personne
        ORDER BY nom ASC");
       require "view/listRealisateurs.php";
       } 

    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT nom_genre
        FROM genre ORDER BY nom_genre ASC");
        require "view/listGenres.php";
       } 

    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT nom_role
        FROM role
        ORDER BY nom_role ASC");
        require "view/listRoles.php";
       } 

    public function film($id){
        $pdo = Connect::seConnecter(); 
        $requete = $pdo->prepare("SELECT titre, annee_sortie_france,
        TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i')
        , nom, prenom FROM film 
        INNER JOIN realisateur 
        ON film.id_realisateur = realisateur.id_realisateur 
        INNER JOIN personne 
        ON personne.id_personne = realisateur.id_personne 
        WHERE film.id_film = :id"); 

        $requete->execute( ["id" => $id] );
        require "view/film.php"; 
    }

}
  