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
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Salaires</h2>

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

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
