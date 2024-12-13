<?php

class Film
{
    private $insert;
    private $select;
    private $selectById;
    private $selectByTitre;
    private $selectByCatName;
    private $selectByUtilId;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO films(titre_film, description_film, affiche_film, lien_film, duree_film) 
                                        VALUES(:titre_film, :description_film, :affiche_film, :lien_film, :duree_film);");
        $this->select = $db->prepare("SELECT * 
                                        FROM films;");
        $this->selectById = $db->prepare("SELECT * 
                                            FROM films
                                            WHERE films.id_film = :id_film;");
        $this->selectByTitre = $db->prepare("SELECT * 
                                                FROM films
                                                WHERE films.titre_film = :titre_film;");
        $this->selectByCatName = $db->prepare("SELECT * 
                                                FROM films
                                                JOIN films_categories AS fc ON films.id_film = fc.id_film
                                                JOIN categories AS c ON c.id_categorie = fc.id_categorie
                                                WHERE c.libelle_categorie = :libelle_categorie;");
        $this->selectByUtilId = $db->prepare("SELECT * 
                                                FROM films
                                                JOIN utilisateurs_films AS uf ON films.id_film = uf.id_film
                                                WHERE uf.id_utilisateur = :id_utilisateur;");
    }

    public function insert($sTitre, $sDescription, $sAffiche, $sLien, $sDuree)
    {
        $r = true;
        $this->insert->execute(array(
            ":titre_film" => ucfirst(strtolower($sTitre)),
            ":description_film" => $sDescription,
            ":affiche_film" => $sAffiche,
            ":lien_film" => $sLien,
            ":duree_film" => $sDuree
        ));
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function select()
    {
        $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectSaisonId($sIdFilm)
    {
        $this->selectById->execute(array(":id_film" => $sIdFilm));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByTitre($sTitre)
    {
        $this->selectByTitre->execute(array(":titre_film" => $sTitre));
        if ($this->selectByTitre->errorCode() != 0) {
            print_r($this->selectByTitre->errorInfo());
        }
        return $this->selectByTitre->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByCatName($sLibelleCat)
    {
        $this->selectByCatName->execute(array(":libelle_categorie" => $sLibelleCat));
        if ($this->selectByCatName->errorCode() != 0) {
            print_r($this->selectByCatName->errorInfo());
        }
        return $this->selectByCatName->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByUtilId($sIdUtil)
    {
        $this->selectByUtilId->execute(array(":id_utilisateur" => $sIdUtil));
        if ($this->selectByUtilId->errorCode() != 0) {
            print_r($this->selectByUtilId->errorInfo());
        }
        return $this->selectByUtilId->fetchAll(PDO::FETCH_ASSOC);
    }
}
