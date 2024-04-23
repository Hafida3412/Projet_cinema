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
        $requete = $pdo->query("SELECT id_film, titre, annee_sortie_france FROM film
        ORDER BY annee_sortie_france DESC");

        //On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listFilms.php";
    }
    
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT personne.id_personne, nom, prenom
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
        $requeteFilm = $pdo->prepare("SELECT id_film, titre, annee_sortie_france,
        TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') ,
        CONCAT(nom, ' ', prenom) AS realisateur, note FROM film 
        INNER JOIN realisateur 
        ON film.id_realisateur = realisateur.id_realisateur 
        INNER JOIN personne 
        ON personne.id_personne = realisateur.id_personne 
        WHERE id_film = :id");

        $requeteFilm->execute( ["id" => $id] );
             
        $requeteCasting = $pdo->prepare("SELECT personne.nom, personne.prenom, 
        role.nom_role FROM jouer 
        INNER JOIN acteur ON jouer.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne 
        INNER JOIN role ON jouer.id_role = role.id_role 
        WHERE jouer.id_film = :id");

        $requeteCasting->execute( ["id" => $id] );
        require "view/film.php"; 

    }
    public function acteur($id){
        $pdo = Connect::seConnecter(); 
        $requeteActeur = $pdo->prepare("SELECT CONCAT(prenom, ' ', nom) AS acteur
        FROM acteur 
        INNER JOIN personne 
        ON acteur.id_personne = personne.id_personne 
        WHERE id_acteur = :id
        ORDER BY nom ASC"
        );

        $requeteActeur->execute(["id" => $id]);
        
        $requeteFilmographie = $pdo->prepare("SELECT titre, nom_role, annee_sortie_france FROM film 
        INNER JOIN jouer ON film.id_film = jouer.id_film 
        INNER JOIN role ON jouer.id_role = role.id_role 
        WHERE id_acteur = :id"
        );
       
        $requeteFilmographie->execute(["id"=>$id]);
        require "view/acteur.php";
}
}