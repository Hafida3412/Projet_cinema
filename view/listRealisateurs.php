<?php 

ob_start(); ?><!--pour commencer la vue-->


<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> réalisateurs</p>


<table class="uk-table uk-table-striped">
   <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur) { ?>
                <tr>
                <td><a href="index.php?action=realisateurs&id=<?= $realisateur['id_personne'] ?>"><?= $realisateur['nom'] ?></a></td>
                <td><?= $realisateur["prenom"] ?></td>
                </tr>
        <?php    } ?>
    </tbody>
</table>

<?php

echo "<style>";
echo "th, td { border: 1px solid black; text-align: left; }";
echo "</style>";

$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>

"Dans "template.php", on aura des variables qui vont accueillir les 
éléments provenant des vues.
Dans CHAQUE VUE, il faudra donner une valeur à:
$titre, $contenu et $titre_secondaire*/


