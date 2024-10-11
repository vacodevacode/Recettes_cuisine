<?php

include('functions.php');
include('header.php');
include('db.php');
?>

<!-- Ajout du lien pour ajouter une recette -->
<a href="add_recipe.php">Ajouter une Recette</a>

<!-- Récupération de toutes les recettes -->
<?php
$recipes = getAllRecipes();
?>

<!-- Affichage de la liste des recettes -->
<h1>Liste des Recettes</h1>
<ul>
    <?php
    foreach ($recipes as $recipe) {
        echo "<li>";
        echo "<a href='recipe.php?id={$recipe["id"]}'>";
        echo $recipe["title"];
        echo "</a></li>";
    }
    ?>
</ul>

<?php

include('footer.php');
?>
