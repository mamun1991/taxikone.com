<?php 

class Main_model extends CI_Model {


// die;
public function delete_destiny_detials($id){

	$this->db->where('id', $id)->delete('destination');
}


public function fetch_hotel($hotel)

{

	$que=$this->db->query("select * from hotel where hotel_name='".$hotel."'");
	return $row = $que->num_rows();
			// SELECT hotel.hotel_name FROM hotel INNER JOIN order_by_hotel ON hotel.id=order_by_hotel.hotel_id ORDER BY show_seq DESC

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



public function driver($driver,$user_id){

	$data= array('drive_name' => $driver,'user_id'=>$user_id );
	$this->db->insert('driver',$data);

}

public function add_user($data){

	$this->db->insert('users',$data);
	$insert_id = $this->db->insert_id();

	return  $insert_id;
}

public function hotel_detials_by_user($hotelid){
	$query=$this->db->query(" SELECT * FROM hotel WHERE status = 1 AND id = ".$hotelid." ORDER BY id DESC");
	return $query->result();
}


public function hotel_detials(){


	 $query=$this->db->query("SELECT hotel.* FROM hotel INNER JOIN order_by_hotel ON hotel.id=order_by_hotel.hotel_id ORDER BY show_seq DESC");
	//  $query=$this->db->query(" SELECT * FROM hotel WHERE status = 1 ORDER BY id DESC");
	 
 
 return $query->result();

}

public function hotel_detials1(){

	return $this->db->select('*')
->order_by("display_order", "asc")
				->get('hotel')->result();

 return $query->result();

}



public function destiny_detials(){

	// return $this->db->select('*')

	// 			->get('destination')->result();
	// $query=$this->db->query("SELECT destination.destiny, destination.id FROM destination INNER JOIN order_by_destination ON destination.id=order_by_destination.dest_id ORDER BY show_seq DESC");
	$query=$this->db->query("SELECT destiny, id FROM destination");
return $query->result();

}



public function add_comsion($data){

	

	$this->db->insert('comision',$data);

}


public function driver_detials(){

	// return $this->db->select('*')

	// 			->get('driver')->result();
	$query=$this->db->query("SELECT driver.drive_name, driver.id FROM driver LEFT JOIN order_by_driver ON driver.id=order_by_driver.driver_id ORDER BY show_seq DESC");
return $query->result();

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



public function fetch_appoint_details($type = ''){

	$this->db->order_by("date","asc");
	if($type){
		$this->db->where('type',$type);
	}
	return $this->db->select('*')->get('booking')->result();
}
public function fetch_appoint_details_by_user($id, $type = ''){

	$this->db->order_by("date","desc");
	$this->db->where('user_id',$id);
	if($type){
		$this->db->where('type',$type);
	}
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



$to_order=$this->db->query("SELECT hotel_id, COUNT(hotel_id) AS Duplicates FROM ride_booking
GROUP BY hotel_id
ORDER BY Duplicates DESC");

$res= $to_order->result_array();
$this->db->truncate('order_by_hotel');
foreach ($res as $key ) {
	$data = array('hotel_id' =>$key['hotel_id'] ,'
		show_seq'=>$key['Duplicates'] );

	 $this->db->insert('order_by_hotel',$data);
}
//DRIVER
$to_order=$this->db->query("SELECT driver_id, COUNT(driver_id) AS Duplicates FROM ride_booking
GROUP BY driver_id
ORDER BY Duplicates DESC");

$res= $to_order->result_array();
$this->db->truncate('order_by_driver');
foreach ($res as $key ) {
	$data = array('driver_id' =>$key['driver_id'] ,'
		show_seq'=>$key['Duplicates'] );

	 $this->db->insert('order_by_driver',$data);
}

//dest
$to_order=$this->db->query("SELECT dest_id, COUNT(dest_id) AS Duplicates FROM ride_booking
GROUP BY dest_id
ORDER BY Duplicates DESC");

$res= $to_order->result_array();
$this->db->truncate('order_by_destination');
foreach ($res as $key ) {
	$data = array('dest_id' =>$key['dest_id'] ,'
		show_seq'=>$key['Duplicates'] );

	 $this->db->insert('order_by_destination',$data);
}
// $sql="UPDATE hotel_rides SET rides_count = '+1' WHERE hotel_id='$insert_id'";    

//     $query = $this->db->query($sql);

    // return $query->result_array();









}



public function fetch_ride_data(){
	 $this->db->order_by("id","desc");
	 return $this->db->select('*')->get('ride_booking')->result();
}

public function fetch_ride_data_by_id($id){
	$this->db->select('*');
	$this->db->where('driver_id', $id);
	$this->db->from('ride_booking');
	$query = $this->db->get();

	if ( $query->num_rows() > 0 )
	{
		return $query->result();
	}
}


public function fetch_ride_data1(){



	$this->db->select('*');    
$this->db->from('ride_booking');
$this->db->join('comision', 'ride_booking.hotel_id = comision.hotel_id');
$this->db->join('driver', 'ride_booking.driver_id = driver.id');

return $query = $this->db->get()->result();

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
public function monthly_driver_unpayemt($id,$month,$year){

$where= array('driver_id' => $id,'month'=>$month,'year'=>$year );
// var_dump($where);die;
	$this->db->where($where)->delete('driver_payment');
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

public function new_category($data){

	$this->db->insert('category',$data);
}

public function fetch_category(){

	return $this->db->get('category')->result();
}

public function del_category($id){

	$this->db->where('id',$id)->delete('category');
}

public function hotels_category($data){

	$this->db->insert('category_by_hotel',$data);
}
public function fetch_hotel_category(){
	return $this->db->get('category')->result();
}
public function fetch_hotel_by_category(){
	return $this->db->get('category_by_hotel')->result();
}
public function fetch_users(){
	return $this->db->select('*')->get('users')->result();
}
public function new_manager($data){

	$this->db->insert('manager',$data);
}
public function fetch_manager(){
	return $this->db->get('manager')->result();
}
public function get_count() 
	{
        return $this->db->count_all("ride_booking");
    }

    public function get_students($limit, $start) 
	{
		 $this->db->order_by("id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get("ride_booking");
        return $query->result();
    }

    public function delcate_hote($id,$ca){
	$where= array('hotel_id' => $id,'cate_id'=>$ca);

	$this->db->where($where)->delete('category_by_hotel');

    }

	public function selectRow($table, $where, $param){
		$this->db->select($param);
		$this->db->where($where);
		$this->db->from($table);
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row();
			return $row;
		}
	}

	public function customSelectQuery($queryString){
		// $queryString = 'SELECT hotel.*, `group`.`name` AS groupname, `group`.`id` AS groupid FROM hotel LEFT JOIN `group` on `group`.id = hotel.group_id ORDER BY hotel.id DESC';
		$query = $this->db->query($queryString);

		if ( $query->num_rows() > 0 )
		{
			$row = $query->result();
			return $row;
		}
	}

	public function selectAllData($table, $param){
		$this->db->select($param);
		$this->db->from($table);
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->result();
			return $row;
		}
	}

	public function addGroup($data){

		$this->db->insert('group',$data);
		return $this->db->insert_id();
		
	}

	public function updateGroup($data, $id){
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('group');

		return $this->db->affected_rows();
	}

	public function addHotel($data){

		$this->db->insert('hotel',$data);

		// echo $this->db->last_query();exit;
		return $this->db->insert_id();

	}

	public function updateHotel($data, $id){
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('hotel');

		return $this->db->affected_rows();
	}

	public function deleteRow($table, $condition){
		$this->db->where($condition);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	public function updateData($table, $where, $set){
		$this->db->set($set);
		$this->db->where($where);
		$this->db->update($table);

		return $this->db->affected_rows();
	}

}



 ?>