<?php
require('../inc/fonction.php');
$employer = null;
$message = "";
$db = dbconnect();
if($_SERVER["REQUEST_METHOD"]==  "POST"){
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
        $message = "Aucun(e) client(e) trouvé(e) avec ce code.";
    }
    $stm->close();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>RECHERCHE</h1>
    <form method="post">
        <label for="personne">NOM de la personne:</label>
        <input type="text" id="code" name="personne" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php if (!empty($message)): ?>
        <p style="color: red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

     <?php if ($employer): ?>
        <h3>Informations de la personne</h3>
        <table border="1">
            <tr>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>GENRE</th>
    
            </tr>
            <tr>
                <td><?= htmlspecialchars($employer["first_name"]) ?></td>
                <td><?= htmlspecialchars($employer["last_name"]) ?></td>
                <td><?= htmlspecialchars($employer["gender"]) ?></td>
            </tr>
        </table>
    <?php endif; ?>

    
</body>
</html>