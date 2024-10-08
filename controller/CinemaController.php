<?php

namespace Controller;
/*Utilisation de "use" pour accéder à la classe Connect 
située dans le namespace "Model"*/

use Model\Connect;

class CinemaController{
    /**
     * Lister les films
     */
    public function listFilms(){
        //On se connecte
        $pdo = Connect::seConnecter();
        //On exécute la requête de notre choix
        $requete = $pdo->query("SELECT film.id_film, titre, annee_sortie_france 
        FROM film
        ORDER BY annee_sortie_france DESC");

        /*On relie par un "require" la vue qui nous intéresse (située dans 
        le dossier "view")*/
        require "view/listFilms.php";
    }
    
    public function listActeurs(){
        //on se connecte à la base de données
        $pdo = Connect::seConnecter();
        
        // On prépare la requête SQL pour récupérer tous les acteurs
        $requete = $pdo->query("SELECT acteur.id_acteur, personne.id_personne, nom, prenom
        FROM personne 
        inner join acteur ON personne.id_personne = acteur.id_personne 
        ORDER BY nom ASC");
        // On inclut la vue qui affiche la liste des acteurs
       require "view/listActeurs.php";
       }

    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT personne.id_personne, nom, prenom
        FROM personne 
        inner join realisateur ON personne.id_personne = realisateur.id_personne
        ORDER BY nom ASC");
       require "view/listRealisateurs.php";
       } 

    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT id_genre, nom_genre
        FROM genre ORDER BY nom_genre ASC");
        require "view/listGenres.php";
       } 

    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT nom_role, id_role
        FROM role
        ORDER BY nom_role ASC");
        require "view/listRoles.php";
       } 

    public function film($id){
        $pdo = Connect::seConnecter(); 
        $requeteFilm = $pdo->prepare("SELECT id_film, titre, annee_sortie_france,
        TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree,
        CONCAT(nom, ' ', prenom) AS realisateur, note, synopsis, affiche FROM film 
        INNER JOIN realisateur 
        ON film.id_realisateur = realisateur.id_realisateur 
        INNER JOIN personne 
        ON personne.id_personne = realisateur.id_personne 
        WHERE id_film = :id");

        $requeteFilm->execute( ["id" => $id] );
             
        $requeteCasting = $pdo->prepare("SELECT acteur.id_acteur, CONCAT(prenom,' ',nom) AS identite, 
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
        $requeteActeur = $pdo->prepare("SELECT acteur.id_acteur, acteur.id_personne, CONCAT(prenom,' ',nom) AS identite,
        personne.sexe, personne.date_naissance
        FROM personne 
        INNER JOIN acteur  ON personne.id_personne = acteur.id_personne
        WHERE acteur.id_acteur = :id
        ORDER BY identite DESC"
        );

        $requeteActeur->execute(["id" => $id]);
    
        $requeteFilmographie = $pdo->prepare("SELECT acteur.id_acteur, film.id_film, role.id_role, role.nom_role AS nomRole,
        film.titre
        FROM film 
        INNER JOIN jouer ON jouer.id_film = film.id_film
        INNER JOIN acteur ON jouer.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN role ON jouer.id_role = role.id_role
        WHERE acteur.id_acteur = :id
        ORDER BY annee_sortie_france DESC");
       
        $requeteFilmographie->execute(["id"=> $id]);
        require "view/acteur.php";

        }
    public function realisateurs($id){
        $pdo = Connect::seConnecter();
        $requeteRealisateurs = $pdo->prepare("SELECT realisateur.id_personne, CONCAT(prenom,' ',nom) AS identite
        FROM personne 
        INNER JOIN realisateur  ON personne.id_personne = realisateur.id_personne
        WHERE realisateur.id_personne = :id");
        
        $requeteRealisateurs->execute(["id"=> $id]);
            
        $requeteDetailRealisateurs = $pdo->prepare("SELECT id_film, titre, annee_sortie_france,
        TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree,
        CONCAT(nom, ' ', prenom) AS realisateur, note FROM film 
        INNER JOIN realisateur 
        ON film.id_realisateur = realisateur.id_realisateur 
        INNER JOIN personne 
        ON personne.id_personne = realisateur.id_personne 
        WHERE  realisateur.id_personne = :id
        ORDER BY annee_sortie_france DESC");

        $requeteDetailRealisateurs->execute(["id"=> $id]);
        require "view/realisateurs.php";
    }

    public function genre($id){
        $pdo = Connect::seConnecter();
        $requeteGenre = $pdo->prepare("SELECT genre.id_genre, nom_genre
        FROM genre 
        WHERE genre.id_genre = :id");

        $requeteGenre->execute(["id"=> $id]);

        $requeteDetailGenre = $pdo->prepare("SELECT titre, annee_sortie_france, 
        TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree,
        note, genre.nom_genre, genre.id_genre FROM film 
        INNER JOIN associer_genre ON film.id_film = associer_genre.id_film 
        INNER JOIN genre ON associer_genre.id_genre = genre.id_genre  
        WHERE genre.id_genre = :id
        ORDER BY annee_sortie_france DESC");

        $requeteDetailGenre->execute(["id"=> $id]);
        require "view/genre.php";

    }

    public function role($id){
        $pdo = Connect::seConnecter();
        $requeteRole = $pdo->prepare("SELECT id_role, nom_role FROM role
        WHERE id_role = :id");

        $requeteRole->execute(["id"=> $id]);
    
        $requeteDetailRole = $pdo->prepare("SELECT role.nom_role AS role, 
        film.titre AS film, film.annee_sortie_france,
		   TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, note,
        CONCAT(personne.prenom, ' ', personne.nom) AS acteur 
        FROM role INNER JOIN jouer ON role.id_role = jouer.id_role
        INNER JOIN film ON jouer.id_film = film.id_film 
        INNER JOIN acteur ON jouer.id_acteur = acteur.id_acteur 
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        WHERE role.id_role = :id
        ORDER BY annee_sortie_france DESC");

        $requeteDetailRole->execute(["id"=> $id]);
        require "view/role.php";
    }  
    
    public function ajouterGenre(){ 
        session_start(); // Démarrer la session
        if(isset($_POST['nom_genre'])){ 
            $pdo = Connect::seConnecter(); 
            $ajouterGenre = $pdo->prepare("INSERT INTO genre (nom_genre) VALUES (:nom_genre)"); 
            $resultat = $ajouterGenre->execute(['nom_genre' => $_POST['nom_genre']]);
            
            if($resultat){
                $_SESSION['message'] = "Le genre a été ajouté avec succès.";
            } else {
                $_SESSION['erreur'] = "Une erreur s'est produite lors de l'ajout du genre.";
            }
            
            header("Location: index.php?action=listGenres");

            exit();
        } 
    }

    public function supprimerGenre($id){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("DELETE FROM genre WHERE id_genre = :id");
        $resultat = $requete->execute(['id' => $id]);
    
        if($resultat){
            $_SESSION['message'] = "Le genre a été supprimé avec succès.";
        } else {
            $_SESSION['erreur'] = "Une erreur s'est produite lors de la suppression du genre.";
        }
    
        header("Location: index.php?action=listGenres");
        exit();
    }
    }

