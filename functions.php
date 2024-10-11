<?php

include('recipe.php');
include('db.php');

function generateUniqueID() {
    return mt_rand(1, 1000);
}

// Je sauvegarde une recette dans un fichier JSON
function saveRecipe($recipeDetails) {
    // Je génére un ID unique pour la recette
    $recipeDetails['id'] = generateUniqueID();

    // Je construit le chemin du fichier en utilisant l'ID de la recette
    $filePath = 'data/recettes/' . $recipeDetails['id'] . '.json';

    // Je convertis les détails de la recette en format JSON
    $jsonRecipe = json_encode($recipeDetails, JSON_PRETTY_PRINT);

    // Je sauvegarde le fichier JSON
    file_put_contents($filePath, $jsonRecipe);

    // Je retourne l'ID de la recette généré
    return $recipeDetails['id'];
}

// J'ai crée une fonction pour lire toutes les recettes depuis un dossier spécifié
function lireToutesLesRecettes($dossier) {
    // Je vérifie si le dossier existe
    if (!is_dir($dossier)) {
        // Je gére l'erreur, par exemple en lançant une exception
        throw new Exception("Le dossier des recettes n'existe pas.");
    }

    // Ici j'initialise le tableau qui contiendra les recettes
    $recettes = array();

    // J'ouvre le dossier
    $handle = opendir($dossier);

    // Je parcoure les fichiers du dossier
    while (false !== ($fichier = readdir($handle))) {
        // J'exclus les fichiers spéciaux (., .., etc.)
        if ($fichier != "." && $fichier != "..") {
            // je lis le contenu du fichier
            $cheminFichier = $dossier . '/' . $fichier;
            $contenuRecette = file_get_contents($cheminFichier);

            // J'ajoute la recette au tableau
            $recettes[] = json_decode($contenuRecette, true);
        }
    }

    // je ferme le gestionnaire de dossier
    closedir($handle);

    // je retourne le tableau de recettes
    return $recettes;
}

// J'ai crée une fonction pour récupérer toutes les recettes depuis les fichiers JSON
function getAllRecipes() {
    // Je déclare la variable $recipes comme un tableau vide pour stocker les données des recettes.
    $recipes = array();

    // J'utilise la fonction `glob()` pour récupérer les noms de tous les fichiers JSON de recettes dans le dossier 'data/recettes/'.
    $recipeFiles = glob('data/recettes/*.json');

    // J'ai itérer à travers chaque fichier de recettes récupéré par `glob()`.
    foreach ($recipeFiles as $file) {
        // je lis le contenu du fichier JSON actuel (file_get_contents).
        $content = file_get_contents($file);

        // je décode le contenu JSON en un tableau PHP (json_decode) et l'ajouter au tableau $recipes.
        $recipeData = json_decode($content, true);
        $recipes[] = $recipeData;
    }

    // Je retourne le tableau $recipes contenant toutes les recettes.
    return $recipes;
}

// Je crée une fonction pour récupérer une recette spécifique par son ID
function getRecipe($id) {
    // Je definis une variable contenant le chemin du fichier en concaténant le chemin du dossier, l'ID de la recette, et l'extension '.json'.
    $cheminFichier = 'data/recettes/' . $id . '.json';

    // Je récupére le contenu du fichier (si le fichier spécifié existe).
    if (file_exists($cheminFichier)) {
        // je lis le contenu du fichier JSON actuel (file_get_contents).
        $content = file_get_contents($cheminFichier);

        // Je décode le contenu JSON en un tableau PHP (json_decode).
        return json_decode($content, true);
    } else {
        // Et si le fichier n'existe pas, retourne null.
        return null;
    }
}
?>
