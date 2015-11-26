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

    public function displayCommande(){

        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['commande']=$this->Commande_m->getCommande();
        $this->load->view('clients/table_commande_v',$data);
        $this->load->view('foot_v');
    }
}