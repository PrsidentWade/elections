<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $id_bureau_vote = $_POST['id_bureau_vote'];
    $id_candidat = $_POST['id_candidat'];
    $score = $_POST['score'];

    // Préparation de la requête préparée
    $sql = $conn->prepare("INSERT INTO score (id_bureau_vote, id_candidat, score) VALUES (?, ?, ?)");
    $sql->bind_param("iii", $id_bureau_vote, $id_candidat, $score);

    // Exécution de la requête
    if ($sql->execute()) {
        // Succès
        echo "Score ajouté avec succès. ID du score : " . $conn->insert_id;
    } else {
        // Erreur
        echo "Erreur lors de l'ajout du score : " . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
