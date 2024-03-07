<?php
// Récupérer les données du formulaire

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
    $nom_bureau_vote = $_POST['nom_bureau_vote'];
    $id_centre_vote = $_POST['id_centre_vote'];

    // Préparation de la requête préparée
    $sql = $conn->prepare("INSERT INTO bureau_vote (nom_bureau_vote, id_centre_vote) VALUES (?, ?)");
    $sql->bind_param("ss", $nom_bureau_vote, $id_centre_vote);

    // Exécution de la requête
    if ($sql->execute()) {
        // Succès
        echo "Bureau de Vote créé avec succès. ID du Bureau de Vote : " . $conn->insert_id;
    } else {
        // Erreur
        echo "Erreur lors de la création du Bureau de Vote : " . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
