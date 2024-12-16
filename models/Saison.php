<?php

class Saison
{
    private $insert;
    private $select;
    private $selectById;
    private $selectByTitre;
    private $selectByIdSerie;

    public function __construct($db)
    {
        $this->insert = $db->prepare('INSERT INTO saisons(titre_saison, numero_saison, id_serie) 
                                        VALUES(:titre_saison, :numero_saison, :id_serie);');
        $this->select = $db->prepare('SELECT * 
                                        FROM saisons;');
        $this->selectById = $db->prepare('SELECT * 
                                            FROM saisons
                                            WHERE saisons.id_saison = :id_saison;');
        $this->selectByTitre = $db->prepare('SELECT * 
                                                FROM saisons
                                                WHERE saisons.titre_saison = :titre_saison;');
        $this->selectByIdSerie = $db->prepare('SELECT * 
                                                FROM saisons
                                                WHERE saisons.id_serie = :id_serie;');
    }

    public function insert($sTitre, $sNumero, $sIdSerie)
    {
        $r = true;
        $this->insert->execute(array(
            ':titre_saison' => ucfirst(strtolower($sTitre)),
            ':numero_saison' => $sNumero,
            ':id_serie' => $sIdSerie
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

    public function selectById($sIdSaison)
    {
        $this->selectById->execute(array(':id_saison' => $sIdSaison));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByTitre($sTitre)
    {
        $this->selectByTitre->execute(array(':titre_saison' => $sTitre));
        if ($this->selectByTitre->errorCode() != 0) {
            print_r($this->selectByTitre->errorInfo());
        }
        return $this->selectByTitre->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByIdSerie($sIdSerie)
    {
        $this->selectByIdSerie->execute(array(':id_serie' => $sIdSerie));
        if ($this->selectByIdSerie->errorCode() != 0) {
            print_r($this->selectByIdSerie->errorInfo());
        }
        return $this->selectByIdSerie->fetchAll(PDO::FETCH_ASSOC);
    }
}
