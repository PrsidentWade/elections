<?php
session_start();

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

// Requête SQL pour récupérer les scores par centre de vote
$sql = "SELECT cv.id_centre_vote, cv.nom_centre_vote,
               b.id_bureau_vote, b.nom_bureau_vote,
               c.id_candidat, c.nom_candidat, c.parti_politique,
               s.score_obtenu
        FROM centre_vote cv
        INNER JOIN bureau_vote b ON cv.id_centre_vote = b.id_centre_vote
        LEFT JOIN score s ON b.id_bureau_vote = s.id_bureau_vote
        LEFT JOIN candidat c ON s.id_candidat = c.id_candidat
        ORDER BY cv.id_centre_vote, b.id_bureau_vote, c.id_candidat";

$result = $conn->query($sql);

if ($result === false) {
    die("Erreur SQL : " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Scores par Centre de Vote</title>
    <!-- Inclure les fichiers CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Détails des Scores par Centre de Vote</h1>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<p>';
            echo 'ID Centre de Vote : ' . $row['id_centre_vote'] . '<br>';
            echo 'Nom Centre de Vote : ' . $row['nom_centre_vote'] . '<br>';
            echo 'ID Bureau de Vote : ' . $row['id_bureau_vote'] . '<br>';
            echo 'Nom Bureau de Vote : ' . $row['nom_bureau_vote'] . '<br>';
            echo 'ID Candidat : ' . $row['id_candidat'] . '<br>';
            echo 'Nom Candidat : ' . $row['nom_candidat'] . '<br>';
            echo 'Parti Politique : ' . $row['parti_politique'] . '<br>';
            echo 'Score Obtenu : ' . $row['score_obtenu'] . '<br>';
            echo '</p>';
        }
        ?>
    </div>

    <!-- Inclure les fichiers JS Bootstrap (jQuery requis) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fermeture de la connexion
$conn->close();
?>
