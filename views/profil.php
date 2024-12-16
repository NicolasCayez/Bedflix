<?php
include '../base_dir.php';
include($base_dir.'/models/connect.php');
include($base_dir.'/models/_classes.php');

$roles = $role->select();
// $utilisateurs = $utilisateur->select();

if(empty($_SESSION['utilisateur'])) {        
    // Permet de détruire la session PHP courante ainsi que toutes les données rattachées
    session_destroy();
    header('Location: <?php $base_dir?>/views/connexion.php');
} elseif (!empty($_SESSION['utilisateur'])) {
    $user = $utilisateur->selectById($_SESSION['utilisateur']['id_utilisateur']);
    $email = $user[0]['email_utilisateur'];
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css" />

    <title>Profil</title>
</head>
<body>
    <header>
        <?php include ($base_dir."/views/header.php"); ?>
    </header>

    <h1>profil.php</h1>

    <footer>
        <?php include ($base_dir."/views/footer.php"); ?>
    </footer>
</body>
</html>