<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$film = $requeteFilm->fetch(); 
echo $film["titre"];
echo "<br>";
$casting = $requeteCasting->fetchAll(); 
foreach($casting as $cast) { 
    echo $cast["prenom"] . " ". $cast["nom"].  " dans le rôle de  " . $cast["nom_role"]; 
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