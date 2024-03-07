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
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email_utilisateur = $_POST['email_utilisateur'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    // Préparation de la requête préparée
    $sql = $conn->prepare("INSERT INTO president_centre (nom_utilisateur, email_utilisateur, mot_de_passe) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $nom_utilisateur, $email_utilisateur, $mot_de_passe);

    // Exécution de la requête
    if ($sql->execute()) {
        // Succès
        header("Location: index.html");
    } else {
        // Erreur
        echo "Erreur lors de l'ajout du président de centre : " . $conn->error;
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
