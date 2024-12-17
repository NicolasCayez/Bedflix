<?php
include('../base_dir.php');
include($base_dir.'/models/connect.php');
include($base_dir.'/models/_classes.php');

$roles = $role->select();
// $utilisateurs = $utilisateur->select();

if(empty($_SESSION['utilisateur']) || $_SESSION['utilisateur']['id_role'] != 1) {        
    // Permet de détruire la session PHP courante ainsi que toutes les données rattachées
    session_destroy();
    header('Location: '.$base_dir.'/views/connexion.php');
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
    <link rel="stylesheet" href="<?php $base_dir?>/css/styles.css" />
    <title>Administration</title>
</head>
<body>
    <header id="admin">
        <?php include($base_dir."/views/header.php"); ?>
    </header>
    <h1>Bienvenue sur l'interface d'administration</h1>

    <nav>
    <?php $formFilm = false; $formSerie = false; $formSaison = false; 
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "film")) {$formFilm = true;}
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "serie")) {$formSerie = true;}
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "saison")) {$formSaison = true;} ?>
        <form method="post">
            <fieldset>
                <legend>Sélectionner le type de média</legend>
                <input type="hidden" name="form_media" value="1">
                <select id="form_media_type" name="form_media_type">
                    <option value="film"<?php if(isset($_POST['form_media_type']) && $formFilm) {echo 'selected';} ?>>Film</option>
                    <option value="serie"<?php if(isset($_POST['form_media_type']) && $formSerie) {echo 'selected';} ?>>Série</option>
                    <option value="saison"<?php if(isset($_POST['form_media_type']) && $formSaison) {echo 'selected';} ?>>Saison dans une série existante</option>
                </select>
                <input type="submit" value="Valider choix">
            </fieldset>
        </form>
        <form method="post">
            <?php if(isset($_POST['form_media_type']) && ($formFilm || $formSerie || $formSaison)) { ?>
                <fieldset>
                    <legend>Informations film ou serie</legend>
                    <!-- SERIE ou FILM -->
                    <?php if($formFilm || $formSerie) { ?>
                        <label for="titre_libelle">Titre du media</label>
                        <input type="text" name="titre_libelle" placeholder="titre">
                        <label for="description">Description du media</label>
                        <input type="text" name="description" placeholder="description">
                        <?php if($formFilm) { ?>
                            <!-- FILM -->
                            <label for="duree">Durée du media</label>
                            <input type="text" name="duree" placeholder="duree">
                        <?php } ?>
                        <label for="lien">Lien du media</label>
                        <input type="url" name="lien" placeholder="lien">
                        <label for="affiche">affiche du media</label>
                        <input type="file" name="affiche">
                    <?php }
                    if($formSaison) { ?>
                        <!-- SAISON -->
                        <select id="" name="media_type">
                            <?php $seriesList = $serie->select();
                            foreach ($seriesList as $uneSerie) {
                                $titre = $uneSerie['titre_serie'];
                                echo '<option>'.$titre.'</option>';
                            }?>
                        </select>
                        <label for="numero">Numéro de la saison</label>
                        <input type="text" name="numero" placeholder="numero">
                        <label for="titre">Titre de la saison</label>
                        <input type="text" name="titre" placeholder="titre">
                    <?php } ?>
                </fieldset>
                <!-- SERIE ou FILM -->
                <?php if($formFilm || $formSerie) { ?>
                    <fieldset>
                        <legend>Sélectionner les catégories</legend>
                        <div class="cat_grid">
                            <?php $catList = $categorie->select();
                            foreach ($catList as $uneCat) {
                                $lib = strtolower($uneCat['libelle_categorie']);
                                echo '<input type="checkbox" id="'.$lib.'" name="'.$lib.'" />
                                <label for="'.$lib.'">'.ucfirst($lib).'</label>';
                            }?>
                        </div>
                    </fieldset>
                <?php }
            } ?>
        </form>
    </nav>

</body>
</html>
