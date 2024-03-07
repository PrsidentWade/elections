<?php
// Inclure le fichier de connexion à la base de données
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$database = "elections";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_centre_vote = $_POST['nom_centre_vote'];
    $nom_commune = $_POST['nom_commune'];
    $nom_region = $_POST['nom_region'];
    $nom_departement = $_POST['nom_departement'];

    // Préparation de la requête préparée
    $sql = $conn->prepare("INSERT INTO centre_vote (nom_centre_vote, nom_commune, nom_region, nom_departement) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $nom_centre_vote, $nom_commune, $nom_region, $nom_departement);

    // Exécution de la requête
    if ($sql->execute()) {
        // Succès
        echo "Centre de Vote créé avec succès. ID du Centre de Vote : " . $conn->insert_id;
    } else {
        // Erreur
        echo "Erreur lors de la création du Centre de Vote : " . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
