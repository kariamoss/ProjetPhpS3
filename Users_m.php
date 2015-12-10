<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model {
    public function add_user($donnees)
    {
        $sql = "INSERT user (login,email,password,droit,valide) VALUES (\"".$donnees['login']."\",\"".$donnees['email']."\",
        \"".$donnees['pass']."\",1,1) ;";
        $this->db->query($sql);
    }

    public function verif_connexion($donnees)
    {
        $sql = "SELECT  droit,login,email,valide from user WHERE login=\"".$donnees['login']."\"
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

    public function getIdUser(){
        $this->db->select("id_user");
        $this->db->from("user");
        $this->db->where("email",$this->session->userdata('email'));
        $query = $this->db->get();
        return $query->result_array();


    }


    public function getAllUsers(){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where('droit',1);

        $query = $this->db->get();
        return $query->result();
    }


    public function getClientCoordonnes(){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("email",$this->session->userdata('email'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateCoordonnes( $donnees) {
        $this->db->where("id_user", $donnees['id_user']);
        //echo var_dump($id);
        $this->db->set("nom",$donnees['nom']);
        $this->db->set("login",$donnees['login']);
        $this->db->set("password",$donnees['password']);
        $this->db->set("email",$donnees['email']);
        $this->db->set("adresse",$donnees['adresse']);
        $this->db->set("ville",$donnees['ville']);
        $this->db->set("code_postal",$donnees['code_postal']);

        return $this->db->update("user");
    }


}