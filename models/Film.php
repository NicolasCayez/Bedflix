<?php

class Film
{
    private $insert;
    private $select;
    private $selectById;
    private $selectByTitre;

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

    public function selectSaisonTitre($sTitre)
    {
        $this->selectByTitre->execute(array(":titre_film" => $sTitre));
        if ($this->selectByTitre->errorCode() != 0) {
            print_r($this->selectByTitre->errorInfo());
        }
        return $this->selectByTitre->fetchAll(PDO::FETCH_ASSOC);
    }
}
