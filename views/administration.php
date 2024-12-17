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
// formulaires de création
//variables
$titre_libelle = "";
$description = "";
$lien = "";
$affiche = "";
$duree = "";
$saison_serie = "";
$numero = "";
$titre_saison = "";
$id_serie = "";
// ENTREES DE FORMULAIRE 
// FILM + SERIE
if(((!empty($_POST['form_film'])) && isset($_POST['form_film']))
    || ((!empty($_POST['form_serie'])) && isset($_POST['form_serie']))
) {
    if (!empty($_POST['form_titre_libelle']) && isset($_POST['form_titre_libelle']))
    {
        // Nettoyage des entrées FILM + SERIE
        $titre_libelle = htmlentities(htmlspecialchars(strip_tags($_POST['form_titre_libelle'])));
    }
    if (!empty($_POST['form_description']) && isset($_POST['form_description']))
    {
        // Nettoyage des entrées FILM + SERIE
        $description = htmlentities(htmlspecialchars(strip_tags($_POST['form_description'])));
    }
    if (!empty($_POST['form_lien']) && isset($_POST['form_lien']))
    {
        // Nettoyage des entrées FILM + SERIE
        $lien = htmlentities(htmlspecialchars(strip_tags($_POST['form_lien'])));
    }
    // FILM (entrées spécifiques)
    if (!empty($_POST['form_duree']) && isset($_POST['form_duree'])) {
        // Nettoyage des entrées spécifiques FILM
        $duree = htmlentities(htmlspecialchars(strip_tags($_POST['form_duree'])));
    }
    // Fichier affiche
    // Permet de tester si le fichier importé existe et qu'il est différent de NULL
    if (isset($_FILES['form_affiche'])) {
        // Stocke le chemin et le nom temporaire du fichier importé (ex /tmp/125423.pdf)
        $tmpName = $_FILES['form_affiche']['tmp_name'];
        // Stocke le nom du fichier (nom du fichier et son extension importé ex : test.jpg)
        $name = $titre_libelle.'.'.substr(strrchr($_FILES['form_affiche']['name'], '.'), 1);
        // La taille du fichier en octets
        $size = $_FILES['form_affiche']['size'];
        // Stocke les erreurs (problème d'import, de droits, etc...)
        $error = $_FILES['form_affiche']['error'];
        // Déplace le fichier importé dans le dossier image à la racine du projet
        $affiche = $base_dir.'/import/imgs/'.$name;
        $fichier = move_uploaded_file($tmpName, $base_dir.'/import/imgs/'.$name);
    }
}

// SAISON
if(!empty($_POST['form_saison']) && isset($_POST['form_saison'])
    && (!empty($_POST['form_saison_serie'])) && (!isset($_POST['form_saison_serie']))
    && (!empty($_POST['form_numero'])) && (!isset($_POST['form_numero']))
    && (!empty($_POST['form_titre_saison'])) && (!isset($_POST['form_titre_saison']))
) {
    $saison_serie = htmlentities(htmlspecialchars(strip_tags($_POST['form_saison_serie'])));
    $numero = htmlentities(htmlspecialchars(strip_tags($_POST['form_numero'])));
    $titre_saison = htmlentities(htmlspecialchars(strip_tags($_POST['form_titre_saison'])));
    $id_serie = $serie->selectByTitre($saison_serie);
}

// Insertion FILM
if (!empty($_POST['form_film']) && isset($_POST['form_film'])
    && !empty($_POST['creation']) && isset($_POST['creation'])) {
    // Insertion, true si réussi, false si raté
    if($film->insert($titre_libelle, $description, $affiche, $lien, $duree)) {
        // Si aucune erreur ne se produit, on propose de se connecter
        die('<p style=”color: green;”>Création réussie.</p><a href="'.$base_dir.'/views/administration.php">Nouvelle saisie.</a>');
    }
    die('<p style=”color: red;”>Création échouée.</p><a href="'.$base_dir.'/views/administration.php">Réessayer.</a>');
}

