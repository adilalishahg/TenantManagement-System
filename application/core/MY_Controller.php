<?php

// application/core/MY_Controller.php

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Your global functions or methods go here
		$this->load_common_data();
		$this->load->library('form_validation');

		// Check if the user is not logged in, redirect to the login page
		// if (!$this->session->has_userdata('user_id')) {
		// 	redirect('login'); // Adjust the login route accordingly
		// }
	}

	// Example of a global function
	protected function load_common_data()
	{
		// Load common data or perform tasks needed for all controllers
		$this->load->model('Db_Model');
		// $this->data['common_variable'] = 'This is a common variable';
	}
	// Function to get the referring URL

	protected function get_referer()
	{
		return ($this->agent->is_referral()) ? $this->agent->referrer() : '/';
	}
	public function validate_form($page)
	{
		// print_r($_POST);
		// exit;
		// Set validation rules
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		if ($page != 'login') {
			$email_rule = 'required|valid_email|trim|is_unique[tbl_users.email]';
			// $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('contactno', 'Contact Number', 'numeric');
			// $this->form_validation->set_rules('role', 'Role', 'required|in_list[1,2,3]');
			if ($page == 'register') {

				$this->form_validation->set_rules('role', 'Role', 'required|in_list[1,2,3]', array('required' => 'The %s field is required.', 'in_list' => 'Please Select Role of User.'));
			}
			// Set custom error messages (optional)

			$this->form_validation->set_message('matches', 'The Confirm Password field does not match the Password field.');
		} else {
			$email_rule = 'required|valid_email|trim';
		}

		$this->form_validation->set_rules('email', 'Email', $email_rule);
		// Run validation
		if ($this->form_validation->run() == FALSE) {
			if ($page != 'login') {

				$data['first_name'] = set_value('first_name');
				$data['last_name'] = set_value('last_name');
				$data['confirm_password'] = set_value('confirm_password');
				$data['contactno'] = set_value('contactno');
				$data['role'] = set_value('role');
			}
			$data['email'] = set_value('email');
			// Validation failed, reload the form with errors
			$this->load->view($page, $data);
		} else {
			// Validation successful, process the form data

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
			if ($page != 'login') {
				$first_name = $this->input->post('first_name');

				$last_name = $this->input->post('last_name');
				$role = $this->input->post('role');
				$contact_no = $this->input->post('contactno');

				$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email,
					'contact_no' => $contact_no,
					'type' => $role,
					'password' => $hashedPassword, // Hash the password
					'plainPassword' => $password, // Hash the password
				);

				// Save to database using the model
				$user_id = $this->Db_Model->save_data(TBL_USER, $data);

				if ($user_id) {

					$this->load->library('session');
					$this->session->set_userdata('user_id', $user_id);
					$this->session->set_userdata('first_name', $first_name);
					$this->session->set_userdata('last_name', $last_name);
					$this->session->set_userdata('email', $email);
					$this->session->set_userdata('role', $role);
					// print_r($_SESSION);
					redirect('main');
				}
				// print_r($user_id);
				// exit;
			}
			if ($page == 'login') {

				$data = array(
					'email' => $email,
				);

				// Save to database using the model
				$isEmailExist = $this->Db_Model->get_data(TBL_USER, $data);


				if (!$isEmailExist) {

					$error_data['userDoesNotExist'] = "1";
					$error_data['error_message'] = "Email Does Not Exist";
					// print_r($data);

					$this->load->view('login', $error_data);
					return;
				}

				$bcryptedPassword = $this->Db_Model->getHashedPassword($data, TBL_USER);
				// print_r($bcryptedPassword);
				// echo "<br/>";
				// print_r($hashedPassword);
				if (!(password_verify($password, $bcryptedPassword))) {

					$error_data['userDoesNotExist'] = "1";
					$error_data['error_message'] = "Invalid Password! Please Enter Correct One";
					$this->load->view('login', $error_data);
					return;
				}
				// print_r($isEmailExist[0]->user_id);
				// exit;
				$this->load->library('session');
				$this->session->set_userdata('user_id', $isEmailExist[0]->user_id);
				$this->session->set_userdata('first_name', $isEmailExist[0]->first_name);
				$this->session->set_userdata('last_name', $isEmailExist[0]->last_name);
				$this->session->set_userdata('email', $isEmailExist[0]->email);
				$this->session->set_userdata('role', $isEmailExist[0]->type);
				$this->session->set_userdata('profile_pic', $isEmailExist[0]->profile_img);
				redirect('main');

				// print_r($user_id);
				// exit;
			}

			// Perform further actions (e.g., save to database)
			// ...

			// Redirect or display success message
			// redirect('success_page');
		}
	}
	protected function validateForm()
	{
		$this->load->library('form_validation');
		// echo "c";
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_email_unique');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('contactno', 'Contact Number', 'numeric');

		// Run the form validation
		if ($this->form_validation->run() === false) {
			// Form validation failed

			$errors = $this->form_validation->error_array();
			// print_r($errors);
			print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
			return;
		}

		// Form validation passed
		// return json_encode(['status' => 'success', 'message' => 'Validation passed']);
		return 1;
	}
	// Custom callback function
	public function is_email_unique($email)
	{
		$user_id = $this->session->userdata('user_id'); // Get the current user's ID from the session

		// Check if the email is unique, excluding the current user
		if ($this->Db_Model->is_email_unique(TBL_USER, $email, $user_id)) {
			return TRUE; // Email is unique
		} else {
			$this->form_validation->set_message('is_email_unique', 'The {field} must be unique.');
			return FALSE; // Email is not unique
		}
	}
}
