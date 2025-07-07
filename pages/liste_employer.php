<?php
require("../inc/fonction.php");
if (!isset($_GET['dept_no'])) {
    die("Aucun département sélectionné.");
}

$dept_no = $_GET['dept_no'];

$dept_name = getDepartmentName($dept_no);
$employees = getEmployeesOfDepartment($dept_no);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Employés - <?= htmlspecialchars($dept_name) ?></title>
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
        <h1 class="mb-4 text-center">
            Employés du département : <strong><?= htmlspecialchars($dept_name) ?></strong> (<?= htmlspecialchars($dept_no) ?>)
        </h1>

        <?php if (!empty($employees)): ?>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Date d'embauche</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $emp): ?>
                    <tr>
                        <td><?= $emp['emp_no'] ?></td>
                        <td><?= htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name']) ?></td>
                        <td><?= htmlspecialchars($emp['hire_date']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Aucun employé trouvé pour ce département.
            </div>
        <?php endif; ?>

        <div class="mt-4 d-flex justify-content-around">
            <a href="index.php" class="btn btn-secondary">← Retour à la liste</a>
            <a href="recherche.php" class="btn btn-primary">🔍 Rechercher une personne</a>
            <a href="salaires.php" class="btn btn-info text-white">💰 Salaire des employés</a>
        </div>
    </div>
</body>
</html>
