<?php 

class Found_items extends CI_Controller {

	function index()
	{
		$this->load->view('found_items_view');
	}
	
	function create()
	{
		$data = array(
			'location' => $this->input->post('item')
		);
		
		$this->found_items_model->add_record($data);		
		
	}

}