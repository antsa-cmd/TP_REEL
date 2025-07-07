<?php
require('../inc/fonction.php');
$employer = null;
$message = "";
$db = dbconnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personne = trim($_POST["personne"]);

    if (!empty($personne)) {
        $stm = $db->prepare("SELECT * FROM employees WHERE first_name = ?");
        if (!$stm) {
            die("Erreur dans la requête SQL : " . $db->error);
        }

        $stm->bind_param("s", $personne);
        $stm->execute();
        $result = $stm->get_result();

        if ($result && $result->num_rows > 0) {
            $employer = $result->fetch_assoc();
        } else {
            $message = "Aucun(e) employé(e) trouvé(e) avec ce prénom.";
        }
        $stm->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche d'employé</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <script src="../asset/bootstrap.bundle.min.js"></script>
</head>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Entreprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">🏠 Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recherche.php">🔍 Recherche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salaires.php">💰 Historique de salaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">🔍 Recherche d'employé</h1>

        <form method="post" class="mb-4">
            <div class="mb-3">
                <label for="personne" class="form-label">Prénom de la personne :</label>
                <input type="text" id="personne" name="personne" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($employer): ?>
            <h3 class="mt-4">Informations de la personne</h3>
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Genre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($employer["first_name"]) ?></td>
                        <td><?= htmlspecialchars($employer["last_name"]) ?></td>
                        <td><?= htmlspecialchars($employer["gender"]) ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
