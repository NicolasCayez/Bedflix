<?php
include_once('Utilisateur.php');
$utilisateur = new Utilisateur($db);
include_once('Film.php');
$film = new Film($db);
include_once('Serie.php');
$serie = new Serie($db);
include_once('Role.php');
$role = new Role($db);
include_once('Saison.php');
$saison = new Saison($db);
include_once('Categorie.php');
$categorie = new Categorie($db);