<?php
require('../inc/fonction.php');
if (!isset($_GET['emp_no'])) die("Employé non défini.");
$emp_no = (int)$_GET['emp_no'];

// 1) Infos de base
$db = dbconnect();
$stmt = $db->prepare("SELECT * FROM employees WHERE emp_no = ?");
$stmt->bind_param("i", $emp_no);
$stmt->execute();
$emp = $stmt->get_result()->fetch_assoc();

// 2) Historique des salaires
$sals = mysqli_query($db,
  "SELECT salary, from_date, to_date 
   FROM salaries 
   WHERE emp_no = $emp_no 
   ORDER BY from_date DESC");

// 3) Historique des postes (dept_emp)
$jobs = mysqli_query($db,
  "SELECT dept_no, from_date, to_date 
   FROM dept_emp 
   WHERE emp_no = $emp_no 
   ORDER BY from_date DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Fiche Employé <?= $emp_no ?></title></head>
<body>
  <h1><?= htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name']) ?></h1>
  <p>Genre : <?= $emp['gender'] ?> – Embauché le <?= $emp['hire_date'] ?></p>

  <h2>Historique des salaires</h2>
  <table border="1"><tr><th>Salaire</th><th>De</th><th>À</th></tr>
    <?php while($row = mysqli_fetch_assoc($sals)): ?>
      <tr>
        <td><?= $row['salary'] ?> Ar</td>
        <td><?= $row['from_date'] ?></td>
        <td><?= $row['to_date'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h2>Historique des départements</h2>
  <table border="1"><tr><th>Département</th><th>De</th><th>À</th></tr>
    <?php while($row = mysqli_fetch_assoc($jobs)): ?>
      <tr>
        <td><?= htmlspecialchars(getDepartmentName($row['dept_no'])) ?></td>
        <td><?= $row['from_date'] ?></td>
        <td><?= $row['to_date'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <p><a href="liste_employer.php?dept_no=<?= urlencode($row['dept_no']) ?>">« Retour aux employés</a></p>
</body>
</html>
