<nav>
    <div id="nav-start">
        <img src="<?php $base_dir ?>/img/bedflix-logo.png" alt="Logo" id="logo">
    </div>
    <div id="nav-center">
        <a href="<?php $base_dir?>/index.php">Accueil</a>
        <a href="<?php $base_dir?>/views/series.php">Séries</a>
        <a href="<?php $base_dir?>/views/films.php">Films</a>
        <a href="<?php $base_dir?>/views/profil.php">Profil</a>
    </div>
    <div id="nav-end">
        <?php if (!empty($_SESSION['utilisateur'])) {
            $user = $utilisateur->selectById($_SESSION['utilisateur']['id_utilisateur']);
            echo '<p>Connecté avec l\'identifiant<strong> '.$user[0]['email_utilisateur'].'</strong></p>';
                if ($user[0]['id_role'] == 1) {?>
                    <a href="<?php $base_dir?>/views/administration.php">Administration</a>'
                <?php }
            }?>
        <a href="<?php $base_dir?>/controllers/deconnexion.php">Se déconnecter</a>
    </div>
</nav>