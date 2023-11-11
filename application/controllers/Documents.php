<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('DocumentsModel'); 
        $this->load->model('FillingstationModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['documents'] = $this->DocumentsModel->get_documents();
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();

        $this->load->view('template/header');
        $this->load->view('admin/documents_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/documents_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($iddocuments)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['documents'] = $this->DocumentsModel->getwhere_documents($iddocuments);
        $data['primaryid'] = $iddocuments;

        $this->load->view('template/header');
        $this->load->view('/admin/documents_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('type', 'type', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('filename', 'filename', '|min_length[0]|max_length[450]');
$this->form_validation->set_rules('uploaddate', 'uploaddate', '|valid_date|min_length[0]');
$this->form_validation->set_rules('isapproved', 'isapproved', '|min_length[0]|max_length[4]');
$this->form_validation->set_rules('fillingstation_idfillingstation', 'fillingstation_idfillingstation', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('approvedby', 'approvedby', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'type' => $this->input->post('type'),
'filename' => $this->input->post('filename'),
'uploaddate' => $this->input->post('uploaddate'),
'isapproved' => $this->input->post('isapproved'),
'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
'approvedby' => $this->input->post('approvedby'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->DocumentsModel->insert_documents($data);
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
        $this->load->view('/admin/documents_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($iddocuments) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'type' => $this->input->post('type'),
'filename' => $this->input->post('filename'),
'uploaddate' => $this->input->post('uploaddate'),
'isapproved' => $this->input->post('isapproved'),
'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
'approvedby' => $this->input->post('approvedby'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->DocumentsModel->update_documents($iddocuments, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['documents'] = $this->DocumentsModel->get_documents();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();

        
        $this->load->view('template/header');
        $this->load->view('admin/documents_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($iddocuments) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->DocumentsModel->delete_documents($iddocuments);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['documents'] = $this->DocumentsModel->get_documents();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();


        $this->load->view('template/header');
        $this->load->view('admin/documents_tableview', $data);
        $this->load->view('template/footer');
    }
}
