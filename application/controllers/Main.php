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
	public function index()
	{
		// $this->load->view('includes/header');
		// $this->load->view('includes/navbar');
		// $this->load->view('includes/sidebar');
		// print_r($_SESSION);
		// exit;
		// if ($this->session->has_userdata('user_id')) {
		// $rent_data = array(
		// 	'flat_id' => $_POST['flatId'],
		// 	'tenant_id' => $_POST['userId'],
		// 	'amount' => $flatData[0]['rent'],
		// );
		// $users = $this->Db_Model->get_data(TBL_USER, $where = '', '', '', $type = 1);
		if ($_SESSION != '4' || $_SESSION != '5') {
			// Get the current date
			$currentDate = date('Y-m-d');

			// Calculate the date one month ago
			$oneMonthAgo = date('Y-m-d', strtotime('-1 month', strtotime($currentDate)));
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 MONTH)"`;
			$data['total'] = $this->Db_Model->get_data(TBL_RENT, $where, '', '', $type = 1, $select = 'sum(amount) as total')[0]['total'];
			$where = `'created_at >=', "DATE_SUB(NOW(), INTERVAL 1 YEAR)"`;
			$data['year'] = $this->Db_Model->get_data(TBL_RENT, $where, '', '', $type = 1, $select = 'sum(amount) as total')[0]['total'];

			$data['booked'] = $this->Db_Model->get_data(TBL_RENT, $where = '', '', '', $type = 1, $select = 'DISTINCT(flat_id) as booked')[0]['booked'];
			$data['total_flats'] = $this->Db_Model->get_data(TBL_FLAT, $where = '', '', '', $type = 1, $select = 'count(flat_id) as total_flats')[0]['total_flats'];

			$data['ratio'] = ($data['booked'] / $data['total_flats']) * 100;


			$this->load->view('welcome_message', $data);
		}
		// } else {

		// 	$this->load->view('login');
		// }
		// $this->load->view('includes/footer');
	}

	public function logout()
	{
		// Destroy the user's session
		$this->session->sess_destroy();

		// Redirect to the login page
		redirect('login'); // Change 'auth/login' to your actual login route

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
			$this->load->view('flat/book_flat', ['users' => $users, 'towers' => $tower]);
		}
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
			print_r($flatData);
			// Save to database using the model
			$rent_data = array(
				'flat_id' => $_POST['flatId'],
				'tenant_id' => $_POST['userId'],
				'amount' => $flatData[0]['rent'],
			);
			$user_id = $this->Db_Model->save_data(TBL_RENT, $rent_data);

			print json_encode(['status' => 'susscess', 'message' => 'Flat Registered successfully', 'data' => $user_id]);
		} else {

			$where = '';
			$data['flats'] = $this->Db_Model->get_data(TBL_FLAT, $where, '', '', $type = 1);

			$this->load->view('flat/flats', $data);
		}
	}
	public function user()
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

			// $users = $this->Db_Model->get_data(TBL_USER, $type = 1);
			$users = $this->Db_Model->get_data(TBL_USER, '', '', '', $type = 1);

			$this->load->view('user/user');
		}
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
			$img = 'assets/uploads/' . $this->uploadImage()['file_name'];




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

	public function uploadImage()
	{
		$imageData = $this->input->post('image');
		// print_r($imageData);
		// exit;
		if (!empty($_FILES['image']['name'])) {


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


		// Respond with a success message or any other data
		// echo json_encode(['message' => 'Image uploaded successfully', 'path' => $directory]);
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