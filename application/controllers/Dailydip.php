<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailydip extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('DailydipModel'); 
        $this->load->model('FillingstationModel');

        $this->load->library('form_validation'); 
    }

    public function index() {

        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['dailydip'] = $this->DailydipModel->get_dailydip();
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();

        $this->load->view('template/header');
        $this->load->view('admin/dailydip_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/dailydip_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($iddailydip)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['dailydip'] = $this->DailydipModel->getwhere_dailydip($iddailydip);
        $data['primaryid'] = $iddailydip;

        $this->load->view('template/header');
        $this->load->view('/admin/dailydip_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function markdip($iduser)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['fillingstations'] = $this->FillingstationModel->get_fillingstation_byuserid($iduser);
   
        $this->load->view('template/header');
        $this->load->view('pages/markdip',$data);
        $this->load->view('template/footer');
    }

    public function markdipsave()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('petrol', 'petrol', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('diesel', 'diesel', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('superdiesel', 'superdiesel', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('superpetrol', 'superpetrol', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('fillingstation_idfillingstation', 'fillingstation_idfillingstation', 'required|min_length[0]|max_length[11]');
           

            if ($this->form_validation->run()) {
                
                $data = array(
                    'checkdate' => date("Y-m-d"),
                    'petrol' => $this->input->post('petrol'),
                    'diesel' => $this->input->post('diesel'),
                    'superdiesel' => $this->input->post('superdiesel'),
                    'superpetrol' => $this->input->post('superpetrol'),
                    'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
                    'isdelete' => 0,

                );

                $resultid = $this->DailydipModel->insert_dailydip($data);
                if($resultid>0){
                    $this->session->set_flashdata('message', 'Form submitted successfully!');
                }else{
                    $this->session->set_flashdata('error', 'Error in submitting form');
                }
                
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }else{
            $this->session->set_flashdata('error', "Bad Request");
        }
         
        redirect("dashboard");
    }

    public function create() {

        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('checkdate', 'checkdate', '|valid_date|min_length[0]');
            $this->form_validation->set_rules('petrol', 'petrol', '|numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('diesel', 'diesel', '|numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('superdiesel', 'superdiesel', '|numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('superpetrol', 'superpetrol', '|numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('fillingstation_idfillingstation', 'fillingstation_idfillingstation', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'checkdate' => $this->input->post('checkdate'),
                    'petrol' => $this->input->post('petrol'),
                    'diesel' => $this->input->post('diesel'),
                    'superdiesel' => $this->input->post('superdiesel'),
                    'superpetrol' => $this->input->post('superpetrol'),
                    'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
                    'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->DailydipModel->insert_dailydip($data);
                if($resultid>0){
                    $this->session->set_flashdata('message', 'Form submitted successfully!');
                }else{
                    $this->session->set_flashdata('error', 'Error in submitting form');
                }
                
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }else{
            $this->session->set_flashdata('error', "Bad Request");
        }
   
       
        $this->load->view('template/header');
        $this->load->view('/admin/dailydip_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($iddailydip) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'checkdate' => $this->input->post('checkdate'),
'petrol' => $this->input->post('petrol'),
'diesel' => $this->input->post('diesel'),
'superdiesel' => $this->input->post('superdiesel'),
'superpetrol' => $this->input->post('superpetrol'),
'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->DailydipModel->update_dailydip($iddailydip, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['dailydip'] = $this->DailydipModel->get_dailydip();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();

        
        $this->load->view('template/header');
        $this->load->view('admin/dailydip_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($iddailydip) {

        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->DailydipModel->delete_dailydip($iddailydip);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['dailydip'] = $this->DailydipModel->get_dailydip();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();


        $this->load->view('template/header');
        $this->load->view('admin/dailydip_tableview', $data);
        $this->load->view('template/footer');
    }
}
