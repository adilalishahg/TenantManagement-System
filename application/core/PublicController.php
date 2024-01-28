<?php

// application/core/MY_Controller.php

class PublicController	 extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Your global functions or methods go here
		$this->load_common_data();
		$this->load->library('form_validation');
		$this->load->library('session');

		// Check if the user is not logged in, redirect to the login page
		if ($this->session->has_userdata('user_id')) {
			redirect('default_controller'); // Adjust the login route accordingly
		}
	}

	// Example of a global function
	protected function load_common_data()
	{
		// Load common data or perform tasks needed for all controllers
		$this->load->model('Db_Model');
		// $this->data['common_variable'] = 'This is a common variable';
	}
}
