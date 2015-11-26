<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_c extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url','text','string'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model(array('users_m','Panier_m'));
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


}