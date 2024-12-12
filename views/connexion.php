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
        <?php } else { 
            // Nettoyage des entrées utilisateur
            $email = htmlentities(htmlspecialchars(strip_tags($_POST["form_email"])));
            ?>
            <form action="../models/model_connexion.php" method="post">
                <input type="hidden" name="form_connexion" value="1">
                <input type="hidden" name="form_email" id="form_email" value="<?php echo $email ?>">
                <label for="form_password">Mot de passe:</label>
                <input type="password" name="form_password" id="form_password" placeholder="1234">
                <input type="submit" value="Se connecter">
            </form>
    <?php } ?>
    <form action="../views/inscription.php" method="post">
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
