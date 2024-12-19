-- *********************************************
-- **** ON UTILISE LA BDD
-- *********************************************
USE bedflix;



-- *********************************************
-- **** CATEGORIES
-- *********************************************
-- TABLE CATEGORIES
INSERT INTO CATEGORIES(libelle_categorie)
	VALUES ('Action'),('Anime'),('Comédies'),('Courts-métrages'),('Documentaires'),
			('Drames'),('Européen'),('Fantastique'),('Français'),('Horreur'),
			('Indépendants'),('International'),('Jeunesse et famille'),
			('Musique et comédies musicales'),('Noël'),('Policier'),('Primés'),
			('Romance'),('SF'),('Thriller');

-- *********************************************
-- **** FILMS
-- *********************************************
-- TABLE FILMS
INSERT INTO FILMS(titre_film, description_film, affiche_film, lien_film, duree_film)
	VALUES ('Film 01', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 02', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 03', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 04', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 05', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 06', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 07', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 08', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 09', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 10', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 11', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 12', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 13', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 14', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 15', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 16', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 17', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 18', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 19', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 20', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 21', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 22', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 23', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 24', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 25', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 26', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 27', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 28', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 29', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105),
			('Film 30', 'Desc film 01', 'UrlAffiche', 'UrlFilm', 105);
-- TABLE ASSO FILMS CATEGORIES
INSERT INTO FILMS_CATEGORIES(id_film, id_categorie)
	VALUES (1, 1),(1, 2),(1, 13), -- Film 1 Cat 1 2 13
			(2, 4),(2, 5), -- Film 2 Cat 4 5
			(3, 7),(3, 9),(3, 12), -- Film 3 Cat 7 9 12
			(4, 4),(4, 5),(4, 7), -- Film 4 Cat 4 5 7
			(5, 4),(5, 8),(5, 9), -- Film 5 Cat 4 8 9 
			(6, 1),(6, 3), -- Film 6 Cat 1 3
			(7, 2),(7, 5), -- Film 7 Cat 2 5
			(8, 3),(8, 5),(8, 9), -- Film 8 Cat 3 5 9
			(9, 4),(9, 6),(9, 10), -- Film 9 Cat 4 6 10
			(10, 8),(10, 9),(10, 20), -- Film 10 Cat 8 9 20
			(11, 11),(11, 15),(11, 17), -- Film 11 Cat 11 15 17
			(12, 12),(12, 16),(12, 18), -- Film 12 Cat 12 16 18
			(13, 17),(13, 19), -- Film 13 Cat 17 19
			(14, 18),(14, 20), -- Film 14 Cat 18 20
			(15, 3),(15, 16), -- Film 15 Cat 3 16
			(16, 7),(16, 9),(16, 18), -- Film 16 Cat 7 9 18
			(17, 8),(17, 12),(17, 13), -- Film 17 Cat 8 12 13
			(18, 17),(18, 19),(18, 20), -- Film 18 Cat 17 19 20
			(19, 13),(19, 15),(19, 17), -- Film 19 Cat 13 15 17
			(20, 1),(20, 15),(20, 16), -- Film 20 Cat 1 15 16
			(21, 13),(21, 14),(21, 15), -- Film 21 Cat 13 14 15
			(22, 1),(22, 6),(22, 8), -- Film 22 Cat 1 6 8
			(23, 3),(23, 9),(23, 17), -- Film 23 Cat 3 9 17
			(24, 7),(24, 11),(24, 16), -- Film 24 Cat 7 11 16
			(25, 4),(25, 8),(25, 11), -- Film 25 Cat 4 8 11
			(26, 9),(26, 15),(26, 17), -- Film 26 Cat 9 15 17
			(27, 14),(27, 18),(27, 20), -- Film 27 Cat 14 18 20
			(28, 9),(28, 11),(28, 17), -- Film 28 Cat 9 11 17
			(29, 3),(29, 6),(29, 9), -- Film 29 Cat 3 6 9
			(30, 4),(30, 8),(30, 16); -- Film 30 Cat 4 8 16

-- *********************************************
-- **** SERIES
-- *********************************************
-- TABLE SERIES
INSERT INTO SERIES(titre_serie, description_serie, affiche_serie, lien_serie)
	VALUES ('Serie 01', 'Desc Serie 01', 'UrlAffiche', 'UrlFilm'),
			('Serie 02', 'Desc Serie 01', 'UrlAffiche', 'UrlFilm'),
			('Serie 03', 'Desc Serie 01', 'UrlAffiche', 'UrlFilm'),
			('Serie 04', 'Desc Serie 01', 'UrlAffiche', 'UrlFilm'),
			('Serie 05', 'Desc Serie 01', 'UrlAffiche', 'UrlFilm');
