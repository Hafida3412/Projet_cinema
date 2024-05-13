<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$realisateurs = $requeteRealisateurs->fetch(); 
echo "- Nom: " .$realisateurs["identite"];
echo "<br>";
echo "<br>";


$detailRealisateurs =  $requeteDetailRealisateurs->fetchAll(); 

echo "<table>";
echo "<tr><th>Titre du film</th><th>Durée</th></tr>";
foreach($detailRealisateurs as $film) { 
    echo "<tr>";
    echo "<td>" .$film["titre"] . "</td>";
    echo "<td>" .$film["duree"] . "min"."</td>";
    echo "</tr>";
}
echo "</table>";
   
echo "<style>";
echo "th, td { border: 1px solid black; text-align: left; }";
echo "</style>";

?>            
<?php

$titre = "Détail du réalisateur: " . $realisateurs["identite"];
$titre_secondaire = "Détail du réalisateur";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/