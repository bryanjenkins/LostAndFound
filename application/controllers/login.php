<?php 

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		session_start();
		
		if (isset($_SESSION['is_logged_in'])) {
			redirect('found_items');
		}
	
	}
	
	function index()
	{		
		$this->load->view('login_view');
	}
	
	function validate_credentials()
	{
		$result = $this
						->users_model
						->validate(
							$this->input->post('username'), 
							$this->input->post('password')
						);
		
		if ($result) // They validated their credentials
		{
			$_SESSION['id'] = $result['id'];
			$_SESSION['name'] = $result['name'];
			$_SESSION['role'] = $result['role'];
			$_SESSION['is_logged_in'] = 1;
			
			redirect('found_items');
		} 
		else 
		{
			redirect('login');
		}
	}
}