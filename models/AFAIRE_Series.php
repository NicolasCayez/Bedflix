<?php

class Utilisateur
{
    private $insert;
    private $select;
    private $selectUtilId;
    private $selectUtilEmail;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO utilisateurs(nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, email_utilisateur, mot_de_passe_utilisateur) 
                                        VALUES(:nom_utilisateur, :prenom_utilisateur, :pseudo_utilisateur, :email_utilisateur, :mot_de_passe_utilisateur);");
        $this->select = $db->prepare("SELECT * 
                                        FROM utilisateurs
                                        JOIN roles ON (roles.id_role = utilisateurs.id_role);");
        $this->selectUtilId = $db->prepare("SELECT * 
                                            FROM utilisateurs
                                            WHERE utilisateurs.id_utilisateur = :id_utilisateur;");
        $this->selectUtilEmail = $db->prepare("SELECT * 
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

    public function selectUtilId($sIdUtilisateur)
    {
        $this->selectUtilId->execute(array(":id_utilisateur" => $sIdUtilisateur));
        if ($this->selectUtilId->errorCode() != 0) {
            print_r($this->selectUtilId->errorInfo());
        }
        return $this->selectUtilId->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function selectUtilEmail($sEmailUtilisateur)
    {
        $this->selectUtilEmail->execute(array(":email_utilisateur" => $sEmailUtilisateur));
        if ($this->selectUtilEmail->errorCode() != 0) {
            print_r($this->selectUtilEmail->errorInfo());
        }
        return $this->selectUtilEmail->fetchAll(PDO::FETCH_ASSOC);
    }
}
