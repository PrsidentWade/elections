<?php
session_start();

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
    $email_utilisateur = $_POST['email_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête SQL pour récupérer les informations du président du centre
    $sql = $conn->prepare("SELECT * FROM president_centre WHERE email_utilisateur = ?");
    $sql->bind_param("s", $email_utilisateur);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Vérification du mot de passe
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            // Authentification réussie
            $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
            $_SESSION['nom_utilisateur'] = $row['nom_utilisateur'];
            $_SESSION['email_utilisateur'] = $row['email_utilisateur'];

            header("Location: index.php"); // Rediriger vers la page protégée
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermeture de la connexion
    $conn->close();
}
?>
