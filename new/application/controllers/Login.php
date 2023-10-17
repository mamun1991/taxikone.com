<?php  
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');  

  

class Login extends CI_Controller {  

      

    public function index()  

    {  

        $this->load->view('login_view');  

    }  

    public function process()  

    {  
        
        $user = $this->input->post('user');  

        $pass = $this->input->post('pass');  

        $row=$this->Login_model->authenticate($user,$pass);

        if ($row)   

        {  

            //declaring session  

            $this->session->set_userdata(array('user'=>$user));  

             redirect('Main'); 

        }  

        else{  

            $data['error'] = 'Your Account is Invalid';  

            $this->load->view('login_view', $data);  

        }  

    }  

    public function logout()  

    {  

        //removing session  

        $this->session->unset_userdata('user');  

        redirect("Login");  

    }  

  

}  

?>  