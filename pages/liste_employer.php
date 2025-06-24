<?php
require("../inc/fonction.php");
if (!isset($_GET['dept_no'])) {
    die("Aucun département sélectionné.");
}

$dept_no = $_GET['dept_no'];

$dept_name = getDepartmentName($dept_no);
$employees = getEmployeesOfDepartment( $dept_no);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employés - <?= htmlspecialchars($dept_name) ?></title>
</head>
<body>
    <h1>Employés du département : <?= htmlspecialchars($dept_name) ?> (<?= htmlspecialchars($dept_no) ?>)</h1>

    <?php if (!empty($employees)): ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>x
            <th>Nom</th>
            <th>Date d'embauche</th>
        </tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['emp_no'] ?></td>
            <td><?= $emp['first_name'] . ' ' . $emp['last_name'] ?></td>
            <td><?= $emp['hire_date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Aucun employé trouvé pour ce département.</p>
    <?php endif; ?>

    <p><a href="index.php">⬅ Retour à la liste</a></p>
    
</body>
</html>
