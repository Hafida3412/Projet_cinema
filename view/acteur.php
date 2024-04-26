<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$acteur = $requeteActeur->fetch(); 
echo "- Acteur: ".$acteur["identite"];
echo "<br>";
echo "- Date de naissance: ".$acteur["date_naissance"];
echo "<br>";
echo "- Genre: ".$acteur["sexe"];
echo "<br>";
echo "<br>";

$filmographie = $requeteFilmographie->fetchAll(); 
foreach($filmographie as $film) { 
    echo " - Rôle: " .$film["nomRole"];
    echo "<br>";
    echo " - Titre du film: " . $film["titre"]."."; 
    echo "<br>";
 }

?>            
<?php

$titre = "Détail de l'acteur: " . $acteur["identite"];
$titre_secondaire = "Détail de l'acteur";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/