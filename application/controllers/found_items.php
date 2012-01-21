<?php 

class Found_items extends CI_Controller {

	function index()
	{
		$this->load->view('found_items_view');
	}
	
	function create()
	{
		$data = array(
			'item' => $this->input->post('add_record_item'),
			'container_id' => $this->input->post('add_record_container'),
			'location_id' => $this->input->post('add_record_location'),
			'user_id' => 1,
			'status_id' => 3
		);
		
		
		$this->found_items_model->add_record($data);		
		
	}

}