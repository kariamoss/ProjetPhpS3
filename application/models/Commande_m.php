<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commande_m extends CI_Model
{
    public function getCommande()
    {
        $idUser = $this->session->userdata('id_user');
        $this->db->select('e.libelle,co.date_achat,co.id_commande,co.prix,co.id_etat');
        $this->db->join("etat e","co.id_etat = e.id_etat");
        $this->db->from('commande co');
        $this->db->where("co.id_user =".$idUser."");
        $query = $this->db->get();
        return $query->result();
    }
}