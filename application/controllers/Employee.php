<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeeModel'); 
        $this->load->model('EmployeetypeModel');

        $this->load->library('form_validation'); 
    }

    public function index() {

        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['employee'] = $this->EmployeeModel->get_employee();
        $data["employeetype"] = $this->EmployeetypeModel->get_employeetype();

        $this->load->view('template/header');
        $this->load->view('admin/employee_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/employee_formview.php');
        $this->load->view('template/footer');
    }

    public function applyasemployee()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data["employeetype"] = $this->EmployeetypeModel->get_employeetype();

        $this->load->view('template/header');
        $this->load->view('pages/emlpoyeeapplication',$data);
        $this->load->view('template/footer');
    }

    public function formupdate($idemployee)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['employee'] = $this->EmployeeModel->getwhere_employee($idemployee);
        $data['primaryid'] = $idemployee;

        $this->load->view('template/header');
        $this->load->view('/admin/employee_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('epf', 'epf', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('isactive', 'isactive', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('isavailable', 'isavailable', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('employeetype_idemployeetype', 'employeetype_idemployeetype', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('userid', 'userid', 'required|numeric|min_length[0]|max_length[11]|is_unique[employee.userid,idemployee,{idemployee}]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'epf' => $this->input->post('epf'),
                    'isactive' => $this->input->post('isactive'),
                    'isavailable' => $this->input->post('isavailable'),
                    'employeetype_idemployeetype' => $this->input->post('employeetype_idemployeetype'),
                    'userid' => $this->input->post('userid'),
                    'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->EmployeeModel->insert_employee($data);
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
        $this->load->view('/admin/employee_formview.php');
        $this->load->view('template/footer');
    }


    public function employeesave() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('employeetype_idemployeetype', 'employeetype_idemployeetype', 'required|min_length[0]|max_length[11]');
            

            if ($this->form_validation->run()) {
                
                $data = array(
                    'epf' => "EPF_".rand(10000000, 90000000),
                    'isactive' => 0,
                    'isavailable' => 0,
                    'employeetype_idemployeetype' => $this->input->post('employeetype_idemployeetype'),
                    'userid' => $this->session->user_id,
                    'isdelete' => 0,
                );

                $resultid = $this->EmployeeModel->insert_employee($data);
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

    public function edit($idemployee) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'epf' => $this->input->post('epf'),
'isactive' => $this->input->post('isactive'),
'isavailable' => $this->input->post('isavailable'),
'employeetype_idemployeetype' => $this->input->post('employeetype_idemployeetype'),
'userid' => $this->input->post('userid'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->EmployeeModel->update_employee($idemployee, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['employee'] = $this->EmployeeModel->get_employee();
        
        $data["employeetype"] = $this->EmployeetypeModel->get_employeetype();

        
        $this->load->view('template/header');
        $this->load->view('admin/employee_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idemployee) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->EmployeeModel->delete_employee($idemployee);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['employee'] = $this->EmployeeModel->get_employee();
        
        $data["employeetype"] = $this->EmployeetypeModel->get_employeetype();


        $this->load->view('template/header');
        $this->load->view('admin/employee_tableview', $data);
        $this->load->view('template/footer');
    }
}