// Insertion SERIE
if (!empty($_POST['form_serie']) && isset($_POST['form_serie'])
    && !empty($_POST['creation']) && isset($_POST['creation'])) {
    // Insertion, true si réussi, false si raté
    var_dump($titre_libelle);
    if($serie->insert($titre_libelle, $description, $affiche, $lien)) {
        // Si aucune erreur ne se produit, on propose de se connecter
        die('<p style=”color: green;”>Création réussie.</p><a href="'.$base_dir.'/views/administration.php">Nouvelle saisie.</a>');
    }
    die('<p style=”color: red;”>Création échouée.</p><a href="'.$base_dir.'/views/administration.php">Réessayer.</a>');
}
// Insertion SAISON
if (!empty($_POST['form_saison']) && isset($_POST['form_saison'])
    && !empty($_POST['creation']) && isset($_POST['creation'])) {
    // Insertion, true si réussi, false si raté
    if($saison->insert($titre_saison, $numero, $id_serie)) {
        // Si aucune erreur ne se produit, on propose de se connecter
        die('<p style=”color: green;”>Création réussie.</p><a href="'.$base_dir.'/views/administration.php">Nouvelle saisie.</a>');
    }
    die('<p style=”color: red;”>Création échouée.</p><a href="'.$base_dir.'/views/administration.php">Réessayer.</a>');
}
// Modification / Suppression FILM
if (!empty($_POST['form_serie']) && isset($_POST['form_serie'])
&& !empty($_POST['modification']) && isset($_POST['modification'])) {
    // modification
    if (!empty($_POST['modifier_un_film'])) {
        $id_film = (int)$_POST['form_id_film'];
        if($film->updateById($id_film, $titre_libelle, $description, $affiche, $lien, $duree)) {
            // Si aucune erreur ne se produit, on propose de se connecter
            die('<p style=”color: green;”>Modification réussie.</p><a href="'.$base_dir.'/views/administration.php">Retour menu.</a>');
        }
        die('<p style=”color: red;”>Modification échouée.</p><a href="'.$base_dir.'/views/administration.php">Réessayer.</a>');
    }
    // suppression
    if (!empty($_POST['supprimer'])) {
        $id_film = (int)$_POST['form_id_film'];
        if($film->deleteById($id_film)) {
            // Si aucune erreur ne se produit, on propose de se connecter
            die('<p style=”color: green;”>Suppression réussie.</p><a href="'.$base_dir.'/views/administration.php">Retour menu.</a>');
        }
        die('<p style=”color: red;”>Suppression échouée.</p><a href="'.$base_dir.'/views/administration.php">Réessayer.</a>');
    }
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

    <?php $formFilm = false; $formSerie = false; $formSaison = false;
        $formUpdateFilm = false; $formUpdateSerie = false; $formUpdateSaison = false;
    // Initialisation variables
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "film")) {$formFilm = true;}
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "serie")) {$formSerie = true;}
    if(isset($_POST['form_media_type']) && ($_POST['form_media_type'] == "saison")) {$formSaison = true;}
    if(isset($_POST['form_update_media_type']) && ($_POST['form_update_media_type'] == "film")) {$formUpdateFilm = true;}
    if(isset($_POST['form_update_media_type']) && ($_POST['form_update_media_type'] == "serie")) {$formUpdateSerie = true;}
    if(isset($_POST['form_update_media_type']) && ($_POST['form_update_media_type'] == "saison")) {$formUpdateSaison = true;}
    ?>
    
