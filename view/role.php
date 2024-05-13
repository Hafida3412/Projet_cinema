<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$role = $requeteRole->fetch(); 
echo "- Rôle: ".$role["nom_role"];
echo "<br>";
echo "<br>";

$detailRole = $requeteDetailRole->fetchAll(); 

echo "<table>";
echo "<tr><th>Acteur</th><th>Film</th></tr>";
foreach($detailRole as $film) {
    echo "<tr>";
    echo "<td>" .$film["acteur"] . "</td>";
    echo "<td>" . $film["film"] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<style>";
echo "th, td { border: 1px solid black; text-align: left; }";
echo "</style>";

$titre = "Détail des rôles : " ;
$titre_secondaire = "Détail des rôles";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/