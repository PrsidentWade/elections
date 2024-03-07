<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: index.html"); // Rediriger vers la page de connexion
    exit();
}

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


// Requête SQL pour récupérer les scores
$sql = "SELECT id, id_bureau_vote, id_candidat, score FROM score";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Protégée</title>
    <!-- Inclure les fichiers CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
                <h1 class="mb-4">Bienvenue, <?php echo $_SESSION['nom_utilisateur']; ?> !</h1>
        <p>Vous êtes maintenant connecté en tant que président du centre.</p>

        <form action="deconnexion.php" method="post">
            <button type="submit" class="btn btn-danger">Se Déconnecter</button>
        </form>
    </div>

     <div class="container mt-5">
        <h1 class="mb-4">Bienvenue sur la Page d'Accueil</h1>

        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="creer_bureau_de_vote.html" class="btn btn-primary btn-block">Ajouter un Bureau de Vote</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="creer_centre_vote.html" class="btn btn-success btn-block">Ajouter un Centre de Vote</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="ajout_score.html" class="btn btn-info btn-block">Ajouter des Scores</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="create_candidat.html" class="btn btn-warning btn-block">Ajouter un candidat</a>
            </div>
        </div>

         <div class="container mt-5">
        <h1 class="mb-4">Tableau des Scores</h1>
         <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Score</th>
                        <th>ID Bureau de Vote</th>
                        <th>ID Candidat</th>
                        <th>Score Obtenu</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $statut = determineStatut($row['score']);
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['id_bureau_vote'] . '</td>';
                        echo '<td>' . $row['id_candidat'] . '</td>';
                        echo '<td>' . $row['score'] . '</td>';
                        echo '<td>' . $statut . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>


    <!-- Inclure les fichiers JS Bootstrap (jQuery requis) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fonction pour déterminer le statut en fonction du score
function determineStatut($score) {
    // verifier si le candidat est élu au 1er tour, 2e tour ou éliminé
    if ($score >= 50) {
        return "Élu au 1er tour";
    } elseif ($score >= 12.5) {
        return "Participe au 2e tour";
    } else {
        return "Éliminé";
    }
}
?>

<?php
// Fermeture de la connexion
$conn->close();
?>


