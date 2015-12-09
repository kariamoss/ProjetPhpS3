<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commande_m extends CI_Model
{

    public function getCommande()
    {
        $idUser = $this->session->userdata('id_user');
        $this->db->select('e.libelle,co.date_achat,co.id_commande,co.prix,co.id_etat');
        $this->db->join("etat e", "co.id_etat = e.id_etat");
        $this->db->from('commande co');
        $this->db->where("co.id_user =" . $idUser . "");
        $query = $this->db->get();
        return $query->result();
    }

    public function getPanierByIdCommande($id)
    {
        $this->db->select('pa.quantite,tp.libelle,pa.id_produit, p.nom ,pa.prix,pa.id_panier,pa.id_user, p.photo');
        $this->db->from('panier pa');
        $this->db->join('produit p', 'pa.id_produit=p.id');
        $this->db->join('typeProduit tp', 'p.id_type = tp.id_type');
        $this->db->where("pa.id_commande =".$id."");
        $this->db->order_by('p.nom', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCommande()
    {
        $this->db->select('e.libelle,co.date_achat,co.id_commande,co.prix,co.id_etat');
        $this->db->join("etat e", "co.id_etat = e.id_etat");
        $this->db->from('commande co');
        $query = $this->db->get();
        return $query->result();
    }

    public
    function isCommandeVide()
    {
        $idUser = $this->session->userdata('id_user');
        $this->db->select('id_commande')->from('commande')->where("id_user =" . $idUser . "");
        $result = $this->db->get();
        return $result->num_rows();

    }

    function deleteCommande($id){
        $this->db->delete("commande", array("id_commande" => $id));
    }

    function updateCommande($id_commande) {

        $this->db->where("id_commande", $id_commande);
        $this->db->set("id_etat",2);
        $this->db->update("commande");

    }
    public function getCommandeById($id)
    {
        $this->db->select('e.libelle,co.date_achat,co.id_commande,co.prix,co.id_etat');
        $this->db->join("etat e", "co.id_etat = e.id_etat");
        $this->db->from('commande co');
        $this->db->where('id_commande',$id);
        $query = $this->db->get();
        return $query->result();
    }

}
