<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$realisateurs = $requeteRealisateurs->fetch(); 
echo "- Nom:" .$realisateurs["identite"] .":";
echo "<br>";


$detailRealisateurs =  $requeteDetailRealisateurs->fetchAll(); 
foreach($detailRealisateurs as $film) { 
    echo "- Titre du film réalisé: " . $film["titre"]."."; 
    echo "<br>";
    echo "- Durée: " .$film["duree"] ."min.";
    echo "<br>";
    echo "- Année de sortie en France: ".$film["annee_sortie_france"];
    echo "<br>";
    echo "- Note: " .$film["note"]. "/5";
    echo "<br>";
    echo "<br>";
}

?>            
<?php

$titre = "Détail du réalisateur: " . $realisateurs["identite"];
$titre_secondaire = "Détail du réalisateur";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/