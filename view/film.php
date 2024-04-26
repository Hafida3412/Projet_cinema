<?php 

ob_start(); ?><!--pour commencer la vue-->

<?php

$film = $requeteFilm->fetch(); 

?>

<h1>Titre du film : <?= $film["titre"] ?></h1>
<p> Durée du film : <?= $film["duree"] ?></p>
<p> Réalisateur: <?= $film["realisateur"] ?></p>

<?php

echo "<br>";
echo "<img src=".$film['affiche']." />";
echo "<br>";
echo "Note: ".$film["note"]. "/5";
echo "<br>";
echo "<br>";
echo "Synopsis: ".$film["synopsis"];
echo "<br>";
echo "<br>";


$casting = $requeteCasting->fetchAll(); 
foreach($casting as $cast) { 
echo "<p>- Acteur: <a href='index.php?action=acteur&id=".$cast['id_acteur']."'>".$cast["identite"]."</a></p>";
echo "<p>- Rôle: ".$cast["nom_role"]."</p>"; 
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