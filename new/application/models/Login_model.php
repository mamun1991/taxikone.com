<?php 
class Login_model extends CI_Model {



public function authenticate($user,$pass){

	$que=$this->db->query("select * from users where username='".$user."' and password='$pass'");
			return $row = $que->num_rows();

			
}

}

 ?>