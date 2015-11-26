<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 12/11/2015
 * Time: 10:07
 */
class Panier_c extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url', 'text', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model(array('Panier_m', 'Users_m'));
    }
    public function check_droit(){
        if( $this->session->userdata('droit')!=1){
            redirect('Users_c');
        }
    }

    public function index()
    {
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['titre']="affichage du panier";
        $data['panier']=$this->Panier_m->getPanier();
        $this->load->view('clients/table_panier_v');
        $this->load->view('foot_v');

    }


    public function displayPanier()
    {
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['panier'] = $this->Panier_m->getPanier();
        $this->load->view('clients/table_panier_v', $data);
        $this->load->view('foot_v');

    }

    //TODO Décrémenter le panier et vérifier si il reste du stock
    public function ajouterAuPanier($id)
    {
        $this->check_droit();
        $test_id_type=$this->Panier_m->verif_id_ajout($id);

        if ($test_id_type == 0) {
            $this->Panier_m->insertPanier($id);
        }
        else{
            $this->Panier_m->updatePanier($id);
        }

        redirect('Panier_c/displayPanier');
    }
    public function supprimerDuPanier($id)
    {
        $this->check_droit();
        $test_id_type=$this->Panier_m->verif_id_retrait($id);
        if ($test_id_type == 1) {
            $this->Panier_m->retraitPanier($id);
        }
        else{
            $this->Panier_m->desincrementePanier($id);
        }
        redirect('/Panier_c/displayPanier');
    }
}
?>