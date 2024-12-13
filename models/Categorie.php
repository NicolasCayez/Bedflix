<?php

class Categorie
{
    private $insert;
    private $select;
    private $selectById;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO categories(libelle_categorie) 
                                        VALUES(:libelle_categorie);");
        $this->select = $db->prepare("SELECT * 
                                        FROM categories;");
        $this->selectById = $db->prepare("SELECT * 
                                            FROM categories
                                            WHERE categories.id_categorie = :id_categorie;");
    }

    public function insert($sLibelle)
    {
        $r = true;
        $this->insert->execute(array(
            ":libelle_categorie" => $sLibelle
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

    public function selectRoleId($sIdCategorie)
    {
        $this->selectById->execute(array(":id_categorie" => $sIdCategorie));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }
}
