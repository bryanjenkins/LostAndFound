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
		
		//$this->prowl->send('Bryan Jenkins', 'Just returned the iPhone 4s to Jarrod Matosky');
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
	
	function update_table_with_new_record()
	{
		$id = $this->uri->segment(3);
		
		//If the record exists
		if($this->found_items_model->record_exists($id)) 
		{
			$record = $this->found_items_model->get_record($id);
			
			$record['date'] = $this->dateformat->format_date($record['date']);
			
			echo json_encode($record);
		}
		
		else
		{
			//Set session update to let people know the record doesn't exist
			redirect('/found_items/', 'refresh');
		}
		
		
	}
	
	function delete()
	{
		$id = $this->uri->segment(3);
		
		if($this->found_items_model->record_exists($id)) 
		{
			
			if( $this->found_items_model->delete_record($id) ) {
				
				echo "Record Successfully Deleted";
			
			} else {
				
				echo "There was a problem. Please refresh and try again.";
			
			}
		}
		
		else
		{
			//Set session update to let people know the record doesn't exist
			redirect('/found_items/', 'refresh');
		}
	}

}