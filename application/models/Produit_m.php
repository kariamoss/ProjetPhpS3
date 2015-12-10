<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Produit_m extends CI_Model {

    public function getAllProduits()
    {
        /*$sql="SELECT p.id, t.libelle, p.nom, p.prix, p.photo
            FROM produit as p,typeProduit as t
            WHERE p.id_type=t.id_type ORDER BY t.libelle;";*/
// ou
         /* $sql="SELECT p.id, t.libelle, p.nom, p.prix, p.photo
                FROM produit as p
                JOIN typeProduit as t
                ON p.id_type=t.id_type ORDER BY t.libelle, p.nom DESC;";
            $query=$this->db->query($sql);
            return $query->result(); */

        $this->db->select('p.id, t.libelle, p.nom, p.stock, p.prix, p.photo');
        $this->db->from('produit p');
        $this->db->join('typeProduit t', 'p.id_type=t.id_type');

        $this->db->order_by('p.nom');
        $query = $this->db->get();
        return $query->result();

    }

    public function getProduit($idProduit)
    {
        $this->db->select('p.id, t.libelle, p.nom, p.prix, p.photo');
        $this->db->from('produit p');
        $this->db->join('typeProduit t', 'p.id_type=t.id_type');
        $this->db->where('p.id',$idProduit);
        $query = $this->db->get();
        return $query->result();
    }


    function insertProduit($donnees){
        $sql="INSERT INTO produit (nom,prix,id_type,photo)
        values ('".$donnees['nom']."','".$donnees['prix']."',
            ".$donnees['id_type'].",'".$donnees['photo']."'); ";
        $this->db->query($sql);
        return $this->db->insert("produit",$donnees);
    }

    function deleteProduit($id){
        $sql = "DELETE FROM produit
            WHERE id = $id ;";
        $this->db->query($sql);
        $this->db->delete("produit", array("id" => $id));
    }

    function getProduitById($id){   /*$sql = "SELECT * FROM produit WHERE id=".$id.";";
        $query = $this->db->query($sql);
        return  $query->result()[0]; // ou $query->row_array();

        $sql = "SELECT * FROM produit WHERE id = $id;";
        $query = $this->db->query($sql);
        $data=$query->row_array();
        return $data;*/

        return $this->db->get_where('produit', array('id' => $id),1,0)->row_array();
    }

    function updateProduit($id, $produit) {
      //  $this->db->where("id", $id);
        //$this->db->update("produit", $donnees);
        $data = array(
            'id_type' => $produit['id_type'],
            'nom' => $produit['nom'],
            'prix' => $produit['prix'],
            'photo' => $produit['photo'],
            'dispo' => 1
        );

        $this->db->where("id", $id);
        $this->db->update("produit", $data);
         /* $sql = "UPDATE produit
            SET nom = \"'".$produit["nom"]."\',prix =\"".$produit["prix"]."\" ,id_type= \"".$produit["id_type"]."\"
            , photo = \"".$produit["photo"]."\" WHERE id = $id ;";
            $this->db->query($sql);*/
    }

    function verif_id_type($id_type){
        $this->db->select('id_type')->from('typeProduit')->where("id_type",$id_type);
        $result = $this->db->get();
        return $result->num_rows();
    }

    function getTypeProduitDropdown(){
        $result = $this->db->from("typeProduit")->order_by('id_type')->get(); 
        $retour = array(); 
        if($result->num_rows() > 0){ 
            $retour[''] = 'selectionner un type'; 
            foreach($result->result_array() as $row){ 
                $retour[$row['id_type']] = $row['libelle']; 
            } 
        } 
        return $retour;
    }
}
