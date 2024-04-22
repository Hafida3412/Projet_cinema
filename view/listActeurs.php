<?php 

ob_start(); ?><!--pour commencer la vue-->


<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>


<table class="uk-table uk-table-striped">
   <thead>
        <tr>
        <th>NOM</th>
            <th>PRENOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $personne) { ?>
                <tr>
                    <td><?= $personne["nom"] ?></td>
                    <td><?= $personne["prenom"] ?></td>
                </tr>
        <?php    } ?>
    </tbody>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();/*"ob_get_clean()" pour terminer la vue
tout ce qui se trouve entre ces 2 fonctions(temporisation de sortie)
pour stocker le contenu dans une variable $contenu*/
require "view/template.php";/*ce require permet d'injecter le contenu
dans le template "squelette" > <template class="php"></template>