<?php

include_once 'header.php';
include_once 'db.php';
include_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $ingredients = explode(",", $_POST["ingredients"]);
    $steps = explode(",", $_POST["steps"]);

    $newRecipe = array(
        "id" => generateUniqueID(),
        "title" => $title,
        "description" => $description,
        "ingredients" => $ingredients,
        "steps" => $steps
    );

    saveRecipe($newRecipe);

    header("Location: recipes.php");
    exit;
} else {
    header("Location: error.php");
    exit;
}
?>
