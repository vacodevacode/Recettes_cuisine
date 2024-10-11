<?php
// 👩‍💻 Ici, j'ai mis mes headers
include('db.php');

// 📝 Ici, je récupère votre ID de la recette depuis la requête GET
$recipeId = isset($_GET['id']) ? $_GET['id'] : die('ID de la recette non spécifié.');

// 📝 Ensuite, je récupère les détails de la recette dans une variable
$recipe = getRecipe($recipeId);

// 📝 Je lui mets une condition et je lui dis si la recette correspond à l'ID, alors elle existe
if ($recipe) {
    // 👩‍💻 Ici, j'affiche le titre de la recette en utilisant une balise H1
    if (isset($recipe['titre'])) {
        echo "<h1>{$recipe['titre']}</h1>";
    } else {
        echo "<p>Titre de la recette non défini.</p>";
    }

    // 👩‍💻 Ici, j'affiche simplement la description de la recette dans un paragraphe
    if (isset($recipe['description'])) {
        echo "<p>{$recipe['description']}</p>";
    } else {
        echo '<p>Description de la recette non définie.</p>';
    }

    // 👩‍💻 Ici, j'ai codé la liste des ingrédients
    echo "<h2>Ingrédients</h2>";
    echo "<ul>";
    if (isset($recipe['ingredients']) && is_array($recipe['ingredients'])) {
        foreach ($recipe['ingredients'] as $ingredient) {
            echo "<li>{$ingredient}</li>";
        }
    } else {
        echo "<p>Aucun ingrédient défini.</p>";
    }
    echo "</ul>";

    // 👩‍💻 Ici, j'ai simplement décrit les étapes de la préparation
    echo "<h2>Étapes de préparation</h2>";
    echo "<ul>";
    if (isset($recipe['etapes']) && is_array($recipe['etapes'])) {
        foreach ($recipe['etapes'] as $step) {
            echo "<li>{$step}</li>";
        }
    } else {
        echo "<p>Aucune étape de préparation définie.</p>";
    }
    echo "</ul>";

} else {
    echo "<p>Recette introuvable.</p>";
}

// 👩‍💻 Et ici, j'inclus le footer
include('footer.php');
?>