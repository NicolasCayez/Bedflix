<?php
    include('../models/connect.php');
    include('../models/_classes.php');
    if(!empty($_POST['form_connexion']) && isset($_POST['form_connexion'])
        && !empty($_POST['form_email']) && isset($_POST['form_email'])
        && !empty($_POST['form_password']) && isset($_POST['form_password'])) {
        $email = htmlentities(htmlspecialchars(strip_tags($_POST['form_email'])));
        $password = htmlentities(htmlspecialchars(strip_tags($_POST['form_password'])));
        $utilFound = $utilisateur->selectByEmail($email);
        if(count($utilFound) === 1){
            $user = $utilFound[0];
            var_dump($user);
            // La fonction rowCount() permet de donner le nombre de lignes pour une requête
            if($user['email_utilisateur'] != NULL) {
                // Permet de vérifier le hash par rapport au mot de passe saisi
                if(password_verify($password, $user['mot_de_passe_utilisateur'])) {
                // On affecte les données de notre utilisateur dans notre super globale $_SESSION
                $_SESSION['utilisateur'] = $user;
                // Le header permet d'effectuer une requête HTTP, la valeur Location permet la redirection vers un autre fichier
                // header('Location: '.$base_dir.'/index.php');
                header('Location: ../index.php');
            }
        }
        } else {
            unset($_SESSION['utilisateur']);
            header('Location: ../index.php');
        }
    }
?>




