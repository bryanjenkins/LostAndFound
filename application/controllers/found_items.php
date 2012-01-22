<?php 

class Found_items extends CI_Controller {

	function index()
	{
		$data['found_items'] = $this->found_items_model->get_records();
		$data['num_found_items'] = count($data['found_items']);
		
		//Format Dates From xxxx:xx:xx xx:xx:xx To dd/mm/yyyy
		for ($i = 0; $i < $data['num_found_items']; $i++) {
			$date = $data['found_items'][$i]['date'];
			$data['found_items'][$i]['date'] = $this->dateformat->format_date($date);
		}
		
		$this->load->view('found_items_view', $data);
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