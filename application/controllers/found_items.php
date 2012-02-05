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
		
		//$this->prowl->send('Bryan Jenkins', 'Bryan Jenkins just returned CJs lost Pants to Cory Ehrenberg');
		$this->load->view('found_items_view', $data);
	}
	
	function found_items_ajax_listener()
	{
		$this->load->helper('datatables');
		$this->datatables->select('found_items.id as id, found_items.item as item, containers.container as container, locations.location as location, found_items.found_date as date')
					 			->from('found_items')
								->join('containers', 'found_items.container_id = containers.id')
								->join('locations', 'found_items.location_id = locations.id')
	    		  	  ->edit_column('date', '$1', 'dateformat(date)')
					  		->add_column('action', '<button data-controls-modal="return-item-modal" title="Return This Item" data-id="$1" class="btn small return"><img data-controls-modal="return-record-modal" src="images/return.png" alt="return" width="13" height="13" /></button><button data-controls-modal="edit-item-modal" title="Edit This Item"  data-id="$1" class="btn small edit"><img data-controls-modal="edit-record-modal" src="images/edit.png" alt="edit" width="13" height="13" /></button><button data-controls-modal="delete-item-modal" title="Delete This Item"  data-id="$1" class="btn small delete"><img src="images/trash.png" alt="trash" width="10" height="13" /></button>', 'id')
					  		->unset_column('id');
		echo $this->datatables->generate();
	}
	
	function create_found_item()
	{
		$data = array(
			'item' => $this->input->post('add_record_item'),
			'container_id' => $this->input->post('add_record_container'),
			'location_id' => $this->input->post('add_record_location'),
			'user_id' => 1,
			'status_id' => 1
		);
		
		
		$this->found_items_model->add_record($data);		
		
	}
	
	function update_found_item()
	{
		$id = $this->input->post('edit_record_id');
		
		$data = array(
			'item' => $this->input->post('edit_record_item'),
			'container_id' => $this->input->post('edit_record_container'),
			'location_id' => $this->input->post('edit_record_location'),
			'last_edit_by' => 1
		);
		
		$this->found_items_model->update_record($id, $data);	
	}
	
	function create_container()
	{
		$data = array(
			'container' => $this->input->post('add_container')
		);
		
		
		$this->containers_model->add_record($data);		
		
	}
	
	function json_get_found_item()
	{
		
		$id = $this->uri->segment(3);
		
		if($this->found_items_model->record_exists($id)) {
			
			echo json_encode($this->found_items_model->get_record($id));
		
		} else {
			
			return false;
		}
	}
	
	function json_containers_list() 
	{
		echo json_encode($this->containers_model->get_containers());
	}
	
	function create_location()
	{
		$data = array(
			'location' => $this->input->post('add_location')
		);
		
		
		$this->locations_model->add_record($data);		
		
	}
	
	function json_locations_list() 
	{
		echo json_encode($this->locations_model->get_locations());
	}
	
	
	/*
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
	*/
	
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