-- TABLE ASSO SERIES CATEGORIES
INSERT INTO SERIES_CATEGORIES(id_serie, id_categorie)
	VALUES (1, 1),(1, 2),(1, 13), -- Serie 1 Cat 1 2 13
			(2, 3),(2, 8), -- Serie 2 Cat 3 8
			(3, 5),(3, 7),(3, 10), -- Serie 3 Cat 5 7 10
			(4, 6),(4, 8),(4, 11), -- Serie 4 Cat 6 8 11
			(5, 7),(5, 9),(5, 14); -- Serie 5 Cat 7 9 14
-- TABLE SAISONS
INSERT INTO SAISONS(id_serie, numero_saison, titre_saison)
	VALUES (1, 1, "Série 1 Saison 1"),(1, 2, "Série 1 Saison 2"), -- S1s1 ¨1ère saison / S1s2 ¨2ème saison
			(2, 1, "Série 2 Saison 1"), -- S2s1 ¨1ère saison
			(3, 1, "Série 3 Saison 1"),(3, 2, "Série 3 Saison 2"),(3, 2, "Série 3 Saison 3"), -- S3s1 ¨1ère saison / S3s2 ¨2ème saison / S3s3 ¨2ème saison
			(4, 1, "Série 4 Saison 1"),(4, 2, "Série 4 Saison 2"), -- S4s1 ¨1ère saison / S4s2 ¨2ème saison
			(5, 1, "Série 5 Saison 1"),(5, 2, "Série 5 Saison 2"); -- S5s1 ¨1ère saison / S5s2 ¨2ème saison
-- TABLE EPISODES
INSERT INTO EPISODES(id_saison, numero_episode, titre_episode, duree_episode)
	VALUES (1, 1, 'E1', 35), -- S1s1 E1
			(1, 2, 'E2', 35), -- S1s1 E2
			(1, 3, 'E3', 37), -- S1s1 E3
			(1, 4, 'E4', 25), -- S1s1 E4
			(2, 1, 'E1', 30), -- S1s2 E1
			(2, 2, 'E2', 25), -- S1s2 E2
			(2, 3, 'E3', 30), -- S1s2 E3
			(2, 4, 'E4', 35), -- S1s2 E4
			(2, 5, 'E5', 32), -- S1s2 E5
			(2, 6, 'E6', 36), -- S1s2 E6

			(3, 1, 'E1', 20), -- S2s1 E1
			(3, 2, 'E2', 22), -- S2s1 E2
			(3, 3, 'E3', 23), -- S2s1 E3
			(4, 1, 'E1', 24), -- S2s2 E1
			(4, 2, 'E2', 22), -- S2s2 E2
			(4, 3, 'E3', 21), -- S2s2 E3

			(5, 1, 'E1', 27), -- S3s1 E1
			(5, 2, 'E2', 30), -- S3s1 E2
			(5, 3, 'E3', 35), -- S3s1 E3
			(5, 4, 'E4', 33), -- S3s1 E4
			(6, 1, 'E1', 40), -- S3s2 E1
			(6, 2, 'E2', 39), -- S3s2 E2
			(6, 3, 'E3', 36), -- S3s2 E3
			(6, 4, 'E4', 30), -- S3s2 E4

			(7, 1, 'E1', 26), -- S4s1 E1
			(7, 2, 'E2', 29), -- S4s1 E2
			(7, 3, 'E3', 32), -- S4s1 E3
			(7, 4, 'E4', 25), -- S4s1 E4
			(8, 1, 'E1', 27), -- S4s2 E1

			(9, 1, 'E1', 50), -- S5s1 E1
			(9, 2, 'E2', 45), -- S5s1 E2
			(9, 3, 'E3', 60); -- S5s1 E3

-- *********************************************
-- **** ABONNEMENT DES UTILISATEURS A DES FILS OU SERIES
-- *********************************************
-- TABLE ASSO UTILISATEURS FILMS
-- INSERT INTO UTILISATEURS_FILMS(id_utilisateur, id_film)
-- VALUES ();
-- TABLE ASSO UTILISATEURS SERIES
-- INSERT INTO UTILISATEURS_SERIES(id_utilisateur, id_serie)
-- VALUES ();