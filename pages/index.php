<?php
require("../inc/fonction.php");
$departments = getDepartmentsWithManager();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Départements</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <script src="../asset/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Barre de navigation -->
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

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Liste des départements</h1>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Manager actuel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $row): ?>
                <tr>
                    <td>
                        <a href="liste_employer.php?dept_no=<?= $row['dept_no'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($row['dept_no']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($row['dept_name']) ?></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="recherche.php" class="btn btn-primary">Rechercher une personne</a>
        </div>
    </div>
</body>
</html>
