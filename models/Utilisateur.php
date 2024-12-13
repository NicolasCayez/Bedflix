<?php

class Utilisateur
{
    private $insert;
    private $select;
    private $selectById;
    private $selectByEmail;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO utilisateurs(nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, email_utilisateur, mot_de_passe_utilisateur) 
                                        VALUES(:nom_utilisateur, :prenom_utilisateur, :pseudo_utilisateur, :email_utilisateur, :mot_de_passe_utilisateur);");
        $this->select = $db->prepare("SELECT * 
                                        FROM utilisateurs
                                        JOIN roles ON (roles.id_role = utilisateurs.id_role);");
        $this->selectById = $db->prepare("SELECT * 
                                            FROM utilisateurs
                                            WHERE utilisateurs.id_utilisateur = :id_utilisateur;");
        $this->selectByEmail = $db->prepare("SELECT * 
                                                FROM utilisateurs
                                                WHERE utilisateurs.email_utilisateur = :email_utilisateur;");
    }

    public function insert($sNom, $sPrenom, $sPseudo, $sEmail, $sMdp)
    {
        $r = true;
        $this->insert->execute(array(
            ":nom_utilisateur" => strtoupper($sNom),
            ":prenom_utilisateur" => ucfirst(strtolower($sPrenom)),
            ":pseudo_utilisateur" => ucfirst(strtolower($sPseudo)),
            ":email_utilisateur" => $sEmail,
            ":mot_de_passe_utilisateur" => $sMdp
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

    public function selectById($sIdUtilisateur)
    {
        $this->selectById->execute(array(":id_utilisateur" => $sIdUtilisateur));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function selectByEmail($sEmailUtilisateur)
    {
        $this->selectByEmail->execute(array(":email_utilisateur" => $sEmailUtilisateur));
        if ($this->selectByEmail->errorCode() != 0) {
            print_r($this->selectByEmail->errorInfo());
        }
        return $this->selectByEmail->fetchAll(PDO::FETCH_ASSOC);
    }
}
