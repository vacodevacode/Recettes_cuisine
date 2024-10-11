<?php

include('header.php');
include('functions.php');
include('db.php');

// Nom de la table
define('TABLE_NAME', 'recipes');

try {
    // Je vérifie si la table existe déjà
    $tableCheck = $conn->query("SHOW TABLES LIKE '" . TABLE_NAME . "'");
    if ($tableCheck->rowCount() == 0) {
        // Je crée de la table
        $sql = "CREATE TABLE " . TABLE_NAME . " (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            ingredients TEXT NOT NULL,
            steps TEXT NOT NULL
        )";

        // J'éxécute la requête
        $conn->exec($sql);

        echo "Table " . TABLE_NAME . " créée avec succès.";
    } else {
        echo "La table " . TABLE_NAME . " existe déjà.";
    }
} catch (PDOException $e) {
    echo "Erreur lors de la création de la table : " . $e->getMessage();
}

// Je ferme la connexion PDO
$conn = null;
?>
