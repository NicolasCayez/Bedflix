<?php

class Serie
{
    private $insert;
    private $select;
    private $selectById;
    private $selectByTitre;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO series(titre_serie, description_serie, affiche_serie, lien_serie) 
                                        VALUES(:titre_serie, :description_serie, :affiche_serie, :lien_serie);");
        $this->select = $db->prepare("SELECT * 
                                        FROM series;");
        $this->selectById = $db->prepare("SELECT * 
                                            FROM series
                                            WHERE series.id_serie = :id_serie;");
        $this->selectByTitre = $db->prepare("SELECT * 
                                                FROM series
                                                WHERE series.titre_serie = :titre_serie;");
    }

    public function insert($sTitre, $sDescription, $sAffiche, $sLien)
    {
        $r = true;
        $this->insert->execute(array(
            ":titre_serie" => ucfirst(strtolower($sTitre)),
            ":description_serie" => $sDescription,
            ":affiche_serie" => $sAffiche,
            ":lien_serie" => $sLien
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

    public function selectSaisonId($sIdserie)
    {
        $this->selectById->execute(array(":id_serie" => $sIdserie));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectSaisonTitre($sTitre)
    {
        $this->selectByTitre->execute(array(":titre_serie" => $sTitre));
        if ($this->selectByTitre->errorCode() != 0) {
            print_r($this->selectByTitre->errorInfo());
        }
        return $this->selectByTitre->fetchAll(PDO::FETCH_ASSOC);
    }
}
