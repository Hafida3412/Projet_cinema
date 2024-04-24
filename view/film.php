<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$film = $requeteFilm->fetch(); 
echo"Titre du film: " .$film["titre"]." ";
echo "(durée: " .$film["duree"]. "min)";
echo "<br>";
echo "Réalisateur: ".$film["realisateur"];
echo "<br>";
echo "Note: ".$film["note"]. "/5";
echo "<br>";

$casting = $requeteCasting->fetchAll(); 
foreach($casting as $cast) { 
echo "- Acteur: " .$cast["prenom"]." ". $cast["nom"]; 
echo "<br>";
echo "- Rôle: " . $cast["nom_role"];
echo "<br>";
echo "<br>";
}

?>            
<?php


$titre = "Détail de films: " . $film["titre"];
$titre_secondaire = "Détail de films";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/