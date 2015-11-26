<?php
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 12/11/2015
 * Time: 10:07
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Panier_m extends CI_Model
{

 public function getPanier()
 {
  $idUser = $this->session->userdata('id_user');
  $this->db->select('pa.quantite,tp.libelle,pa.id_produit, p.nom ,pa.prix,pa.id_panier,pa.id_user, p.photo');
  $this->db->from('panier pa');
  $this->db->join('produit p', 'pa.id_produit=p.id');
  $this->db->join('typeProduit tp', 'p.id_type = tp.id_type');
  $this->db->where("pa.id_user =".$idUser."");
  $this->db->order_by('p.nom');
  $query = $this->db->get();
  return $query->result();
 }

 public function getPanierById($id)
 {
  $idUser = $this->session->userdata('id_user');
  $this->db->select('pa.quantite,tp.libelle,pa.id_produit, p.nom ,pa.prix,pa.id_panier,pa.id_user, p.photo');
  $this->db->from('panier pa');
  $this->db->join('produit p', 'pa.id_produit=p.id');
  $this->db->join('typeProduit tp', 'p.id_type = tp.id_type');
  $this->db->where("pa.id_user =".$idUser."");
  $this->db->where("pa.id_produit =".$id."");
  $this->db->order_by('p.nom', 'DESC');
  $query = $this->db->get();
  return $query->result();
 }

 public function isPanierVide(){
  $idUser = $this->session->userdata('id_user');
  $this->db->select('id_produit')->from('panier')->where("id_user =".$idUser."");
  $result = $this->db->get();
  return $result->num_rows();
 }


 //Verifie que le produit existe deja� dans le panier
 //Si c'est le cas, renvoi un chiffre different de 0, sinon renvoie 0
 public function verif_id_ajout($id){
  $idUser = $this->session->userdata('id_user');
  $this->db->select('id_produit')->from('panier')->where("id_produit",$id)->where("id_user =".$idUser."");
  $result = $this->db->get();
  return $result->num_rows();
 }

 //A appeler uniquement pour un produit déjà existant dans son produit et dont on veux incrémenter la quantité
 public function updatePanier($idProduit){
  $idUser = $this->session->userdata('id_user');

  $sql = "UPDATE panier SET prix = prix + prix / quantite, quantite = quantite +1
  WHERE id_user = \"".$idUser."\" AND id_produit = \"".$idProduit."\";";
  $this->db->query($sql);
 }


 //A appeler uniquement pour un produit qui n'existe pas encore dans le panier
 public function insertPanier($idProduit){
  $id_user = $this->session->userdata('id_user');
  $id_commande = '0'; //TODO A redefinir apres
  $quantite = '1';
  $date =  date('Y-m-d');

  //Load le model pour l'utiliser par la suite et récupérer les infos que l'on veut grâce à ses propres méthodes
  $this->load->model("Produit_m");
  $row = $this->Produit_m->getProduit($idProduit);
  $prix = $row[0]->prix;

  $sql = "INSERT INTO panier (id_panier, id_user, id_produit ,quantite ,prix ,id_commande, dateAjoutPanier)
        values (NULL, $id_user, $idProduit, $quantite, $prix, $id_commande, $date );";
  $this->db->query($sql);

 }

 public function verif_id_retrait($idProduit){
  $row = $this->getPanierById($idProduit);
  $quantite = $row[0]->quantite;
  return $quantite;
 }

 public function desincrementePanier($idProduit){
  $idUser = $this->session->userdata('id_user');

  $sql = "UPDATE panier SET prix = prix - prix / quantite, quantite = quantite -1
  WHERE id_user = \"".$idUser."\" AND id_produit = \"".$idProduit."\";";
  $this->db->query($sql);
 }
 public function retraitPanier($idProduit){
  $idUser = $this->session->userdata('id_user');

  $sql = "DELETE from panier where id_user = $idUser and id_produit = $idProduit;";
  $this->db->query($sql);
  $this->db->delete('panier' ,array('id_produit'=>$idProduit));
 }


 public function insertCommande($idUser){
  $array = $this->getPanier();
  $prix = $this->coutTotalPanier();
  $date = date('Y-m-d');
  $sql = "insert into commande(id_commande,id_user,prix,date_achat,id_etat) VALUES
            (NULL,".$idUser.",".$prix.",".date('Y-m-d').",1);";
  $this->db->query($sql);
 }


 public function coutTotalPanier(){
  $idUser = $this->session->userdata('id_user');
  $this->db->select_sum('prix')->from('panier')->where("id_user =".$idUser."");
  $query = $this->db->get();
  $prixTotal['prix'] = $query->result();
  $prixTotal = intval($prixTotal['prix'][0]->prix);
  return $prixTotal;
 }

}
?>
