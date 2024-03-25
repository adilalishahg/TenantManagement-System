<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{


	public function __construct()
	{

		parent::__construct();

		// print_r($_SESSION);
		if ($this->session->userdata('email') == '' || $this->session->userdata('user_id') == '') {
			// echo 'Redirecting to login...';
			redirect('login');
		}
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function calculateDays($givenDateTime)
	{
		$today = new DateTime();
		$lastDayOfMonth = new DateTime(date('Y-m-t')); // last day of the current month
		$givenDate = new DateTime($givenDateTime);

		// Calculate the number of pending days
		$pendingDays = $lastDayOfMonth->format('j') - $today->format('j');

		// Calculate the number of passed days
		$passedDays = $today->format('j') - 1;

		// Calculate the difference in seconds
		$timeDifference = $today->getTimestamp() - $givenDate->getTimestamp();

		// Calculate the number of spent days
		$spentDays = floor($timeDifference / (60 * 60 * 24));

		return [
			'pendingDays' => $pendingDays,
			'passedDays' => $passedDays,
			'spentDays' => $spentDays
		];
	}

	public function index()
	{
		// print_r('asd');


		if ($_SESSION['role']  != '3' && $_SESSION['role']  != '5') {
			// Get the current date
			$currentDate = date('Y-m-d');
			$data['ratio']=$data['booked']=$data['total_flats']=0;
			// Calculate the date one month ago
			$oneMonthAgo = date('Y-m-d', strtotime('-1 month', strtotime($currentDate)));
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 MONTH)"`;
			$select = 'sum(amount) as total ';
			$data['total'] = $this->Db_Model->get_booked_data('');
			// echo $query;
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 YEAR)"`;
			$data['year'] = $this->Db_Model->get_booked_data($where);

			$booking = $this->Db_Model->get_data(TBL_RENT, $where = '', '', '', $type = 1, $select = 'DISTINCT(flat_id) as booked');
 			if(!empty($booking)&&!empty( $booking[0])){

				$data['booked'] = $booking[0]['booked'];
			}
			$data['total_flats'] = $this->Db_Model->get_data(TBL_FLAT, $where = '', '', '', $type = 1, $select = 'count(flat_id) as total_flats')[0]['total_flats'];
			if(isset($data['booked'])&&!empty($data['booked'])){
			$data['ratio'] = ($data['booked'] / $data['total_flats']) * 100;
}

			$this->load->view('welcome_message', $data);
		}
		if ($_SESSION['role']  == '3') {
			$data['booking'] =  $this->Db_Model->booking_detail($_SESSION['user_id']);

			foreach ($data['booking'] as $key => &$value) {
				// print_r($value);
				$return = ($this->calculateDays($value['created_at']));;
				$value['spentDays'] = $return['spentDays'];
				$value['passedDays'] = $return['passedDays'];
				$value['pendingDays'] = $return['pendingDays'];
				// echo "Pending Days: $pendingDays, Passed Days: $passedDays, Spent Days: $spentDays";
			}

			$this->load->view('user_dashboard', $data);
		}
		// } else {

		// 	$this->load->view('login');
		// }
		// $this->load->view('includes/footer');
	}
	public function main_ajax()
	{

		if ($_SESSION['role']  != '3' && $_SESSION['role']  != '5') {
			// Get the current date
			$currentDate = date('Y-m-d');
			$data['user'] = $_SESSION['user_id'];
			// Calculate the date one month ago
			$oneMonthAgo = date('Y-m-d', strtotime('-1 month', strtotime($currentDate)));
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 MONTH)"`;
			// $data['total'] = $this->Db_Model->get_data(TBL_RENT, $where, '', '', $type = 1, $select = 'sum(amount) as total')[0]['total'];
			
			if($data['total_monthly'] = $this->Db_Model->get_booked_data())
			$data['total'] = $data['total_monthly'] = $this->Db_Model->get_booked_data()['result'];
			if(empty($data['total'])){
				$data['total'] = 0;
			}if(empty($data['total_monthly'])){
				$data['total_monthly'] = 0;
			}
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 YEAR)"`;
			$data['year'] = $this->Db_Model->get_data(TBL_RENT, $where, '', '', $type = 1, $select = 'sum(amount) as total')[0]['total'];
			if(empty($data['year'])){
				$data['year'] = 0;
			}
			// $data['booked'] = $this->Db_Model->get_data(TBL_RENT, $where = '', '', '', $type = 1, $select = 'DISTINCT(flat_id) as booked')[0]['booked'];
			$data['booked'] = $this->Db_Model->get_booked_flat_by_user();
			if(empty($data['booked'])){
				$data['booked'] = 0;
			}
			// $query = $this->db->last_query();
			// echo $query;
			$where_flats = array(
				'owner_id' => $_SESSION['user_id']
			);
			// echo json_encode($this->Db_Model->get_booked_flat_by_user($where_flats));
			// exit;
			$data['total_flats']=$data['booked_flats'] =0;
			$data['total_flats_data'] = $this->Db_Model->get_data(TBL_FLAT, $where_flats, '', '', $type = 1, $select = 'count(flat_id) as total_flats')[0];
			// if(!empty($data['total_flats_data'])){
			// 	$data['total_flats_data'] = $data['total_flats_data'][0]['total_flats'];

			// }
			$data['total_flats'] = $this->Db_Model->get_data(TBL_FLAT, $where_flats, '', '', $type = 1, $select = 'count(flat_id) as total_flats')[0]['total_flats'];
			$data['total_flats'] = $this->Db_Model->get_data(TBL_FLAT, $where_flats, '', '', $type = 1, $select = 'count(flat_id) as total_flats')[0]['total_flats'];
			$data['booked_flats'] = $data['booked']['result'];


			if ($data['total_flats'] && $data['total_flats'] != '0') {

				$data['ratio'] = ($data['booked_flats'] / $data['total_flats']) * 100;
			}
			echo json_encode($data);
			exit;
			$this->load->view('welcome_message', $data);
		}
		if ($_SESSION['role']  == '3') {
			$where = TBL_RENT . '.tenant_id  ="' . $_SESSION['user_id'] . '"';
			// print_r($where);
			$data['booking'] =  $this->Db_Model->booking_detail($_SESSION['user_id'], $where);
			// $data['booking'] =  $this->Db_Model->get_booked_flat_by_user($_SESSION['user_id']);

			// print_r($data['booking']);
			if ($data['booking']) {

				foreach ($data['booking'] as $key => &$value) {
					// print_r($value);
					$return = ($this->calculateDays($value['created_at']));;
					$value['spentDays'] = $return['spentDays'];
					$value['passedDays'] = $return['passedDays'];
					$value['pendingDays'] = $return['pendingDays'];
					// echo "Pending Days: $pendingDays, Passed Days: $passedDays, Spent Days: $spentDays";
				}

				echo json_encode($data);
				exit;
			} else {
				echo '0';	
				exit;
			}

			$this->load->view('user_dashboard', $data);
		} else {
		}
	}

	public function logout()
	{
		// Destroy the user's session

		$this->session->sess_destroy();
		// // Redirect to the login page
		redirect('login'); // Change 'auth/login' to your actual login route

	}
	public function logout_ajax()
	{
		// Destroy the user's session

		$this->session->sess_destroy();
		// // Redirect to the login page
		echo json_encode(1); // Change 'auth/login' to your actual login route
		exit;
	}

	public function forgot()
	{


		$this->load->view('forgot_password');
	}
	public function book_flat()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('flat_name', 'Flat Name', 'required');
			$this->form_validation->set_rules('flat_type', 'Flat Type', 'required');
			$this->form_validation->set_rules('tower', 'Tower', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('owner', 'owner', 'required');
			$this->form_validation->set_rules('rent', 'rent', 'required');
			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
			} else {
				// print_r($_POST);
				$data = array(
					'tower_id' => $_POST['tower'],
					'type' => $_POST['flat_type'],
					'rent' => $_POST['rent'],
					// 'expense' => '123',
					'owner_id' => $_POST['owner'], // Hash the password
					'status' => $_POST['status'], // Hash the password
				);

				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_FLAT, $data);

				print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
				return;
			}
		} else {

			$users = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$tower = $this->Db_Model->get_data(TBL_TOWER, $where = '', '', '', $type = 1);
			// return json_encode(['users' => $users, 'towers' => $tower]);
			$this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		}
	}
	public function register_flat_ajax()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('flat_name', 'Flat Name', 'required');
			$this->form_validation->set_rules('flat_type', 'Flat Type', 'required');
			$this->form_validation->set_rules('tower', 'Tower', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('owner', 'owner', 'required');
			$this->form_validation->set_rules('rent', 'rent', 'required');
			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
			} else {
				// print_r($_POST);
				$data = array(
					'tower_id' => $_POST['tower'],
					'type' => $_POST['flat_type'],
					'flat_name' => $_POST['flat_name'],
					'rent' => $_POST['rent'],
					// 'expense' => '123',
					'owner_id' => $_POST['owner'], // Hash the password
					'status' => $_POST['status'], // Hash the password
				);
				// Save to database using the model
				if (isset($_POST['flat_id'])&&$_POST['flat_id']!='false') {
					$where['flat_id']=$_POST['flat_id'];
					$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
					$mesg = 'Updated';
				} else {
					$mesg = 'Registered';

					$user_id = $this->Db_Model->save_data(TBL_FLAT, $data);
				}

				print json_encode(['status' => 'success', 'message' => 'Flat ' . $mesg . ' successfully', 'data' => $user_id]);
				return;
			}
		} else {
			// print_r('asd');

			$users = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$tower = $this->Db_Model->get_data(TBL_TOWER, $where = '', '', '', $type = 1);
			echo json_encode(['users' => $users, 'towers' => $tower]);
			exit;
			// $this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		}
	}
	public function employees_ajax()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// print_r($_POST);
			if (isset($_POST['del_id'])) {

				$where = array(
					'user_id' => $_POST['del_id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->delete_data(TBL_USER, $where);

				print json_encode(['status' => 'success', 'message' => 'User Deleted']);
			}
			if (isset($_POST['id'])) {

				$where = array(
					'user_id' => $_POST['id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->get_data(TBL_USER, $where, '', '', $type = 1);

				print json_encode(['status' => 'success', 'data' => $employee[0]]);
			}
			if (isset($_POST['edit_id'])) {

				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('role', 'Role', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
				if ($this->form_validation->run() === false) {
					// Form validation failed

					$errors = $this->form_validation->error_array();
					// print_r($errors);
					print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
					return;
				} else {
					$where = array(
						'user_id' => $_POST['edit_id']
					);
					$data = array(
						'first_name' => $_POST['edit_id'],
						'last_name' => $_POST['last_name'],
						'email' => $_POST['edit_id'],
						'contact_no' => $_POST['contact_no'],
						'plainPassword' => $_POST['password'],
						'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
					);
					// Save to database using the model
					$employee = $this->Db_Model->update_data(TBL_USER, $data, $where);
					$lastQuery = $this->db->last_query();

					// print json_encode(['status' => 'success', 'data' => $employee[0]]);
					print json_encode(['status' => 'success', 'data' => 'User Updated successfully', 'message' => 'User Updated successfully']);
				}
			}
			exit;
		} else {


			$where = 'type=2 or type=5';
			$users = $this->Db_Model->get_data(TBL_USER, $where, '', '', $type = 1);
			echo json_encode(['users' => $users]);
			exit;
			// $this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		}
	}
	public function reports_ajax()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// print_r($_POST);
			if (isset($_POST['del_id'])) {

				$where = array(
					'user_id' => $_POST['del_id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->delete_data(TBL_USER, $where);

				print json_encode(['status' => 'success', 'message' => 'User Deleted']);
			}
			if (isset($_POST['id'])) {

				$where = array(
					'user_id' => $_POST['id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->get_data(TBL_USER, $where, '', '', $type = 1);

				print json_encode(['status' => 'success', 'data' => $employee[0]]);
			}
			if (isset($_POST['edit_id'])) {

				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('role', 'Role', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
				if ($this->form_validation->run() === false) {
					// Form validation failed

					$errors = $this->form_validation->error_array();
					// print_r($errors);
					print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
					return;
				} else {
					$where = array(
						'user_id' => $_POST['edit_id']
					);
					$data = array(
						'first_name' => $_POST['edit_id'],
						'last_name' => $_POST['last_name'],
						'email' => $_POST['edit_id'],
						'contact_no' => $_POST['contact_no'],
						'plainPassword' => $_POST['password'],
						'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
					);
					// Save to database using the model
					$employee = $this->Db_Model->update_data(TBL_USER, $data, $where);
					$lastQuery = $this->db->last_query();

					// print json_encode(['status' => 'success', 'data' => $employee[0]]);
					print json_encode(['status' => 'success', 'data' => 'User Updated successfully', 'message' => 'User Updated successfully']);
				}
			}
			exit;
		} else {
			echo json_encode(1);exit;

			$where = 'type=2 or type=5';
			$users = $this->Db_Model->get_data(TBL_USER, $where, '', '', $type = 1);
			echo json_encode(['users' => $users]);
			exit;
			// $this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		}
	}
	public function  report_ajax()
	{
			$err=$st_date =$en_date =$where ='';
			$st = $_GET['start_date']?$_GET['start_date']:'';
			$en = $_GET['end_date']?$_GET['end_date']:'';
			$name = $_GET['name']? $_GET['name']:'';
			$type = $_GET['type']? $_GET['type']:'flat_report';
			if(empty($st)){$err.='Please Enter Start Date';}
			if(empty($en)){$err.='Please Enter End Date';}
			if(empty($err)){
					$st_date = date('Y-m-d', strtotime($st))." 00:00:00";
					$en_date = date('Y-m-d', strtotime($en))." 23:59:59";
			} 
			if(!empty($name)){
				$where[TBL_USER.'.username']= $name;
				$where[TBL_USER.'.first_name']= $name;
				$where[TBL_USER.'.last_name']= $name;
			}
			if($type=='user_report'){
				
				$where[TBL_USER.'.created_at >=']= $st_date;
				$where[TBL_USER.'.created_at <=']= $en_date;
				$report = $this->Db_Model-> get_data(TBL_USER, $where, $order_by = null, $limit = null, $type = 1, $select = '*');
				 
			}
			if($type=='rent_report'){
				 
				$report = $this->Db_Model->getRentReport($st_date, $en_date, $where,TBL_RENT); 
				 
			}
			
			if(!empty($name)){
			$type=='tower_report'?$where[TBL_TOWER.'.tower_name']= $name:$where[TBL_FLAT.'.flat_name']= $name; }
			if($type=='tower_report'){
				$report = $this->Db_Model->getTowerReport($st_date, $en_date, $where,TBL_TOWER); 
				if(!empty($report)){
					foreach($report as &$rep){

						$where_tower = array(TBL_TOWER.'.id'=>$rep['id']);
						$where_flat = 'SUM(monthly_rent.amount) AS total_amount';
						$rep['flat_total'] =  strval(count($this->Db_Model->get_all_flat_and_tower($where_tower))); 
						$rep['tower_earning'] =  strval(($this->Db_Model->get_tower_revenue($where_flat,TBL_RENT,$rep['id']))); 
					}

				}
			}
			if($type=='flat_report'){
				$report = $this->Db_Model->getFlatsReport($st_date, $en_date, $where,TBL_FLAT); 
				if(!empty($report)){ 
					foreach($report as &$rep){

						$where_flat = array(TBL_FLAT.'.flat_id'=>$rep['flat_id']);
						$where_flat = 'SUM(monthly_rent.amount) AS total_amount';
						// $rep['flat_total'] =  strval(count($this->Db_Model->get_all_flat_and_flat($where_flat))); 
						$rep['flat_earning'] =  strval(($this->Db_Model->get_tower_revenue($where_flat,TBL_RENT,$rep['flat_id'],$type='flat'))); 
					}

				}
			} 
			if(empty($report)){
				echo json_encode(['status'=>0,'errors'=>'no record found']);
				exit;
			} 
			echo json_encode(['report' => $report]);
			exit;
			// $this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		 
	}
	public function book_tower()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('tower', 'Tower Name', 'required');

			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
			} else {
				// print_r($_POST);
				$data = array(
					'tower_name' => $_POST['tower'],
					'owner_id' => $_POST['role'] ? $_POST['role'] : $_SESSION['user_id'],

				);

				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_TOWER, $data);

				print json_encode(['status' => 'susscess', 'message' => 'Tower Registered successfully', 'data' => $user_id]);
				return;
			}
		} else {

			$users = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);

			$this->load->view('tower/book_tower', ['users' => $users]);
		}
	}
	public function book_tower_ajax()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('tower', 'Tower Name', 'required');

			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
				exit;
			} else {
				// print_r($_POST);
				$data = array(
					'tower_name' => $_POST['tower'],
					'owner_id' => $_POST['owner'] ? $_POST['owner'] : $_SESSION['user_id'],
					'id' => (isset($_POST['edit_tower_id'])&&!empty($_POST['edit_tower_id'])) ? $_POST['edit_tower_id'] : '',

				);

				if (isset($_POST['edit_tower_id'])&&!empty($_POST['edit_tower_id'])) {
					// Save to database using the model
					$user_id = $this->Db_Model->update_data(TBL_TOWER, $data, $where = array('id' => $_POST['edit_tower_id']));
					print json_encode(['status' => 'success', 'message' => 'Tower Updated successfully', 'data' => $user_id]);
					return;
					exit;
				}
				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_TOWER, $data);

				print json_encode(['status' => 'success', 'message' => 'Tower Registered successfully', 'data' => $user_id]);
				return;
				exit;
			}
		} else {

			$users = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			echo json_encode($users);
			exit;
			$this->load->view('tower/book_tower', ['users' => $users]);
		}
	}
	public function register_flat()
	{
		// $where = array(
		// 	'status' => '1'
		// );
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);
			// print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = 'status = 1';
			$data['flats'] = $this->Db_Model->get_data(TBL_FLAT, $where, '', '', $type = 1);
			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function edit_flat_ajax()
	{
		$flat_id = $_POST['id'];
		$where = 'flat_id = ' . $flat_id;
		$data['flats'] = $this->Db_Model->get_data(TBL_FLAT, $where, '', '', $type = 1)[0];

		$data['user_list'] = $this->Db_Model->get_data(TBL_USER, '', '', '', $type = 1, 'user_id,first_name,last_name');
		$data['towers_list'] = $this->Db_Model->get_data(TBL_TOWER, '', '', '', $type = 1, 'id,tower_name');
		echo json_encode($data);
		exit;
	}
	public function delete_flat_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// print_r($_POST);
			if (isset($_POST['del_id'])) {

				$where = array(
					'flat_id' => $_POST['del_id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->delete_data(TBL_FLAT, $where);
				$where = 'owner_id=' . $_SESSION['user_id'];
				$data['flats'] = $this->Db_Model->get_flat_and_tower();
				// $data['users'] = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
				$data['current_user'] = $_SESSION['user_id'];
				print json_encode(['status' => 'success', 'message' => 'Flat Deleted Successfully', 'data' => $data]);
			}
		}
	}
	public function delete_tower_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// print_r($_POST);
			if (isset($_POST['del_id'])) {

				$where = array(
					'id' => $_POST['del_id']
				);
				// Save to database using the model
				$employee = $this->Db_Model->delete_data(TBL_TOWER, $where);
				$where = 'owner_id=' . $_SESSION['user_id'];
				// $data['flats'] = $this->Db_Model->get_flat_and_tower();
				$data['towers'] = $this->Db_Model->get_data(TBL_TOWER, $where, '', '', $type = 1);
				$data['current_user'] = $_SESSION['user_id'];
				print json_encode(['status' => 'success', 'message' => 'Tower Deleted Successfully', 'data' => $data]);
			}
		}
	}
	public function get_flats_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo 1;
			exit;
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);
			// print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = 'owner_id=' . $_SESSION['user_id'];
			$data['flats'] = $this->Db_Model->get_flat_and_tower();
			// $data['users'] = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'Avaialable Flats', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function get_all_flats_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo 1;
			exit;
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);
			// print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			// $where = 'owner_id=' . $_SESSION['user_id'];
			$data['flats'] = $this->Db_Model->get_all_flat_and_tower();
			// $data['users'] = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'All Flats', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function get_all_towers_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo 1;
			exit;
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);
			// print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			// $where = 'owner_id=' . $_SESSION['user_id'];
			// $data['flats'] = $this->Db_Model->get_all_flat_and_tower();
			$data['towers'] = $this->Db_Model->get_data(TBL_TOWER, $where = '', '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'All Flats', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function get_towers_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo 1;
			exit;
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);

			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = 'owner_id=' . $_SESSION['user_id'];
			// $data['flats'] = $this->Db_Model->get_flat_and_tower();
			$data['towers'] = $this->Db_Model->get_data(TBL_TOWER, $where, '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'Your Towers', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function edit_tower_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			print_r($_REQUEST);
			echo 1;
			exit;
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);

			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = 'id=' . $_GET['id'];
			// $data['flats'] = $this->Db_Model->get_flat_and_tower();
			$data['towers'] = $this->Db_Model->get_data(TBL_TOWER, $where, '', '', $type = 1)[0];
			$data['users'] = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'Your Towers', 'data' => $data]);
			exit;
		}
	}
	public function checkout_ajax()
	{


		$where = 'flat_id=' . $_GET['id'];
		$date =  date('Y-m-d H:m:s');
		 
		$data=array('booked' => 'no','paid'=>'yes','updated_at'=>$date);
		$data1['status'] = '1';
		$user_id = $this->Db_Model->update_data(TBL_RENT, $data, $where);
		$user_id = $this->Db_Model->update_data(TBL_FLAT, $data1, $where);
		print json_encode(['status' => 'success', 'message' => 'Checked Out Successfully', 'data' => $user_id]);
		exit;
	}
	public function invoice_ajax($tenant_id = '')
	{
		$where = array('tenant_id' => $tenant_id ? $tenant_id : $_SESSION['user_id'], 'booked' => 'no');

		$invoice_data = $this->Db_Model->get_data(TBL_RENT, $where, $order_by = null, $limit = null, $type = 0, $select = '*');

		print json_encode(['status' => 'success', 'message' => 'Your Invoices', 'data' => $invoice_data]);
		exit;
	}
	public function pay_invoice_ajax($tenant_id = '')
	{
		$where = array(
			'id' => $_POST['id']
		);
		$data = array(
			'paid' => 'yes'
		);
		$user_id = $this->Db_Model->update_data(TBL_RENT, $data, $where);


		print json_encode(['status' => 'success', 'message' => 'Thanks For Paying', 'data' => $user_id]);
		exit;
	}
	public function book_flat_ajax()
	{
		// $where = array(
		// 	'status' => '1'
		// );
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = array(
				'flat_id' => $_POST['flatId'],
			);
			$flatData = $this->Db_Model->get_data(TBL_FLAT, $where = $data, $order_by = null, $limit = null, $type = 1);
			// print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$where = array(
				'flat_id' => $_POST['flatId']
			);
			$data = array(
				'status' => '2'
			);
			$user_id = $this->Db_Model->update_data(TBL_FLAT, $data, $where);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = 'status = 1';
			$data['flats'] = $this->Db_Model->get_data(TBL_FLAT, $where, '', '', $type = 1);
			$data['users'] = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
			$data['current_user'] = $_SESSION['user_id'];
			print json_encode(['status' => 'success', 'message' => 'Avaialable Flats', 'data' => $data]);
			exit;
			$this->load->view('flat/flats', $data);
		}
	}
	public function user()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
			} else {
				$password = $this->input->post('password');
				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
				// print_r($_POST);
				$data = array(
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'username' => $_POST['first_name'] . $_POST['last_name'],
					'email' => $_POST['email'],
					'password' => $hashedPassword,
					'contact_no' => $_POST['contact_no'],
					'plainPassword' => $_POST['password'],
					'type' => $_POST['role'],
				);

				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_USER, $data);

				echo json_encode(['status' => 'susscess', 'message' => 'User Registered successfully', 'data' => $user_id]);
				return;
			}
		} else {

			// $users = $this->Db_Model->get_data(TBL_USER, $type = 1);
			$data['users'] = $this->Db_Model->get_data(TBL_USER, '', '', '', $type = 1);

			$this->load->view('user/user', $data);
		}
	}
	public function user_ajax()
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('role', 'Role', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				return;
			} else {
				$password = $this->input->post('password');
				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
				// print_r($_POST);
				$data = array(
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'username' => $_POST['first_name'] . $_POST['last_name'],
					'email' => $_POST['email'],
					'password' => $hashedPassword,
					'contact_no' => $_POST['contact_no'],
					'plainPassword' => $_POST['password'],
					'type' => $_POST['role'],
				);
				// print_r($data);
				// exit;
				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_USER, $data);

				echo json_encode(['status' => 'success', 'message' => 'User Registered successfully', 'data' => $user_id]);
				exit;
			}
		} else {

			// $users = $this->Db_Model->get_data(TBL_USER, $type = 1);
			$data['users'] = $this->Db_Model->get_data(TBL_USER, '', '', '', $type = 1);
			echo json_encode($data);
			exit;
		}
	}
	public function user_ajax2()
	{
		echo json_encode($_REQUEST);
		exit;
	}
	public function profile()
	{
		// print_r($_SESSION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$first_name = $_REQUEST['first_name'];
			$last_name = $_REQUEST['last_name'];
			$contact_number = $_REQUEST['contactno'];
			$email = $_REQUEST['email'];
			$confirm_password = $_REQUEST['confirm_password'];
			// print_r($_FILES);
			// exit;
			$img = 'assets/uploads/' . $this->uploadImage($_FILES)['file_name'];




			$ret = $this->validateForm();

			if ($ret == 1) {
				$hashedPassword = password_hash($confirm_password, PASSWORD_BCRYPT);
				if ($img) {

					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'contact_no' => $contact_number,
						'profile_img' => $img,
						'password' => $hashedPassword, // Hash the password
						'plainPassword' => $confirm_password, // Hash the password
					);
				} else {
					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'contact_no' => $contact_number,

						'password' => $hashedPassword, // Hash the password
						'plainPassword' => $confirm_password, // Hash the password
					);
				}

				$where = array('user_id' => $_SESSION['user_id']);


				// Save to database using the model
				$user_id = $this->Db_Model->update_data(TBL_USER, $data, $where);


				if ($user_id) {

					// $this->load->library('session');
					// $this->session->set_userdata('user_id', $user_id);
					// $this->session->set_userdata('first_name', $first_name);
					// $this->session->set_userdata('last_name', $last_name);
					if ($img) {
						$this->session->set_userdata('profile_pic', $img);
					}
					// $this->session->set_userdata('role', $role);
					// print_r($_SESSION);

					print json_encode(['status' => 'success', 'message' => 'Updated']);
					return;
				}
			}
		} else {
			$data = $this->Db_Model->getCurrentUser(TBL_USER, array('user_id' => $_SESSION['user_id']));

			$this->load->view('profile/profile', $data);
		}
	}
	public function profile_ajax()
	{
		// print_r($_SESSION);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// echo '<pre/>';

			$first_name = $_REQUEST['first_name'];
			$last_name = $_REQUEST['last_name'];
			$contact_number = $_REQUEST['contactno'];
			$email = $_REQUEST['email'];
			$confirm_password = $_REQUEST['confirm_password'];

			$img = 'assets/uploads/' . $this->profileUploadImage($_FILES)['file_name'];




			$ret = $this->validateForm();

			if ($ret == 1) {
				$hashedPassword = password_hash($confirm_password, PASSWORD_BCRYPT);
				if ($img) {

					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'contact_no' => $contact_number,
						'profile_img' => $img,
						'password' => $hashedPassword, // Hash the password
						'plainPassword' => $confirm_password, // Hash the password
					);
				} else {
					$data = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'contact_no' => $contact_number,

						'password' => $hashedPassword, // Hash the password
						'plainPassword' => $confirm_password, // Hash the password
					);
				}

				$where = array('user_id' => $_SESSION['user_id']);


				// Save to database using the model
				$user_id = $this->Db_Model->update_data(TBL_USER, $data, $where);


				if ($user_id) {

					// $this->load->library('session');
					// $this->session->set_userdata('user_id', $user_id);
					// $this->session->set_userdata('first_name', $first_name);
					// $this->session->set_userdata('last_name', $last_name);
					if ($img) {
						$this->session->set_userdata('profile_pic', $img);
					}
					// $this->session->set_userdata('role', $role);
					// print_r($_SESSION);

					print json_encode(['status' => 'success', 'message' => 'Updated']);
					return;
				}
			}
		} else {
			$data = $this->Db_Model->getCurrentUser(TBL_USER, array('user_id' => $_SESSION['user_id']));
			echo json_encode($data);
			exit;
			$this->load->view('profile/profile', $data);
		}
	}

	public function uploadImage($img)
	{

		$imageData = $this->input->post('image');

		if (!empty($img['name'])) {


			// Decode base64-encoded binary data
			$binaryData = base64_decode($imageData);

			// Save the binary data to a file (you may want to generate a unique filename)
			$directory = $config['upload_path']  =  'assets/uploads/';
			// $config['max_size'] = 12048;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				// File uploaded successfully, you can get file info
				return $this->upload->data();
				// Now $imageData contains information about the uploaded file

			} else {
				// File upload failed, handle errors
				// echo $this->upload->display_errors();
				echo json_encode(['status' => 'img_error', 'errors' => $this->upload->display_errors()]);
				exit;
			}
		}
	}
	public function profileUploadImage($img)
	{

		$imageData = $this->input->post('image');

		if (!empty($img['image'])) {



			// Decode base64-encoded binary data
			$binaryData = base64_decode($imageData);

			// Save the binary data to a file (you may want to generate a unique filename)
			$directory = $config['upload_path']  =  'assets/uploads/';
			// $config['max_size'] = 12048;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				// File uploaded successfully, you can get file info
				return $this->upload->data();
				// Now $imageData contains information about the uploaded file

			} else {
				// File upload failed, handle errors
				// echo $this->upload->display_errors();
				echo json_encode(['status' => 'img_error', 'errors' => $this->upload->display_errors()]);
				exit;
			}
		}
	}

	function isDirExist($folderPath)
	{
		// print_r($folderPath);
		// Check if the folder exists
		if (!is_dir($folderPath)) {
			// Create the folder if it doesn't exist
			if (mkdir($folderPath, 0755, true)) {
				echo 'Folder created successfully.';
			} else {
				echo    'Failed to create folder. Detailed error: ' . error_get_last();
			}
		}
		// else {
		// 	echo 'Folder already exists.';
		// }
	}
	private function saveFileToDatabase($filename)
	{
		// Save file information to your database table
		// Example: $this->your_model->saveFile($filename);
	}
}
