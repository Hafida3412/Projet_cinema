<?php 

ob_start(); ?><!--pour commencer la vue-->
<?php
// Assurez-vous d'initialiser la variable $requete avant de l'utiliser
$requeteFilm = $pdo->prepare('SELECT * FROM film WHERE id_film = :id');
$requeteFilm->execute([':id' => $id]);// votre requête SQL ici;

?>
 
<p class="uk-label uk-label-warning">Il y a <?= $requeteFilm->rowCount() ?> films</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
   <tbody>
    <?php 
        foreach ($requeteFilm->fetchAll() as $film){ ?>
        <tr>
            <td><?= $film["titre"] ?></td>
            <td><?= $film["annee_sortie"] ?></td>  
        </tr>
    <?php } ?>    
   </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>

"Dans "template.php", on aura des variables qui vont accueillir les 
éléments provenant des vues.
Dans CHAQUE VUE, il faudra donner une valeur à:
$titre, $contenu et $titre_secondaire*/


