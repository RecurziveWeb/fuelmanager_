<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('FillingstationModel');
        
    }

   public function dashboard()
   {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        $iduser = $this->session->user_id;
        $data['fillingstations'] = $this->FillingstationModel->get_fillingstation_byuserid($iduser);
   
        $this->load->view('template/header');
        $this->load->view('pages/dashboard',$data);
        $this->load->view('template/footer');
   }
}