<!-- Formulaire choix media a ajouter -->
    <?php if(!isset($_POST['form_update_media_type'])) { ?>
    <form method="post">
        <fieldset>
            <legend>Sélectionner le type de média à ajouter</legend>
            <input type="hidden" name="form_media" value="1">
            <select id="form_media_type" name="form_media_type">
                <option value="film"<?php if(isset($_POST['form_media_type']) && $formFilm) {echo 'selected';} ?>>Film</option>
                <option value="serie"<?php if(isset($_POST['form_media_type']) && $formSerie) {echo 'selected';} ?>>Série</option>
                <option value="saison"<?php if(isset($_POST['form_media_type']) && $formSaison) {echo 'selected';} ?>>Saison dans une série existante</option>
            </select>
            <input type="submit" value="Valider choix">
        </fieldset>
    </form>
    <?php } ?>
    <!-- Formulaire ajout media -->
    <form method="post" enctype="multipart/form-data">
        <?php if(isset($_POST['form_media_type']) && ($formFilm || $formSerie || $formSaison)) {
            if ($formFilm) { ?>
                <input type="hidden" name="form_film" value="1">
            <?php } else if ($formSerie) { ?>
                <input type="hidden" name="form_serie" value="1">
            <?php } else if ($formSaison) { ?>
                <input type="hidden" name="form_saison" value="1">
            <?php } ?>
            <fieldset>
                <legend>Informations film ou serie</legend>
                <!-- SERIE ou FILM -->
                <?php if($formFilm || $formSerie) { ?>
                    <label for="form_titre_libelle">Titre du media</label>
                    <input type="text" name="form_titre_libelle" placeholder="titre">
                    <label for="form_description">Description du media</label>
                    <input type="text" name="form_description" placeholder="description">
                    <?php if($formFilm) { ?>
                        <!-- FILM -->
                        <label for="form_duree">Durée du media</label>
                        <input type="text" name="form_duree" placeholder="duree">
                    <?php } ?>
                    <label for="form_lien">Lien du media</label>
                    <input type="text" name="form_lien" placeholder="lien">
                    <label for="form_affiche">affiche du media</label>
                    <input type="file" name="form_affiche">
                <?php }
                if($formSaison) { ?>
                    <!-- SAISON -->
                    <select name="form_saison_serie">
                        <?php $seriesList = $serie->select();
                        foreach ($seriesList as $uneSerie) {
                            $titre = $uneSerie['titre_serie'];
                            echo '<option>'.$titre.'</option>';
                        }?>
                    </select>
                    <label for="form_numero">Numéro de la saison</label>
                    <input type="text" name="form_numero" placeholder="numero">
                    <label for="form_titre_saison">Titre de la saison</label>
                    <input type="text" name="form_titre_saison" placeholder="titre">
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
            <?php } ?>
            <input type="hidden" name="creation" value=1>
            <input type="submit" value="Enregistrer">
        <?php } ?>
    </form>
    <!-- Formulaire choix type de media a modifier -->
    <?php if(!isset($_POST['form_media_type'])) { ?>
    <form method="post">
        <fieldset>
            <legend>Sélectionner le type de média à modifier ou supprimer</legend>
            <input type="hidden" name="form_update_media" value="1">
            <select id="form_update_media_type" name="form_update_media_type">
                <option value="film"<?php if(isset($_POST['form_update_media_type']) && $formFilm) {echo 'selected';} ?>>Film</option>
                <option value="serie"<?php if(isset($_POST['form_update_media_type']) && $formSerie) {echo 'selected';} ?>>Série</option>
                <option value="saison"<?php if(isset($_POST['form_update_media_type']) && $formSaison) {echo 'selected';} ?>>Saison dans une série existante</option>
            </select>
            <input type="submit" value="Valider choix">
        </fieldset>
    </form>
    <?php } ?>
    <!-- Formulaire liste media a modifier -->
    <form method="post">
        <?php if(isset($_POST['form_update_media_type']) && ($formUpdateFilm || $formUpdateSerie || $formUpdateSaison) && !isset($_POST['modification'])) {
            if ($formUpdateFilm) { ?>
                <input type="hidden" name="form_update_film" value="1">
            <?php } else if ($formUpdateSerie) { ?>
                <input type="hidden" name="form_update_serie" value="1">
            <?php } else if ($formUpdateSaison) { ?>
                <input type="hidden" name="form_update_saison" value="1">
            <?php } ?>
            <fieldset>
                <!-- FILM -->
                <?php if($formUpdateFilm) { ?>
                    <legend>Liste des films</legend>
                    <ul>

                        <?php $listeFilms = $film->select();
                        foreach ($listeFilms as $unFilm) {
                            echo '<form method="post"><li>'.$unFilm['titre_film'].' - Synopsys: '.$unFilm['description_film'].' - Durée : '.$unFilm['duree_film'].'</li>
                            <input type="hidden" name="form_update_media" value=1>
                            <input type="hidden" name="form_id_film" value='.$unFilm['id_film'].'>
                            <input type="submit" name="suppression" value="Supprimer">
                            <input type="submit" name="modification" value="Modifier"></form>';
                        } ?>
                    </ul>

                <?php } ?>
            </fieldset>

            <input type="submit" value="Enregistrer">
        <?php } ?>
    </form>
    <!-- Formulaire update media -->
    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['modification'])) {
            if(isset($_POST['form_update_film'])) {
                $leFilm = ($film->selectById((int)$_POST['form_id_film']))[0];
                $titre_libelle = $leFilm['titre_film'];
                $description = $leFilm['description_film'];
                $duree = $leFilm['duree_film'];
                $lien = $leFilm['lien_film'];
                $affiche = $leFilm['affiche_film'];
            }
            if(isset($_POST['form_update_serie'])) {
                $laSerie = ($serie->selectById((int)$_POST['form_id_serie']))[0];
                $titre_libelle = $laSerie['titre_serie'];
                $description = $laSerie['description_serie'];
                $lien = $laSerie['lien_serie'];
                $affiche = $laSerie['affiche_serie'];
            }
            ?>
            <fieldset>
                <legend>Informations film ou serie</legend>
                <!-- SERIE ou FILM -->
                <?php if(isset($_POST['form_update_film']) || isset($_POST['form_update_serie'])) { 
                    var_dump($titre_libelle);
                                ?>
                    <label for="form_titre_libelle">Titre du media</label>
                    <input type="text" name="form_titre_libelle" value="<?php echo $titre_libelle; ?>">
                    <label for="form_description">Description du media</label>
                    <input type="text" name="form_description" value="<?php echo $description; ?>">
                    <?php if(isset($_POST['form_update_film'])) { ?>
                        <!-- FILM -->
                        <label for="form_duree">Durée du media</label>
                        <input type="text" name="form_duree" value="<?php echo $duree; ?>">
                    <?php } ?>
                    <label for="form_lien">Lien du media</label>
                    <input type="text" name="form_lien" value="<?php echo $lien; ?>">
                    <label for="form_affiche">affiche du media</label>
                    <input type="file" name="form_affiche" value="<?php echo $affiche; ?>">
                <?php }
                if($formUpdateSaison) { ?>
                    <!-- SAISON -->
                    <select name="form_saison_serie">
                        <?php $seriesList = $serie->select();
                        $selectedSerie = ($saison->selectByIdSerie($_POST['id_serie']))[0];
                        foreach ($seriesList as $uneSerie) {
                            $titre = $uneSerie['titre_serie'];
                            $selected = '';
                            if($uneSerie['id_serie']==$selectedSerie['id_serie']){$selected = ' selected';}
                            echo '<option'.$selected.'>'.$titre.'</option>';
                        }?>
                    </select>
                    <label for="form_numero">Numéro de la saison</label>
                    <input type="text" name="form_numero" placeholder=<?php echo $numero ?>>
                    <label for="form_titre_saison">Titre de la saison</label>
                    <input type="text" name="form_titre_saison" placeholder=<?php echo $titre_saison ?>>
                <?php } ?>
            </fieldset>
            <!-- SERIE ou FILM -->
            <?php if($formUpdateFilm || $formUpdateSerie) { ?>
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
            <?php } ?>
            <input type="submit" value="Enregistrer">
        <?php } ?>
    </form>


</body>
</html>
