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
  $this->db->select('*');
  $this->db->from('panier pa');
  $this->db->join('produit p', 'pa.id_produit=p.id');
  $this->db->join('typeProduit tp', 'p.id_type = tp.id_type');
  $this->db->where("pa.id_user =".$idUser."");
  $this->db->where("pa.id_commande", null);
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
  $this->db->select('id_produit')->from('panier pa')
      ->where("id_user =".$idUser."")->where("pa.id_commande", null);
  $result = $this->db->get();
  return $result->num_rows();
 }


 //Verifie que le produit existe deja� dans le panier
 //Si c'est le cas, renvoi un chiffre different de 0, sinon renvoie 0
 public function verif_id_ajout($id){
  $idUser = $this->session->userdata('id_user');
  $this->db->select('id_produit')->from('panier')->where("id_produit",$id)->where("id_user =".$idUser."")
      ->where("id_commande", null);
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
  $id_commande = null;
  $quantite = '1';
  $date =  date('Y-m-d');

  //Load le model pour l'utiliser par la suite et récupérer les infos que l'on veut grâce à ses propres méthodes
  $this->load->model("Produit_m");
  $row = $this->Produit_m->getProduit($idProduit);
  $prix = $row[0]->prix;

  $this->db->set('id_user',$id_user);
  $this->db->set('id_produit',$idProduit);
  $this->db->set('quantite',$quantite);
  $this->db->set('prix',$prix);
  $this->db->set('id_commande',$id_commande);
  $this->db->set('dateAjoutPanier',date('Y-m-d'));
  $this->db->insert('panier');

  /*$sql = "INSERT INTO panier (id_panier, id_user, id_produit ,quantite ,prix ,id_commande, dateAjoutPanier)
        values (NULL, $id_user, $idProduit, $quantite, $prix, $id_commande, ".date('Y-m-d')." );";
  $this->db->query($sql);*/

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

  $this->db->set('id_user',$idUser);
  $this->db->set('prix',$prix);
  $this->db->set('date_achat',date('Y-m-d'));
  $this->db->set('id_etat',1);
  $this->db->insert('commande');
 }


 public function coutTotalPanier(){
  $idUser = $this->session->userdata('id_user');
  $this->db->select_sum('prix')->from('panier')->where("id_user =".$idUser."");
  $query = $this->db->get();
  $prixTotal['prix'] = $query->result();
  $prixTotal = intval($prixTotal['prix'][0]->prix);
  return $prixTotal;
 }

 public function updateIdCommande(){
  $idUser = $this->session->userdata('id_user');
  $this->db->select_max('id_commande')->from('commande')->where("id_user =".$idUser."");
  $query = $this->db->get();
  $idCommande['id_commande'] = $query->result();
  $idCommande = intval($idCommande['id_commande'][0]->id_commande);

  $data = array(
   'id_commande' => $idCommande
  );
  $this->db->where('id_user', $idUser);
  $this->db->where('id_commande', null);
  $this->db->update('panier',$data);
 }

 public function updateStock(){
  $produit = $this->Panier_m->getPanier();

  foreach ($produit as $value):

   $stock = $this->Panier_m->getStock($value->id);
   $quantite = $this->Panier_m->getQuantite($value->id);
   $stock = $stock-$quantite;
   if($stock < 0){
    redirect('Panier_c/displayPanier');
    echo("Erreur : Le produit n'est plus disponible");
   }

   $data = array(
       'stock' => $stock
   );
   $this->db->where('id', $value->id);
   $this->db->update('produit',$data);
  endforeach;

 }

public function supprimerPanier()
{
 $idUser = $this->session->userdata('id_user');
 $sql = "DELETE from panier where id_user = $idUser";
 $this->db->query($sql);
}
 public function getQuantite($idProduit)
 {
  $idUser = $this->session->userdata('id_user');
  $this->db->select('panier.quantite');
  $this->db->from('panier');
  $this->db->where("id_user", $idUser);
  $this->db->where("id_commande", null);
  $this->db->where('id_produit', $idProduit);
  $query = $this->db->get();
  $quantite['quantite']= $query->result();
  if (empty($quantite['quantite'])){
   return 0;
  }
  else
  {
   $quantite = intval($quantite['quantite'][0]->quantite);
   return $quantite;
  }
 }

 public function getStock($idProduit){
  $this->db->select('stock');
  $this->db->from('produit');
  $this->db->where("id", $idProduit);
  $query = $this->db->get();
  $stock['stock']= $query->result();
  if (empty($stock['stock'])){
   return 0;
  }
  else
  {
   $stock = intval($stock['stock'][0]->stock);
   return $stock;
  }
 }

}
?>
