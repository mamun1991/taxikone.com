<?php

defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set("Europe/Bucharest");
class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("pagination");
		$this->load->library('form_validation');
		$this->load->helper('form');
		if (empty($this->session->userdata('id'))) {
			return redirect('Login');
		}
	}




	public function index()
	{
		$config = array();
		$config["base_url"] = base_url() . "Main/index";
		$config["total_rows"] = $this->Main_model->get_count();
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;


		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		/*
		end 
		add boostrap class and styles
		*/

		$this->pagination->initialize($config);


		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['ride'] = $this->Main_model->get_students($config["per_page"], $page);
		$data["total_rows"] = $this->Main_model->get_count();

		// $data['ride']=$this->Main_model->fetch_ride_data();

		$this->load->view('Home', $data);

	}





	public function index22()
	{



		$data['hotel'] = $this->Main_model->hotel_detials();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();



		$this->load->view('add_details', $data);

	}

	public function add_hotel()
	{

		$hotel = $this->input->post('hotel');

		$row = $this->Main_model->fetch_hotel($hotel);

		if ($row) {

			$this->session->set_flashdata('msg', 'Hotel Already Exist');

			redirect('Main/index22');



		} else {

			$this->Main_model->hotel($hotel);

			$data['error'] = 'Hotel Added Successfully';

			$this->session->set_flashdata('msg1', 'Hotel Added Successfully');

			redirect('Main/index22');

		}



	}



	public function add_destiny()
	{

		$destiny = $this->input->post('destiny');

		$row = $this->Main_model->fetch_destiny($destiny);

		if ($row) {

			$this->session->set_flashdata('msg', 'Destination Already Exist');

			redirect('Main/index22');



		} else {

			$this->Main_model->destiny($destiny);

			$data['error'] = 'Hotel Added Successfully';

			$this->session->set_flashdata('msg1', 'Destination Added Successfully');

			redirect('Main/index22');

		}

	}



	public function add_driver()
	{

		$driver = $this->input->post('driver');
		$Username = $this->input->post('Username');
		$Password = $this->input->post('Password');

		$data = array(
			'username' => $Username,
			'password' => $Password,
			'is_admin' => '1'
		);
		$row = $this->Main_model->fetch_driver($driver);
		// $row=$this->Main_model->fetch_destiny($destiny);
		if ($row) {
			$this->session->set_flashdata('msg', 'Driver Already Exist');
			redirect('Main/admin_dashboard');
		} else {
			$user_id = $this->Main_model->add_user($data);
			$d = $this->Main_model->driver($driver, $user_id);
			$data['error'] = 'Driver Added Successfully';
			$this->session->set_flashdata('msg1', 'Driver Added Successfully');
			redirect('Main/admin_dashboard');
		}
	}

	public function add_rate()
	{
		$hotel_id = $this->input->post('hotel_id');
		$dest_id = $this->input->post('destiny_id');
		$row = $this->Main_model->check_comsion($hotel_id, $dest_id);

		if (!empty($row)) {
			$this->session->set_flashdata('msg', 'Comission already Exist');
			redirect('Main/index22');
		} else {
			$data = array(
				'hotel_id' => $this->input->post('hotel_id'),
				'dest_id' => $this->input->post('destiny_id'),
				'rate' => $this->input->post('rate')
			);
			$this->Main_model->add_comsion($data);
			$this->session->set_flashdata('msg1', 'Comission added Successfully');
			redirect('Main/index22');
		}
	}


	public function add_payment()
	{

		// var_dump($this->input->post());die;
		$hotel = $this->input->post('hotel_id');
		$driver = $this->input->post('driver_id');
		if ($hotel != '-' && $driver != '-') {
			$this->session->set_flashdata('msg', 'You can only select a hotel or a driver, not both.');
			redirect('Main/index22');
		}

		if ($hotel != '-') {

			$data = array(
				'hotel_id' => $this->input->post('hotel_id'),
				'apr' => $this->input->post('apr'),
				'may' => $this->input->post('may'),
				'jun' => $this->input->post('jun'),
				'jul' => $this->input->post('jul'),
				'aug' => $this->input->post('aug'),
				'sep' => $this->input->post('sep')
			);

			$this->Main_model->add_payment_hotel($data);
			$this->session->set_flashdata('msg1', 'Payment Added Successfully');
			redirect('Main/index22');
		}

		if ($driver != '-') {

			$data = array(
				'driver_id' => $this->input->post('driver_id'),
				'apr' => $this->input->post('apr'),
				'may' => $this->input->post('may'),
				'jun' => $this->input->post('jun'),
				'jul' => $this->input->post('jul'),
				'aug' => $this->input->post('aug'),
				'sep' => $this->input->post('sep')
			);

			$this->Main_model->add_payment_driver($data);
			$this->session->set_flashdata('msg1', 'Payment Added Successfully');
			redirect('Main/index22');
		}
	}

	public function scdule()
	{

		if ($this->session->userdata('admin') == '0') {
			$data['appoint_data'] = $this->Main_model->fetch_appoint_details();
		} else {
			$id = $this->session->userdata('id');
			$data['appoint_data'] = $this->Main_model->fetch_appoint_details_by_user($id);
		}

		$this->load->view('scdule_plan', $data);

	}



	public function status()
	{

		$id=$this->session->userdata('id');
		$data['hotel'] = $this->Main_model->hotel_detials1();
		$table = 'driver';
		$where = array('user_id'=>$id);
		$param = '*';
		$data['own_driver'] = $this->Main_model->selectRow($table, $where, $param);

		// print_r($data['own_driver']);exit;

		$groupd = $this->Main_model->customSelectQuery("SELECT * FROM `group`");
		
		
		if($this->session->userdata('admin') == 1){
			$qr = "SELECT `hotel_id` FROM `category_by_hotel` WHERE `cate_id` IN(SELECT `cate_id` FROM `manager` WHERE `user_id` = ".$id.") ORDER BY hotel_id ASC";
			$gr = $this->Main_model->customSelectQuery($qr);
		} else {
			$gr = '';
		}
		// echo '<pre>';print_r($gr);exit;

		$data['customLoop'] = '';

		$dt = array();
		foreach($groupd as $r=> $gro){
			if($gr){
				foreach($gr as $t=> $gc){
					$queryString = "SELECT * FROM hotel WHERE status = 1 AND id = ".$gc->hotel_id." AND group_id = ".$gro->id;
					$dt[$gro->name][$t] = $this->Main_model->customSelectQuery($queryString);

					
					// echo '<pre>'; echo $this->db->last_query();
				}
				$data['customLoop'] = 'long';
			} else {
				$queryString = "SELECT * FROM hotel WHERE status = 1 AND group_id = ".$gro->id;
				$dt[$gro->name] = $this->Main_model->customSelectQuery($queryString);
				$data['customLoop'] = 'short';
			}

			// $queryString = "SELECT * FROM hotel WHERE status = 1 AND group_id = ".$gro->id;
			// $dt[$gro->name] = $this->Main_model->customSelectQuery($queryString);
			// $data['customLoop'] = 'short';

			
		}

		if($gr){
			foreach($gr as$k=> $gc){
				$qsf = "SELECT * FROM hotel WHERE status = 1 AND id = ".$gc->hotel_id." AND group_id = 0";
				$dt['NoGroup'][] = $this->Main_model->customSelectQuery($qsf);
			}
		} else {
			$qsf = "SELECT * FROM hotel WHERE status = 1 AND group_id = 0";
			$dt['NoGroup'] = $this->Main_model->customSelectQuery($qsf);
		}
		// $qsf = "SELECT * FROM hotel WHERE status = 1 AND group_id = 0";
		// $dt['NoGroup'] = $this->Main_model->customSelectQuery($qsf);
		// echo '<pre>';print_r($dt);exit;
		
	

		$data['hotel_group_list'] = $dt;

		// echo '<pre>';
		// print_r($data); exit;
		// echo $groupd[0]->id;
		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();


		if($this->input->get('ohrim') == 1 ){
			$data['ride'] = $this->Main_model->fetch_ride_data_by_id($data['own_driver']->id);
		} else {
			$data['ride'] = $this->Main_model->fetch_ride_data();
		}
		// echo '<pre>'; echo $this->db->last_query();
		



		$this->load->view('status_page', $data);

	}

	public function status_details_show(){
		$data['ride'] = $this->Main_model->fetch_ride_data();

		$this->load->view('status_page', $data);
	}

	

	public function add_appionment()
	{





		$data['hotel'] = $this->Main_model->hotel_detials();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();



		$this->load->view('appoint_page', $data);

	}



	public function save_appointment()
	{

		$id = $this->session->userdata('id');

		$data = array(
			'user_id' => $id,
			'date' => $this->input->post('date'),

			'hotel_id' => $this->input->post('hotel_id'),

			'destiny_id' => $this->input->post('destiny_id'),

			'type' => $this->input->post('type'),

			'flight_details' => $this->input->post('details'),
			'number' => $this->input->post('number'),
			'Price' => $this->input->post('Price'),
			'name' => $this->input->post('name')





		);



		$this->Main_model->save_appointment($data);

		redirect('Main/scdule');

	}



	public function new_ride()
	{



		$data['hotel'] = $this->Main_model->hotel_detials();
		// var_dump($data);die();


		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();

		$this->load->view('new_ride_page', $data);

	}



	public function add_ride()
	{
		date_default_timezone_set("Europe/Bucharest");
		// date_default_timezone_set('Asia/Karachi');
		$hotel_id = $this->input->post('hotel_id');
		$destiny = $this->input->post('destiny_id');

		$driver_id = $this->input->post('driver_id');
		$Rate = $this->Main_model->fetch_comision($hotel_id, $destiny);

		$date = date('Y-m-d');
		$datetime = new DateTime("now", new DateTimeZone("Europe/Bucharest"));

		$time = $datetime->format('H:i:s');
		// $time=date('h:i:sa');




		$year = date('Y', strtotime($date));

		$month = date('F', strtotime($date));

		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),

			'driver_id' => $this->input->post('driver_id'),

			'dest_id' => $this->input->post('destiny_id'),

			'date' => $date,
			'time' => $time,
			'comision' => $Rate->rate,
			'month' => $month,
			'year' => $year





		);



		$this->Main_model->new_ride_data($data, $hotel_id, $driver_id);

		$this->session->set_flashdata('Ride_Edit', 'Ride Enter Successfully');

		redirect('Main');

	}



	public function edit_appoitment($id)
	{

		$data['hotel'] = $this->Main_model->hotel_detials();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();

		$data['edit_data'] = $this->Main_model->fetch_edit_appoitment($id);

		// var_dump($data);

		$this->load->view('edit_appoitment_page', $data);





	}



	public function delete_appoitment($id)
	{

		$this->Main_model->delete_appoitment($id);


		$this->session->set_flashdata('del_msg', 'Deleted Successfully');

		redirect('Main');





	}



	public function edit_appointment_ride()
	{

		$id = $this->input->post('id');

		$data = array(



			'hotel_id' => $this->input->post('hotel_id'),

			'dest_id' => $this->input->post('destiny_id'),

			'driver_id' => $this->input->post('driver_id'),

			'ride_complete' => $this->input->post('ride_comp')





		);



		$row = $this->Main_model->Update_data_appointment($data, $id);

		if ($row) {

			$this->session->set_flashdata('Ride_Edit', 'Ride Edit Successfully');

			redirect('Main');



		} else {

			$this->session->set_flashdata('Ride_Edit', 'Please Try again');

			redirect('Main');

		}



	}



	public function edit_scdehule($id)
	{



		$data['hotel'] = $this->Main_model->hotel_detials();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();

		$data['edit_data'] = $this->Main_model->fetch_edit_scdehule($id);



		$this->load->view('edit_scdeule_page', $data);



	}



	public function save_edit_scdeule_data()
	{

		$id = $this->input->post('id');

		$data = array(

			'date' => $this->input->post('date'),

			'hotel_id' => $this->input->post('hotel_id'),

			'destiny_id' => $this->input->post('destiny_id'),

			'type' => $this->input->post('type'),

			'flight_details' => $this->input->post('details')





		);







		$row = $this->Main_model->save_edit_scdule_data($data, $id);

		if ($row) {

			$this->session->set_flashdata('Appoint', 'Ride Edit Successfully');

			redirect('Main/scdule');



		} else {

			$this->session->set_flashdata('Appoint', 'Please Try again');

			redirect('Main/scdule');

		}



	}



	public function db_page_show()
	{



		$data['hotel'] = $this->Main_model->hotel_detials1();

		$data['destiny'] = $this->Main_model->destiny_detials();

		$data['driver'] = $this->Main_model->driver_detials();

		$data['comision'] = $this->Main_model->comision_detials();

		$data['hotel_payment_detials'] = $this->Main_model->hotel_payment_detials();

		$data['driver_payment_detials'] = $this->Main_model->driver_payment_detials();

		$this->load->view('db_data', $data);

	}

	public function admin_dashboard(){

		if ($this->session->userdata('super_admin')!=1){
			redirect('Main/db_page_show');
		}
		$table = 'users';
		$param = '*';
		$data['admin_dash_data'] = $this->Main_model->selectAllData($table, $param);

		$this->load->view('admin_dashboard', $data);
	}

	public function select_admin(){
		$adminid = $this->input->post('adminid');
		$table = 'users';
		$where= array('id'=> $adminid);
		$select= '*';
		$dataadmin_name = $this->Main_model->selectRow($table, $where, $select);

		if($dataadmin_name){
			echo json_encode($dataadmin_name);
		} else {
			echo json_encode('error');
		}
	}

	public function admin_dashboard_update(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$adminType = $this->input->post('adminType');
		$superAdmin = $this->input->post('superAdmin');
		$adminId = $this->input->post('adminId');

		$table = 'users';
		$where = array('id'=>$adminId);
		$set = array(
			'username' => $username,
			'password' => $password,
			'is_admin' => $adminType,
			'super_admin' => $superAdmin,
		);
		$updateData = $this->Main_model->updateData($table, $where, $set);

		redirect('Main/admin_dashboard');

	}

	public function admin_dashboard_delete(){
		
		$adminId = $this->input->post('adminId_del');

		$table = 'users';
		$condition = array('id'=>$adminId);
	
		$deleteData = $this->Main_model->deleteRow($table, $condition);

		redirect('Main/admin_dashboard');

	}



	public function edit_driver($id)
	{

		$data['diver'] = $this->Main_model->edit_driver_detials($id);



		$this->load->view('edit_driver_page', $data);

	}



	public function edit_driver_data()
	{



		$driver = $this->input->post('driver');

		$id = $this->input->post('id');

		$row = $this->Main_model->fetch_driver($driver);

		if ($row) {

			$this->session->set_flashdata('msg', 'Driver Already Exist');

			redirect('Main/drive_view');



		} else {

			$this->Main_model->edit_driver($driver, $id);



			$this->session->set_flashdata('msg1', 'Driver Update Successfully');

			redirect('Main/drive_view');

		}

	}





	public function edit_hotel($id)
	{

		$data['hotel'] = $this->Main_model->edit_hotel_detials($id);



		$this->load->view('hotel_edit_page', $data);

	}



	public function edit_hotel_data()
	{



		$hotel = $this->input->post('hotel');

		$id = $this->input->post('id');

		$row = $this->Main_model->fetch_hotel($hotel);

		if ($row) {

			$this->session->set_flashdata('msg', 'Hotel Already Exist');

			redirect('Main/hotel_view');



		} else {

			$this->Main_model->edit_hotel($hotel, $id);



			$this->session->set_flashdata('msg1', 'Hotel Update Successfully');

			redirect('Main/hotel_view');

		}

	}



	public function edit_destiny($id)
	{

		$data['destiny'] = $this->Main_model->edit_destiny_detials($id);



		$this->load->view('edit_destiny_page', $data);

	}


	public function delete_destiny($id)
	{

		$data['destiny'] = $this->Main_model->delete_destiny_detials($id);



		return redirect('Main/db_page_show');

	}


	public function edit_destiny_data()
	{



		$destiny = $this->input->post('destiny');

		$id = $this->input->post('id');

		$row = $this->Main_model->fetch_destiny($destiny);

		if ($row) {

			$this->session->set_flashdata('msg', 'Destiny Already Exist');

			redirect('Main/dest_view');



		} else {

			$this->Main_model->edit_destiny_data($destiny, $id);



			$this->session->set_flashdata('msg1', 'Destiny Update Successfully');

			redirect('Main/dest_view');

		}

	}





	public function edit_comission($id)
	{



		$data['hotel'] = $this->Main_model->hotel_detials();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();

		$data['comision'] = $this->Main_model->edit_comission_detials($id);



		$this->load->view('edit_comission_page', $data);

	}



	public function edit_comission_details()
	{

		$id = $this->input->post('id');

		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),

			'dest_id' => $this->input->post('destiny_id'),

			'rate' => $this->input->post('rate')



		);



		$row = $this->Main_model->update_comission_data($data, $id);

		if ($row) {

			$this->session->set_flashdata('msg1', 'comission Update Successfully');

			redirect('Main/com_view');



		} else {

			$this->Main_model->edit_destiny_data($destiny, $id);



			$this->session->set_flashdata('msg', 'comission Update Successfully');

			redirect('Main/com_view');

		}



	}





	public function edit_hotel_payment_page($id)
	{

		$data['hotel1'] = $this->Main_model->hotel_detials();

		$data['hotel'] = $this->Main_model->edit_hotel_payemt($id);



		$this->load->view('edit_hotel_payment_page', $data);

	}

	public function update_hotel_payemt_details()
	{

		$id = $this->input->post('id');

		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),

			'apr' => $this->input->post('apr'),

			'may' => $this->input->post('may'),

			'jun' => $this->input->post('jun'),

			'jul' => $this->input->post('jul'),

			'aug' => $this->input->post('aug'),

			'sep' => $this->input->post('sep')



		);



		$this->Main_model->update_hotel_payemt_details($data, $id);

		$this->session->set_flashdata('msg1', 'Payment Update Successfully');

		redirect('Main/db_page_show');

	}





	public function edit_driver_payment_page($id)
	{

		$data['driver1'] = $this->Main_model->driver_detials();



		$data['driver'] = $this->Main_model->edit_driver_payemt($id);



		$this->load->view('edit_driver_payment_page', $data);

	}

	public function update_diver_payemt_details()
	{

		$id = $this->input->post('id');

		$data = array(
			'driver_id' => $this->input->post('driver_id'),

			'apr' => $this->input->post('apr'),

			'may' => $this->input->post('may'),

			'jun' => $this->input->post('jun'),

			'jul' => $this->input->post('jul'),

			'aug' => $this->input->post('aug'),

			'sep' => $this->input->post('sep')



		);



		$this->Main_model->update_driver_payemt_details($data, $id);

		$this->session->set_flashdata('msg1', 'Payment Update Successfully');

		redirect('Main/db_page_show');

	}

	public function drivers_comision_page()
	{
		// this hotel data not in use
		$data['hotel'] = $this->Main_model->hotel_detials();


		$data['driver'] = $this->Main_model->driver_detials();
		

		// this commision data not in use
		$data['comision'] = $this->Main_model->fetch_ride_data1();

		// var_dump($data['comision']);die;

		$this->load->view('driver_comision_page', $data);
	}

	public function hotel_comision_page()
	{

		$data['hotel'] = $this->Main_model->hotel_detials();
		$data['comision'] = $this->Main_model->fetch_ride_data();

		$this->load->view('hotel_comision_page', $data);
	}

	public function add_month_payment()
	{
		// var_dump($this->input->post());die;
		if ($this->input->post('month') !== null) {


			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {


			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

			$month = date('F', strtotime($date));
		}
		$data = array(
			'driver_id' => $this->input->post('driver_id'),

			'month' => $month,

			'year' => $year


		);

		$this->Main_model->monthly_driver_payemt($data);


		redirect('Main/drivers_comision_page');

	}

	public function add_month_payment_ajax()
	{
		// var_dump($this->input->post());die;
		if ($this->input->post('month') !== null) {


			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {


			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

			$month = date('F', strtotime($date));
		}
		$data = array(
			'driver_id' => $this->input->post('get_driver_id'),

			'month' => $month,

			'year' => $year


		);

		$result_data = $this->Main_model->monthly_driver_payemt($data);

		echo json_encode('Success');

		//redirect('Main/drivers_comision_page');

	}
	public function add_month_unpayment()
	{



		if ($this->input->post('month') !== null) {


			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {


			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

			$month = date('F', strtotime($date));
		}

		$id = $this->input->post('driver_id');

		$this->Main_model->monthly_driver_unpayemt($id, $month, $year);


		redirect('Main/drivers_comision_page');

	}

	public function add_month_unpayment_ajax()
	{



		if ($this->input->post('month') !== null) {


			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {


			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

			$month = date('F', strtotime($date));
		}

		$id = $this->input->post('driver_id');

		// echo $id.$month.$year;exit;

		$this->Main_model->monthly_driver_unpayemt($id, $month, $year);


		echo json_encode('Success');

	}
	public function add_month_unpayment_hotel()
	{



		$id = $this->input->post('hotel_id');

		$this->Main_model->monthly_hotel_unpayemt($id);


		redirect('Main/hotel_comision_page');

	}

	public function add_month_unpayment_hotel_ajax()
	{

		$id = $this->input->post('hotel_id');

		$this->Main_model->monthly_hotel_unpayemt($id);


		echo json_encode('Success');

	}
	public function add_month_payment_hotel()
	{

		if ($this->input->post('month') !== null) {
			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {

			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));
			$month = date('F', strtotime($date));
		}

		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),
			'month' => $month,
			'year' => $year
		);
		$this->Main_model->monthly_hotel_payemt($data);

		redirect('Main/hotel_comision_page');

	}

	public function add_month_payment_hotel_ajax()
	{

		if ($this->input->post('month') !== null) {
			$in_date = $this->input->post('month');

			$month = date('F', strtotime($in_date));
			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));

		} else {

			$date = date('Y-m-d');
			$year = date('Y', strtotime($date));
			$month = date('F', strtotime($date));
		}

		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),
			'month' => $month,
			'year' => $year
		);
		$this->Main_model->monthly_hotel_payemt($data);

		echo json_encode('Success');

	}

	public function delete_scd_ride()
	{
		$id = $this->input->post('id');
		$this->Main_model->del_schd($id);
		redirect('Main/scdule');
	}
	public function ajaxPost()
	{

		$allData = $_POST['allData'];

		$this->Main_model->ajax($allData);


	}


	public function hotel_view()
	{
		$data['hotel'] = $this->Main_model->hotel_detials1();
		$data['destiny'] = $this->Main_model->destiny_detials();
		$data['driver'] = $this->Main_model->driver_detials();
		$data['comision'] = $this->Main_model->comision_detials();
		$data['hotel_payment_detials'] = $this->Main_model->hotel_payment_detials();
		$data['driver_payment_detials'] = $this->Main_model->driver_payment_detials();

		$this->load->view('hotel_page', $data);

	}

	public function dest_view()
	{
		$data['hotel'] = $this->Main_model->hotel_detials();
		$data['destiny'] = $this->Main_model->destiny_detials();
		$data['driver'] = $this->Main_model->driver_detials();
		$data['comision'] = $this->Main_model->comision_detials();
		$data['hotel_payment_detials'] = $this->Main_model->hotel_payment_detials();
		$data['driver_payment_detials'] = $this->Main_model->driver_payment_detials();

		$this->load->view('destination_page.php', $data);

	}
	public function drive_view()
	{
		$data['hotel'] = $this->Main_model->hotel_detials();
		$data['destiny'] = $this->Main_model->destiny_detials();
		$data['driver'] = $this->Main_model->driver_detials();
		$data['comision'] = $this->Main_model->comision_detials();
		$data['hotel_payment_detials'] = $this->Main_model->hotel_payment_detials();
		$data['driver_payment_detials'] = $this->Main_model->driver_payment_detials();
		$this->load->view('driver_page.php', $data);

	}
	public function com_view()
	{
		$data['hotel'] = $this->Main_model->hotel_detials();
		$data['destiny'] = $this->Main_model->destiny_detials();
		$data['driver'] = $this->Main_model->driver_detials();
		$data['comision'] = $this->Main_model->comision_detials();
		$data['hotel_payment_detials'] = $this->Main_model->hotel_payment_detials();
		$data['driver_payment_detials'] = $this->Main_model->driver_payment_detials();

		$this->load->view('comission_page.php', $data);
	}

	public function cate_page()
	{
		$data['cate'] = $this->Main_model->fetch_category();
		$data['user'] = $this->Main_model->fetch_users();
		$data['man'] = $this->Main_model->fetch_manager();
		$this->load->view('add_category', $data);

		$this->Main_model->fetch_category();

	}

	public function add_category()
	{

		$cat = $this->input->post('category');

		$data = array('category_name' => $cat, );
		$this->Main_model->new_category($data);
		return redirect('Main/cate_page');
	}

	public function Delete_category($id)
	{


		$this->Main_model->del_category($id);
		return redirect('Main/cate_page');

	}

	public function cate_hotel()
	{
		$data['cate'] = $this->Main_model->fetch_category();
		$data['hotel'] = $this->Main_model->hotel_detials();
		$data['hcate'] = $this->Main_model->fetch_hotel_category();
		$this->load->view('hotel_category_page', $data);
	}

	public function add_hotel_by_cate()
	{

		$hotel = $this->input->post('hotel_id');
		$cate = $this->input->post('cate_id');
		foreach ($hotel as $key) {
			$data = array(
				'cate_id' => $cate,
				'hotel_id' => $key
			);
			$this->Main_model->hotels_category($data);
		}
		return redirect('Main/cate_hotel');
	}

	public function show_cate_hotel()
	{
		$data['cate'] = $this->Main_model->fetch_category();
		$data['hcate'] = $this->Main_model->fetch_hotel_by_category();
		$this->load->view('show_hotel_category', $data);
	}

	public function manager_category()
	{
		$cat = $this->input->post('cate_id');
		$user = $this->input->post('user_id');

		$data = array('cate_id' => $cat, 'user_id' => $user);
		$this->Main_model->new_manager($data);
		return redirect('Main/cate_page');
	}

	public function manager_category_update(){
		$cat = $this->input->post('cate_id');
		$manager = $this->input->post('manager_id');

		$set = array('cate_id' => $cat);
		$where = array('m_id' => $manager);
		$this->Main_model->updateData('manager', $where, $set);
		return redirect('Main/cate_page');
	}

	public function category_update(){
		$this->form_validation->set_rules('user_name', 'Username', 'required|trim');


		if ($this->form_validation->run() == FALSE) {
            // Form validation failed, show error message
            $data['error'] = validation_errors();
            return redirect('Main/cate_page');
        } else {
            $cat = $this->input->post('category_id');
			$catname = $this->input->post('user_name');

			$set = array('category_name' => $catname);
			$where = array('id' => $cat);
			$this->Main_model->updateData('category', $where, $set);
			return redirect('Main/cate_page');
        }
		
	}

	public function catedelete_hotel($id, $ca)
	{
		$this->Main_model->delcate_hote($id, $ca);
		return redirect('Main/show_cate_hotel');
	}

	public function status_details(){

		$tableName = 'group';
		$selectParam = '*';
		$groupData = $this->Main_model->selectAllData($tableName, $selectParam);
		$data['group_data'] = $groupData;
		$queryString = 'SELECT hotel.*, `group`.`name` AS groupname, `group`.`id` AS groupid FROM hotel LEFT JOIN `group` on `group`.id = hotel.group_id ORDER BY groupname DESC';
		$hotelData = $this->Main_model->customSelectQuery($queryString);
		$data['hotel_data'] = $hotelData;

		// echo '<pre>'; print_r($data);exit;

		$this->load->view('status_details', $data);
	}


	public function add_group(){
		$this->form_validation->set_rules('name','Group Name','required');

		if($this->form_validation->run() === false)
		{
			echo json_encode('error');
		} else {
			$name = $this->input->post('name');
			$status = $this->input->post('status');
			$data = array('name' => $name, 'status' => $status);

			$dataInsert = $this->Main_model->addGroup($data);

			if($dataInsert){
				echo json_encode($dataInsert);
			} else {
				echo json_encode('error');
			}
		}
	}

	public function update_group(){
		$this->form_validation->set_rules('name','Group Name','required');

		if($this->form_validation->run() === false)
		{
			echo json_encode('error');
		} else {
			$name = $this->input->post('name');
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			$data = array('name' => $name, 'status' => $status);

			$dataInsert = $this->Main_model->updateGroup($data, $id);

			if($dataInsert){
				echo json_encode($dataInsert);
			} else {
				echo json_encode('error');
			}
		}
	}

	public function addHotel(){
		$this->form_validation->set_rules('hotel_name','Hotel Name','required');

		if($this->form_validation->run() === false)
		{
			echo json_encode('error');
		} else {
			$name = $this->input->post('hotel_name');
			$status = $this->input->post('status');
			$group = $this->input->post('group');
			$datas = array('hotel_name' => $name, 'status' => $status, 'group_id' => $group);


			$select = '*';
			$table = 'group';
			$where = array('id' => $group);
			$data['dataInsert'] = $this->Main_model->addHotel($datas);
			$data['group_name'] = $this->Main_model->selectRow($table, $where, $select);

			if($data['dataInsert']){
				echo json_encode($data);
			} else {
				echo json_encode($data['dataInsert'] = 'error');
			}
		}
	}

	public function update_hotel(){
		$this->form_validation->set_rules('hotel_name','Hotel Name','required');

		if($this->form_validation->run() === false)
		{
			echo json_encode('error');
		} else {
			$name = $this->input->post('hotel_name');
			$id = $this->input->post('id');
			$groupid = $this->input->post('groupid');
			$status = $this->input->post('status');
			$data = array('hotel_name' => $name, 'status' => $status, 'group_id' => $groupid);

			$dataInsert = $this->Main_model->updateHotel($data, $id);

			if($dataInsert){
				echo json_encode($dataInsert);
			} else {
				echo json_encode('error');
			}
		}
	}

	public function delete_group(){
		$id = $this->input->post('delId');

		$table = 'group';
		$where = array('id'=> $id);

		$dataDelete = $this->Main_model->deleteRow($table, $where);

		if($dataDelete){
			echo json_encode($dataDelete);
		} else {
			echo json_encode('error');
		}
	}

	public function delete_hotel(){
		$id = $this->input->post('delId');

		$table = 'hotel';
		$where = array('id'=> $id);

		$dataDelete = $this->Main_model->deleteRow($table, $where);

		if($dataDelete){
			echo json_encode($dataDelete);
		} else {
			echo json_encode('error');
		}
	}

	public function superAdmin(){
		$userId = $this->session->userdata('id');

		if($this->session->userdata('admin') == 0){
			$isadmin = 1;
		} else {
			$isadmin = 0;
		}

		$table = 'users';
		$where = array('id'=> $userId);
		$update = array('is_admin'=> $isadmin);

		$dataadmin = $this->Main_model->updateData($table, $where, $update);
		$this->session->set_userdata('username', 'jane_doe');

		$rowid = $this->session->userdata('id');
		$rowis_admin = $this->session->userdata('admin');
		$rowsuper_admin = $this->session->userdata('super_admin');
		$user = $this->session->userdata('user');

		$this->session->set_userdata(array('user'=>$user,'id'=>$rowid,'admin'=>$isadmin,'super_admin' => $rowsuper_admin));  
		redirect($_SERVER['HTTP_REFERER']);

	}

	public function delete_manager(){
		$id = $this->input->post('manager_id');

		$table = 'manager';
		$where = array('m_id'=> $id);

		$dataDelete = $this->Main_model->deleteRow($table, $where);

		return redirect('Main/cate_page');
	}
}

?>