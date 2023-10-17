<?php 

class Login_model extends CI_Model {







public function authenticate($user,$pass){


    $str = "select * from users where username = ? and password = ?";
	$r=$this->db->query($str, array($user, $pass));

			// return $row = $que->result();

			if ($r->num_rows()) {
            return $r->row();
        }
        else
        {
            return false;
        }



			

}



}



 ?>