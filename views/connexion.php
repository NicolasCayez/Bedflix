<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $base_dir?>/css/styles.css" />
    <title>Connexion</title>
</head>
<body class="body_custom">
    <?php if(!isset($_POST['form_email'])) { ?>
        <div class="custom_card">
            <h1>Connexion</h1>
            <form action="<?php $base_dir?>/views/connexion.php" method="post">
                <label for="form_email">Email:</label>
                <input type="text" name="form_email" id="form_email" placeholder="Ex: nomprenom@fournisseur.com" class="margin-top-5">
                <input type="submit" value="Etape suivante" class="margin-top-20">
            </form>
        </div>
        <?php } else { 
            // Nettoyage des entrées utilisateur
            $email = htmlentities(htmlspecialchars(strip_tags($_POST['form_email'])));
            ?>
        <div class="custom_card">
            <h1>Connexion - suite</h1>
            <form action="<?php $base_dir?>/models/model_connexion.php" method="post">
                <input type="hidden" name="form_connexion" value="1">
                <input type="hidden" name="form_email" id="form_email" value="<?php echo $email ?>" class="margin-top-5">
                <label for="form_password">Mot de passe:</label>
                <input type="password" name="form_password" id="form_password" placeholder="1234" class="margin-top-5">
                <input type="submit" value="Se connecter" class="margin-top-20">
            </form>
            <?php } ?>
            <form action="<?php $base_dir?>/views/inscription.php" method="post">
                <label for="form_password">Pas de compte, inscrivez-vous:</label>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
</body>
</html>
