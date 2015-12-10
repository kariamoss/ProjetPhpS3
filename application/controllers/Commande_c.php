<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 26/11/2015
 * Time: 11:38
 */
class Commande_c extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'text', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model(array('Commande_m', 'Users_m'));
    }

    public function index()
    {
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['titre']="Commande";
        $data['produit']=$this->Commande_m->displayCommande();
        $this->load->view('clients/table_commande_v',$data);
        $this->load->view('foot_v');

    }

    public function check_droit(){
        if( $this->session->userdata('droit')!=1){
            redirect('Users_c');
        }
    }

    public function check_droit_admin(){
        if( $this->session->userdata('droit')!=2){
            redirect('Users_c');
        }
    }

    public function displayCommande(){
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $commandeVide = $this->Commande_m->isCommandeVide();
        if($commandeVide == 0){
            $this->load->view('clients/table_commande_vide_v');
            $this->load->view('foot_v');
        }
        else{
            $data['commande'] = $this->Commande_m->getCommande();
            $this->load->view('clients/table_commande_v', $data);
            $this->load->view('foot_v');
        }
    }
    public function detailCommande($id){
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['panier'] = $this->Commande_m->getPanierByIdCommande($id);
        $this->load->view('clients/table_commande_detail_v', $data);
        $this->load->view('foot_v');
    }

    public function detailCommandeAdmin($id){
        $this->check_droit_admin();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['panier'] = $this->Commande_m->getPanierByIdCommande($id);
        $this->load->view('admin/table_commande_detail_v', $data);
        $this->load->view('foot_v');
    }

    public function displayCommandeAdmin(){
        $this->check_droit_admin();
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');
        $data['commande']=$this->Commande_m->getAllCommande();
        $this->load->view('admin/table_commande_v',$data);
        $this->load->view('foot_v');
    }

    public function administrationCommande(){

        $this->check_droit_admin();
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');
        $data['commande']=$this->Commande_m->getAllCommande();
        $this->load->view('admin/table_commande_v',$data);
        $this->load->view('foot_v');
    }

    public function supprimerCommande($id)
    {
        $this->check_droit_admin();
        if(is_numeric($id))
            $this->Commande_m->deleteCommande($id);
        redirect('/Commande_c/administrationCommande');
    }

    public function validerCommande($id)
    {
        $this->check_droit_admin();
        $data['commande']=$this->Commande_m->getCommandeById($id);
        $donnees['etat']=$this->Commande_m->updateCommande($id);
        redirect($this->administrationCommande());
    }



}