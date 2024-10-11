<?php

$servername = "votre_serveur";
$username = "root";
$password = "Skippy77@.";
$dbname = "recip_app";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données. Veuillez contacter l'administrateur du site.";

    error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 0);
    die();
}
?>
