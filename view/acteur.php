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
echo "<table>";
echo "<tr><th>Rôle</th><th>Titre du film</th></tr>";
foreach($filmographie as $film) { 
    echo "<tr>";
    echo "<td>" .$film['nomRole'] ."</td>";
    echo "<td>" . $film["titre"] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<style>";
echo "th, td { border: 1px solid black; text-align: left; }";
echo "</style>";

?>            
<?php

$titre = "Détail de l'acteur: ";
$titre_secondaire = "Détail de l'acteur";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/