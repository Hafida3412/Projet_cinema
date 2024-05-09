<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!------------------------------------------META DESCRIPTION------------------------------------------->
    <meta name="description" content="Retrouvez toute l'actualité cinéma, les bandes-annonces, les sorties, les critiques et les classements des films et séries.
    Retrouvez toute l'actualité cinéma, les bandes-annonces, les sorties, les critiques et les classements des films et séries">
    <link rel="stylesheet" href="styles.css">
    <title><?= $titre ?></title>
</head>
<body>
    <nav class="uk-navbar-container" uk-navbar uk-sticky>
    <ul>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                <li><a href="index.php?action=listGenres">Genres</a></li>
                <li><a href="index.php?action=listRoles">Rôles</a></li>
    </ul>
    </nav>
<div id="wrapper" class="uk-container uk-container-expand">
    <main>
        <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
             <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
    </div>
</main>
</div>
</body>
</html>