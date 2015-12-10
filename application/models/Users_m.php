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

    function insertClient($donnees){ // A VOIR SI ON LE FAIT
        $sql="INSERT INTO users (nom,prix,id_type,photo)
        values ('".$donnees['nom']."','".$donnees['prix']."',
            ".$donnees['id_type'].",'".$donnees['photo']."'); ";
        $this->db->query($sql);
        return $this->db->insert("produit",$donnees);
    }

    public function getClients()
    {
        $this->db->select('u.id_user,u.email,u.password,u.login,u.nom,u.code_postal,u.ville,u.adresse,u.valide');
        $this->db->from('user u');
       // $this->db->join('typeProduit t', 'p.id_type=t.id_type');

        $this->db->order_by('u.id_user');
        $query = $this->db->get();
        return $query->result();

    }

    public function getClientCoordonnes(){
        $idUser = $this->session->userdata('id_user');
        return $this->db->get_where('user', array('id_user' => $idUser),1,0)->row_array();
    }

    public function updateCoordonnes($donnees) {
        $idUser = $this->session->userdata('id_user');
        $data = array(
            'id_user' => $idUser,
            'email' => $donnees['email'],
            'password' => $donnees['password'],
            'login' => $donnees['login'],
            'nom' => $donnees['nom'],
            'code_postal' => $donnees['code_postal'],
            'ville' => $donnees['ville'],
            'adresse' => $donnees['adresse']
        );

        $this->db->where("id_user", $idUser);
        $this->db->update("user", $data);
    }
}