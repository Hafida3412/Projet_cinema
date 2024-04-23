<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$genre = $requeteGenre->fetch(); 
echo $genre["nom_genre"] .":";
echo "<br>";

$detailGenre =  $requeteDetailGenre->fetchAll(); 
foreach($detailGenre as $film) { 
    echo "-" . $film["titre"]."."; 
    echo "<br>";
    
}

?>            
<?php

$titre = "Détail des genres: ";
$titre_secondaire = "Détail des genres";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/