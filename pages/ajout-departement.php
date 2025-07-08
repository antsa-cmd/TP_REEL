<?php
require('../inc/fonction.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $info['dept_name'] = $_POST['departement'];
    $info['dept_no'] = $_POST['id-dep'];

    ajout_departement($info);
    header('Location: ajout-departement.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un département</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
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
        <h1 class="mb-4">Ajouter un département</h1>
        <form action="ajout-departement.php" method="POST" class="border p-4 rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="departement" class="form-label">Nom du département</label>
                <input type="text" id="departement" name="departement" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id-dep" class="form-label">ID du département</label>
                <input type="text" id="id-dep" name="id-dep" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Valider</button>
        </form>
    </div>

    <script src="../asset/bootstrap.bundle.min.js"></script>
</body>
</html>
