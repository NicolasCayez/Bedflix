<?php
    include('./connect.php');

    if(!empty($_POST["form_connexion"])) {
        $select = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur=:email_utilisateur;");
        $select->bindParam(":email_utilisateur", $_POST["form_email"]);
        $select->execute();
        if(isset($_POST["form_email"])){
            // La fonction rowCount() permet de donner le nombre de lignes pour une requête
            if($select->rowCount() === 1) {
                $user = $select->fetch(PDO::FETCH_ASSOC);
                // Permet de vérifier le hash par rapport au mot de passe saisi
                if(password_verify($_POST["form_password"], $user['mot_de_passe_utilisateur'])) {
                // On affecte les données de notre utilisateur dans notre super globale $_SESSION
                $_SESSION['utilisateur'] = $user;
                // Le header permet d'effectuer une requête HTTP, la valeur Location permet la redirection vers un autre fichier
                header("Location: index.php");
            }
        }
        } else {
            unset($_SESSION['utilisateur']);
        }
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>connexion.PHP</h1>
    <?php if(!isset($_POST['form_email'])) { ?>
    <form action="connexion.php" method="post">
        <label for="form_email">Email:</label>
        <input type="text" name="form_email" id="form_email" placeholder="Ex: nomprenom@fournisseur.com">
        <input type="submit" value="Etape suivante">
    </form>
    <?php } else {?>
    <form method="post">
        <input type="hidden" name="form_connexion" value="1">
        <input style="display: none" type="text" name="form_email" id="form_email" value="<?php $_POST['form_email'] ?>">
        <label for="form_password">Mot de passe:</label>
        <input type="password" name="form_password" id="form_password" placeholder="1234">
        <input type="submit" value="Se connecter">
    </form>


    <!-- <form method="post">
        <input type="hidden" name="form_connexion" value="1">
        <label for="form_email">Email:</label>
        <input type="text" name="form_email" id="form_email" placeholder="Ex: nomprenom@fournisseur.com">
        <label for="form_password">Mot de passe:</label>
        <input type="password" name="form_password" id="form_password" placeholder="1234">
        <input type="submit" value="Se connecter">
    </form> -->

    <?php } ?>
</body>
</html>
