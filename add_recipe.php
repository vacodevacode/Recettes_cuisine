<?php

include_once 'header.php';
include_once 'db.php';

// Je verifie si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Je recupere les données du formulaire
    $title = $_POST["title"];
    $description = $_POST["description"];
    $ingredients = explode(",", $_POST["ingredients"]);
    $steps = explode(",", $_POST["steps"]);

    // Je créee un tableau associatif avec les données de la nouvelle recette
    $newRecipe = array(
        "id" => generateUniqueID(),
        "title" => $title,
        "description" => $description,
        "ingredients" => $ingredients,
        "steps" => $steps
    );

    // je charge toutes les recettes existantes
    $recipes = getAllRecipes();

    // J'ajoute la nouvelle recette
    $recipes[] = $newRecipe;

    // Je sauvegarde le tableau mis à jour dans le fichier JSON
    saveRecipe($newRecipe);

    // Puis je redirige vers la page des recettes
    header("Location: recipes.php");
    exit;
}
?>

<h1>Ajouter une Recette</h1>

<form action="" method="post">
    <label for="title">Titre de la recette:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="ingredients">Ingrédients (séparés par des virgules):</label>
    <textarea id="ingredients" name="ingredients" required></textarea>

    <label for="steps">Étapes de préparation (séparées par des virgules):</label>
    <textarea id="steps" name="steps" required></textarea>

    <button type="submit">Ajouter la recette</button>
</form>