<?php
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

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$partie_politique = $_POST['partie_politique'];

// Préparation de la requête préparée
$sql = $conn->prepare("INSERT INTO candidat (nom, prenom, partie_politique) VALUES (?, ?, ?)");
$sql->bind_param("sss", $nom, $prenom, $partie_politique);

// Exécution de la requête
if ($sql->execute()) {
    // Succès
    echo "Nouveau candidat ajouté avec succès. ID du candidat : " . $conn->insert_id;
} else {
    // Erreur
    echo "Erreur lors de l'ajout du candidat : " . $conn->error;
}

// Fermeture de la connexion
$conn->close();
?>
