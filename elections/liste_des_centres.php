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

// Récupération des centres de vote
$result = $conn->query("SELECT id_centre_vote, nom_centre_vote FROM centre_vote");

// Affichage des options dans la liste déroulante
echo '<select name="id_centre_vote" required>';
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row['id_centre_vote'] . "\">" . $row['nom_centre_vote'] . "</option>";
    }
} else {
    echo "Erreur lors de la récupération des centres de vote : " . $conn->error;
}
echo '</select><br>';

// Fermeture de la connexion
$conn->close();
?>
