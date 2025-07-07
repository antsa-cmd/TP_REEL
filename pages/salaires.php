<?php
include("../inc/connexion.php");
$conn = dbconnect();

$limit = 20; 
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
$offset = ($page - 1) * $limit;

$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM salaries");
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT * FROM salaries ORDER BY emp_no, from_date DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Salaires</title>
    <link href="../asset/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="text-center mb-4">Liste des Salaires</h2>
    <p><a href="index.php">retour a la liste</a></p>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Numéro Employé</th>
                <th>Salaire</th>
                <th>De</th>
                <th>À</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['emp_no'] ?></td>
                        <td><?= $row['salary'] ?> Ar</td>
                        <td><?= $row['from_date'] ?></td>
                        <td><?= $row['to_date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun salaire trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= max(1, $page - 1) ?>">Précédent</a>
            </li>

            <?php
            $adjacents = 2;
            $start = max(1, $page - $adjacents);
            $end = min($totalPages, $page + $adjacents);

            if ($start > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if ($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }

            for ($i = $start; $i <= $end; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
            }

            if ($end < $totalPages) {
                if ($end < $totalPages - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                echo "<li class='page-item'><a class='page-link' href='?page=$totalPages'>$totalPages</a></li>";
            }
            ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= min($totalPages, $page + 1) ?>">Suivant</a>
            </li>
        </ul>
    </nav>
</div>

<script src="../asset/bootstrap.bundle.min.js"></script>
</body>
</html>
