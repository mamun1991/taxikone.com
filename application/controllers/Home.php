<?php  

defined('BASEPATH') OR exit('No direct script access allowed');  

  
date_default_timezone_set("Europe/Bucharest");
class Home extends CI_Controller {  

 public function index()

{

	redirect('Login');
		$this->load->view('home/index');

}

}