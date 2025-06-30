<?php
require("../inc/fonction.php");

$departments = getDepartmentsWithManager();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Départements</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <script src="../asset/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Liste des départements</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Manager actuel</th>
        </tr>
        <?php foreach ($departments as $row): ?>
        <tr>
            <td><a href="liste_employer.php?dept_no=<?= $row['dept_no'] ?>"><?= $row['dept_no'] ?></a></td>
            <td><?= htmlspecialchars($row['dept_name']) ?></td>
            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="recherche.php">Rechercher une  personne </a></p>
</body>
</html>
