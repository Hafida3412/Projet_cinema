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
        inner join acteur ON personne.id_personne = acteur.id_personne");
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
    }
    
  