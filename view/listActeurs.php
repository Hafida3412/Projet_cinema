<?php 

//Démarrage de la temporisation de sortie
ob_start(); ?><!--pour commencer la vue-->

<!-- Début de la section HTML pour afficher les données -->
<p class="uk-label uk-label-warning">
    <!-- Affichage du nombre d'acteurs trouvés dans la requête -->
    Il y a <?= $requete->rowCount() ?> acteurs</p>

<table class="uk-table uk-table-striped">
   <thead>
        <tr>
        <th>NOM</th>
            <th>PRENOM</th>
        </tr>
    </thead>
    <tbody>
    <!-- Boucle à travers chaque 'personne' est retournée par la requête-->
    <?php foreach($requete->fetchAll() as $personne) { ?>
            <tr>
                <!-- Lien vers la page de l'acteur avec son ID et affichage du nom -->
                <td><a href="index.php?action=acteur&id=<?= 
                 $personne['id_personne'] ?>"><?= $personne['nom'] ?></a></td>
                 <!-- Affichage du prénom de l'acteur -->
                <td><?= $personne["prenom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

echo "<style>";
echo "th, td { border: 1px solid black; text-align: left; }";
echo "</style>";

// Définition des variables pour le titre
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";

// Fin de la temporisation de sortie et stockage du contenu dans $contenu
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>*/