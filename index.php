<?php
include('./models/connect.php');
include('./models/_classes.php');

$roles = $db->query("SELECT * FROM roles;")->fetchAll(PDO::FETCH_ASSOC);
// $utilisateurs = $utilisateur->select();

if(empty($_SESSION["utilisateur"])) {        
    // Permet de détruire la session PHP courante ainsi que toutes les données rattachées
    session_destroy();
    header("Location: ./views/connexion.php");
} elseif (!empty($_SESSION["utilisateur"])) {
    $user = $utilisateur->selectById($_SESSION["utilisateur"]["id_utilisateur"]);
    $email = $user[0]["email_utilisateur"];
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>index.php</h1>
    <?php if (isset($email)) {echo '<p>Connecté avec l\'identifiant<strong> '.$email.'</strong></p>';} ?>
    <p><a href="./controllers/deconnexion.php">Se déconnecter</a></p>
</body>
</html>
