<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produit_c extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url','text','string'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model(array('Produit_m','Users_m'));
    }

    public function check_droit(){
        if( $this->session->userdata('droit')!=2){
            redirect('Users_c');
        }
    }

    public function displayProduits(){
        $this->load->view('head_v');
        $this->load->view('clients/navClient_v');
        $data['produit']=$this->Produit_m->getAllProduits();
        $this->load->view('clients/table_produit_v',$data);
        $this->load->view('foot_v');
    }



    public function index()
    {
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v'); 
        $data['titre']="affichage du tableau produit";
        $data['produit']=$this->Produit_m->getAllProduits();
        $this->load->view('admin/produit/table_produit_v',$data);
        $this->load->view('foot_v');
        
    }
    public function creerProduit()  
    { 
        $this->check_droit();
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');  
        $donnees['typeProduit']=$this->Produit_m->getTypeProduitDropdown();
        $this->load->view('admin/produit/form_create_produit_v',$donnees); 
        $this->load->view('foot_v'); 
    }



    public function validFormCreerProduit()  
    {   
        $this->check_droit();
        // set_rules(nomDuChamp(name),nomHumain,rêglesDeValidation) 
        $this->form_validation->set_rules('nom','nom','trim|required|min_length[2]|max_length[12]|is_unique[produit.nom]');
        $this->form_validation->set_rules('prix', 'prix', 'trim|required|numeric'); 
        $this->form_validation->set_rules('id_type', 'type', 'required|callback_id_type_check');

        $this->form_validation->set_error_delimiters('<span class="error">','</span>');  
        

        $donnees= array( 
            'nom'=>$this->input->post('nom'), 
            'prix'=>$this->input->post('prix'),
            'id_type'=>$this->input->post('id_type'),
            'photo'=>$this->input->post('photo') 
        );
        
        if($this->form_validation->run() == False){
            $this->load->view('head_v');
            $this->load->view('admin/navAdmin_v');  
            $donnees['typeProduit']=$this->Produit_m->getTypeProduitDropdown();
            $this->load->view('admin/produit/form_create_produit_v',$donnees); 
            $this->load->view('foot_v');
        } 
        else 
        {        
            $this->Produit_m->insertProduit($donnees); 
            redirect('Produit_c/index'); 
        }
    }

    public function id_type_check($id_type)
    {
        $this->check_droit();
        $test_id_type=$this->Produit_m->verif_id_type($id_type);
        if ($test_id_type == 0)
        {
            $this->form_validation->set_message('id_type_check', 'Le %s n\'existe pas ');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function supprimerProduit($id)  
    { 
        $this->check_droit();
        if(is_numeric($id))
            $this->Produit_m->deleteProduit($id);
        redirect('/Produit_c/index');
    }


    public function modifierProduit($id)  
    { 
        $this->check_droit();
        //echo "modifier le prodruit avec l'id :".$id;
        $this->load->view('head_v');
        $this->load->view('admin/navAdmin_v');  
        $donnees=$this->Produit_m->getProduitById($id);
        $donnees['typeProduit']=$this->Produit_m->getTypeProduitDropdown();
        $this->load->view('admin/produit/form_update_produit_v',$donnees); 
        $this->load->view('foot_v'); 
    }


    public function validFormModifierProduit()  
    {   
        $this->check_droit();
        $id=$this->input->post('id'); 
        $donnees= array(    
                'nom'=>$this->input->post('nom'), 
                'prix'=>$this->input->post('prix'),
                'id_type'=>$this->input->post('id_type'),
                'photo'=>$this->input->post('photo') 
            ); 
        
        $this->form_validation->set_rules('id','id','trim|numeric');
        $this->form_validation->set_rules('nom','nom','trim|required|min_length[2]|max_length[12]');
        $this->form_validation->set_rules('prix', 'prix', 'trim|required|numeric'); 
        $this->form_validation->set_rules('id_type', 'type', 'required|callback_id_type_check');

        $this->form_validation->set_error_delimiters('<span class="error">','</span>');  
        

        $donnees= array( 
            'nom'=>$this->input->post('nom'), 
            'prix'=>$this->input->post('prix'),
            'id_type'=>$this->input->post('id_type'),
            'photo'=>$this->input->post('photo') 
        ); 

        if($this->form_validation->run() == False){
            $this->load->view('head_v');
            $this->load->view('admin/navAdmin_v'); 
            $donnees['id']=$id;
            $donnees['typeProduit']=$this->Produit_m->getTypeProduitDropdown();
            $this->load->view('admin/produit/form_update_produit_v',$donnees); 
            $this->load->view('foot_v');
        } 
        else 
        {        
            $this->Produit_m->updateProduit($id,$donnees);
            redirect('Produit_c/index');
        }
    }

}
