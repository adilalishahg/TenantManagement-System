<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{


	public function __construct()
	{

		parent::__construct();
		if (!$this->session->userdata('email') == '' || !$this->session->userdata('user_id') == '') {
			// echo 'Redirecting to login...';
			// redirect('login');
			// print_r($_SESSION);
			redirect($this->get_referer());
		}
	}
	public function forgot()
	{


		$this->load->view('forgot_password');
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email =  ($_POST['email']);

			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

			// Run the form validation
			if ($this->form_validation->run() === false) {
				// Form validation failed

				$errors = $this->form_validation->error_array();
				// print_r($errors);
				print json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
				exit;
			}
			$this->load->library('email');

			$this->email->from('adilalishahg@gmail.com', 'Adil Ali');
			$this->email->to($email);
			$this->email->subject('Your Subject');
			$this->email->message('Your Message');
			if ($this->email->send()) {
				echo 'Email sent successfully.';
			} else {
				echo 'Error: ' . $this->email->print_debugger();
				exit;
			}
		}
	}
	// Protected method to get the referring URL

	public function login()
	{
		// $this->load->view('includes/header');
		// $this->load->view('includes/navbar');
		// $this->load->view('includes/sidebar'); 

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$this->validate_form('login');
		} else {
			// Handle the case when the form is not submitted
			$this->load->view('login');
		}
		// $this->load->view('includes/footer');
	}
	public function register()
	{


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$this->validate_form('register');
		} else {
			// Handle the case when the form is not submitted
			$this->load->view('register');
		}
	}
}
