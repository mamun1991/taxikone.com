<?php

defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set("Europe/Bucharest");
class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("pagination");
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
			'password' => $Password, '
is_admin' => '1'
		);
		$row = $this->Main_model->fetch_driver($driver);

		// $row=$this->Main_model->fetch_destiny($destiny);

		if ($row) {

			$this->session->set_flashdata('msg', 'Driver Already Exist');

			redirect('Main/index22');



		} else {

			$user_id = $this->Main_model->add_user($data);

			$this->Main_model->driver($driver, $user_id);

			$data['error'] = 'Driver Added Successfully';

			$this->session->set_flashdata('msg1', 'Driver Added Successfully');

			redirect('Main/index22');

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

		$data['hotel'] = $this->Main_model->hotel_detials1();



		$data['destiny'] = $this->Main_model->destiny_detials();



		$data['driver'] = $this->Main_model->driver_detials();

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
	public function catedelete_hotel($id, $ca)
	{
		$this->Main_model->delcate_hote($id, $ca);
		return redirect('Main/show_cate_hotel');
	}

}

?>