<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_c extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url','text','string'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model(array('Users_m','Panier_m'));
    }
    public function index()
    {
        if($this->session->userdata('droit')!=1){
            redirect('users_c');
        }
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');      
        $this->load->view('clients/client_index');
        $this->load->view('foot_v');
    }

    public function creerClient()
    {
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');
        $donnees['typeProduit']=$this->Users_m->getTypeProduitDropdown();
        $this->load->view('admin/produit/form_create_produit_v',$donnees);
        $this->load->view('foot_v');
    }

    public function displayClients(){
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');
        $data['clients']=$this->Users_m->getClients();
        $this->load->view('clients/table_clients_v',$data);
        $this->load->view('foot_v');
    }


}