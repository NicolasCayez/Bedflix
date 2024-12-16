<?php

class Role
{
    private $insert;
    private $select;
    private $selectById;

    public function __construct($db)
    {
        $this->insert = $db->prepare('INSERT INTO roles(libelle_role) 
                                        VALUES(:libelle_role);');
        $this->select = $db->prepare('SELECT * 
                                        FROM roles;');
        $this->selectById = $db->prepare('SELECT * 
                                            FROM roles
                                            WHERE roles.id_role = :id_role;');
    }

    public function insert($sLibelle)
    {
        $r = true;
        $this->insert->execute(array(
            ':libelle_role' => $sLibelle
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

    public function selectById($sIdRole)
    {
        $this->selectById->execute(array(':id_role' => $sIdRole));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }
}
