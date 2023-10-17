<?php 

class Main_model extends CI_Model {





public function fetch_hotel($hotel)

{

	$que=$this->db->query("select * from hotel where hotel_name='".$hotel."'");

			return $row = $que->num_rows();

}



public function hotel($hotel){



	$data= array('hotel_name' => $hotel );

	$this->db->insert('hotel',$data);

			

}







public function fetch_destiny($destiny)

{

	$que=$this->db->query("select * from destination where destiny='".$destiny."'");

			return $row = $que->num_rows();

}



public function destiny($destiny){



	$data= array('destiny' => $destiny );

	$this->db->insert('destination',$data);

			

}









public function fetch_driver($driver)

{

	$que=$this->db->query("select * from driver where drive_name='".$driver."'");

			return $row = $que->num_rows();

}



public function driver($driver){



	$data= array('drive_name' => $driver );

	$this->db->insert('driver',$data);

			

}



public function hotel_detials(){

	// return $this->db->select('*')

	// 			->get('hotel')->result();
				$this->db->from('hotel');
$this->db->order_by("display_order", "asc");
$query = $this->db->get(); 
return $query->result();

}



public function destiny_detials(){

	return $this->db->select('*')

				->get('destination')->result();

}



public function add_comsion($data){

	

	$this->db->insert('comision',$data);

}



public function driver_detials(){

	return $this->db->select('*')

				->get('driver')->result();

}



public function add_payment_hotel($data){

	$this->db->insert('hotel_payment',$data);

}



public function add_payment_driver($data){

	$this->db->insert('driver_payment',$data);

}

public function save_appointment($data){

	$this->db->insert('booking',$data);

}



public function fetch_appoint_details(){



	return $this->db->select('*')->get('booking')->result();

}



public function new_ride_data($data,$hotel_id,$driver_id){

$this->db->insert('ride_booking',$data);

$last=$this->db->insert_id();

$date=date('Y-m-d');

$year = date('Y', strtotime($date));

$month = date('F', strtotime($date));


$data2= array('hotel_id' => $hotel_id,'rides_count'=>'1' ,'month'=>$month,'year'=>$year,'ride_id'=>$last);

$this->db->insert('hotel_rides',$data2);


$date=date('Y-m-d');

$year = date('Y', strtotime($date));

$month = date('F', strtotime($date));


$data2= array('driver_id' => $driver_id,'rides_count'=>'1','month'=>$month,'year'=>$year ,'ride_id'=>$last);

$this->db->insert('dirver_rides',$data2);

// $sql="UPDATE hotel_rides SET rides_count = '+1' WHERE hotel_id='$insert_id'";    

//     $query = $this->db->query($sql);

    // return $query->result_array();









}



public function fetch_ride_data(){



	 $this->db->order_by("id","desc");
	 return $this->db->select('*')->get('ride_booking')->result();

}



public function fetch_edit_appoitment($id){



	return $this->db->select('*')->where('id',$id)->get('ride_booking')->row();

}





public function Update_data_appointment($data,$id){



	 $this->db->where('id',$id)

                 ->set($data)

                 ->update('ride_booking');

                 return true;

}



public function fetch_edit_scdehule($id){

		return $this->db->select('*')->where('id',$id)->get('booking')->row();

}

public function save_edit_scdule_data($data,$id){

	 $this->db->where('id',$id)

                 ->set($data)

                 ->update('booking');

                 return true;

}



public function comision_detials(){

return	$this->db->select('*')->get('comision')->result();

}



public function edit_driver_detials($id){

	return $this->db->select('*')->where('id',$id)->get('driver')->row();

}

public function edit_driver($driver,$id){

	$this->db->where('id',$id)

                 ->set('drive_name',$driver)

                 ->update('driver');

                 return true;

}

public function edit_hotel_detials($id){

return $this->db->select('*')->where('id',$id)->get('hotel')->row();



}



public function edit_hotel($hotel,$id){

	$this->db->where('id',$id)

                 ->set('hotel_name',$hotel)

                 ->update('hotel');

                 return true;

}



public function edit_destiny_detials($id){

return $this->db->select('*')->where('id',$id)->get('destination')->row();



}



public function edit_destiny_data($destiny,$id){

	$this->db->where('id',$id)

                 ->set('destiny',$destiny)

                 ->update('destination');

                 return true;

}

public function edit_comission_detials($id){

	return $this->db->select('*')->where('id',$id)->get('comision')->row();

}



public function update_comission_data($data,$id){

$this->db->where('id',$id)

                 ->set($data)

                 ->update('comision');

                 return true;



}



public function hotel_payment_detials(){

return $this->db->select('*')->get('hotel_payment1')->result();



}

public function driver_payment_detials(){

return $this->db->select('*')->get('driver_payment1')->result();



}

public function edit_hotel_payemt($id){



	return $this->db->select('*')->where('id',$id)->get('hotel_payment1')->row();

}



public function update_hotel_payemt_details($data,$id){

	$this->db->where('id',$id)

                 ->set($data)

                 ->update('hotel_payment1');

                 return true;

}



public function edit_driver_payemt($id){



	return $this->db->select('*')->where('id',$id)->get('driver_payment1')->row();

}



public function update_driver_payemt_details($data,$id){

	$this->db->where('id',$id)

                 ->set($data)

                 ->update('driver_payment1');

                 return true;

}

public function delete_appoitment($id){


	$this->db->where('id' ,$id)->delete('ride_booking');
	$this->db->where('ride_id' ,$id)->delete('dirver_rides');
	$this->db->where('ride_id' ,$id)->delete('hotel_rides');
}

public function check_comsion($hotel_id ,$dest_id){

$data= array('hotel_id' =>$hotel_id ,'dest_id'=> $dest_id);

 return $this->db->select('*')->where($data)->get('comision')->result();

}

public function fetch_comision($hotel_id,$destiny){
	$data= array('hotel_id' =>$hotel_id ,'dest_id'=> $destiny);
	 return $this->db->select('rate')->where($data)->get('comision')->row();
}

public function monthly_driver_payemt($data){

	$this->db->insert('driver_payment', $data);
}
public function monthly_driver_unpayemt($id){

	$this->db->where('driver_id', $id)->delete('driver_payment');
}

public function monthly_hotel_unpayemt($id){

	$this->db->where('hotel_id', $id)->delete('hotel_payment');
}
public function monthly_hotel_payemt($data){

	$this->db->insert('hotel_payment', $data);
}

public function del_schd($id){

	$this->db->where('id' ,$id)->delete('booking');
}
public function ajax($allData){
// var_dump($allData);die;
	$i = 1;
foreach ($allData as $key => $value) {
     $sql = "UPDATE hotel SET display_order=".$i." WHERE id=".$value;

    	// $this->db->where('id',$value)

     //             ->set('display_order',$i)

     //             ->update('hotel');

     //             return true;
 $query = $this->db->query($sql);
    // return $query->result_array();
    $i++;
}
}

}



 ?>