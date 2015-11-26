<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model {
    public function add_user($donnees)
    {
        $sql = "INSERT user (id_user,login,email,password,droit,valide) VALUES (\"".NULL."\",
        \"".$donnees['login']."\",
        \"".$donnees['email']."\",
        \"".$donnees['pass']."\",1,1) ;";
        $this->db->query($sql);
    }

    public function verif_connexion($donnees)
    {
        $sql = "SELECT  id_user,droit,login,email,valide from user WHERE login=\"".$donnees['login']."\"
        and password=\"".$donnees['pass']."\";";
        $query=$this->db->query($sql);  //id_droit as
        if($query->num_rows()==1)
        {
            $row=$query->result_array();
            $donnees_resultat=$row[0];
            return $donnees_resultat;
        }
        else
            return false;
    }


    public function test_email($email)
    {
        $sql = "SELECT email  from user WHERE email=\"".$email."\";";
        $query=$this->db->query($sql);
        if($query->num_rows()>=1)
            return true;
        else
            return false;
    }

     public function modif_email_mdp($email,$donnees)
    {
        $this->db->where("email", $email);
        $this->db->update("user", $donnees);
    }
}