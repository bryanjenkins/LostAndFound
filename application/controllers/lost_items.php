<?php 

class Lost_items extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();

		if (!isset($_SESSION['id'])) {
			redirect('login');
		}

	}
	
	function index()
	{
		$data['lost_items'] = $this->lost_items_model->get_records();
		$data['num_lost_items'] = count($data['lost_items']);
		$data['name'] = $_SESSION['name'];
		
		//Format Dates From xxxx:xx:xx xx:xx:xx To dd/mm/yyyy
		for ($i = 0; $i < $data['num_lost_items']; $i++) {
			$date = $data['lost_items'][$i]['date'];
			$data['lost_items'][$i]['date'] = $this->dateformat->format_date($date);
		}
		
		//$this->prowl->send('Bryan Jenkins', 'Bryan Jenkins just returned CJs lost Pants to Cory Ehrenberg');
		$this->load->view('lost_items_view', $data);
	}
	
	function lost_items_ajax_listener()
	{
		
		$today = date("Y-m-d h:i:s");
		$this->load->helper('datatables');
		$this->datatables->where('lost_items.status_id', 1)
								->where('lost_items.expiration >', $today)
								->select('lost_items.id as id, lost_items.item as item, locations.location as location, lost_items.name as name, lost_items.phone as phone, lost_items.date as date')
					 			->from('lost_items')
								->join('locations', 'lost_items.location_id = locations.id')
	    		  	  ->edit_column('date', '$1', 'dateformat(date)')
					  		->add_column('action', '<button title="Return This Item" data-id="$1" data-name="$2" class="btn small return"><img src="http://localhost:8888/ucf_lostandfound/images/return.png" alt="return" width="13" height="13" /></button><button data-controls-modal="edit-item-modal" title="Edit This Item"  data-id="$1" class="btn small edit"><img data-controls-modal="edit-record-modal" src="http://localhost:8888/ucf_lostandfound/images/edit.png" alt="edit" width="13" height="13" /></button><button data-controls-modal="delete-item-modal" title="Delete This Item"  data-id="$1" data-name="$2" class="btn small delete"><img src="http://localhost:8888/ucf_lostandfound/images/trash.png" alt="trash" width="10" height="13" /></button>', 'id, item')
					  		->unset_column('id');
		echo $this->datatables->generate();
	}
	
	function returned_lost_items_ajax_listener()
	{
		$this->load->helper('datatables');
		$this->datatables->where('lost_items.status_id', 2)
								->select('lost_items.id as id, lost_items.item as item, lost_items.name as name, lost_items.phone as phone, users.name as user, lost_items.returned_date as date')
					 			->from('lost_items')
								->join('users', 'lost_items.user_id = users.id')
	    		  	  ->edit_column('date', '$1', 'dateformat(date)')
	    		  	  ->unset_column('id');
		echo $this->datatables->generate();
	}
	
	function expired_lost_items_ajax_listener()
	{
		$today = date("Y-m-d h:i:s");
		$this->load->helper('datatables');
		$this->datatables->where('lost_items.expiration <', $today)
								->where('lost_items.status_id', 1)
								->select('lost_items.id as id, lost_items.item as item, locations.location as location, lost_items.name as name, lost_items.phone as phone, lost_items.expiration as expiration')
					 			->from('lost_items')
								->join('locations', 'lost_items.location_id = locations.id')
	    		  	  ->edit_column('date', '$1', 'dateformat(date)')
	    		  	  ->edit_column('expiration', '$1', 'dateformat(expiration)')
					  		->unset_column('id');
		echo $this->datatables->generate();
	}
	
	function create_lost_item()
	{
		//Format Phone
		$phone = $this->input->post('add_record_phone');
		$phone = $this->phone->format_phone($phone);
		
		$data = array(
			'item' => $this->input->post('add_record_item'),
			'location_id' => $this->input->post('add_record_location'),
			'name' => $this->input->post('add_record_name'),
			'phone' => $phone,
			'email' => $this->input->post('add_record_email'),
			'user_id' => 1,
			'status_id' => 1
		);
		
		
		$this->lost_items_model->add_record($data);		
		
	}
	
	function update_lost_item()
	{
		$id = $this->input->post('edit_record_id');
		
		//Format Phone
		$phone = $this->input->post('edit_record_phone');
		$phone = $this->phone->format_phone($phone);
		
		$data = array(
			'item' => $this->input->post('edit_record_item'),
			'location_id' => $this->input->post('edit_record_location'),
			'name' => $this->input->post('edit_record_name'),
			'phone' => $phone,
			'email' => $this->input->post('edit_record_email'),
			'last_edit_by' => 1
		);
				
		$this->lost_items_model->update_record($id, $data);	
	}
	
	function return_lost_item()
	{
		$id = $this->uri->segment(3);
		
		if($this->lost_items_model->record_exists($id)) {
				
			$data = array(
				'returned_by' => 1,
				'status_id' => 2
			);
				
			$this->lost_items_model->return_record($id, $data);	
		} else {

			//Set session update to let people know the record doesn't exist
			redirect('/lost_items/', 'refresh');
		}
		
	}
	
	function create_container()
	{
		$data = array(
			'container' => $this->input->post('add_container')
		);
		
		
		$this->containers_model->add_record($data);		
		
	}
	
	function json_get_lost_item()
	{
		
		$id = $this->uri->segment(3);
		
		if($this->lost_items_model->record_exists($id)) {
			
			echo json_encode($this->lost_items_model->get_record($id));
		
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
		if($this->lost_items_model->record_exists($id)) 
		{
			$record = $this->lost_items_model->get_record($id);
			
			$record['date'] = $this->dateformat->format_date($record['date']);
			
			echo json_encode($record);
		}
		
		else
		{
			//Set session update to let people know the record doesn't exist
			redirect('/lost_items/', 'refresh');
		}
		
		

	}
	*/
	
	function delete()
	{
		$id = $this->uri->segment(3);
		
		if($this->lost_items_model->record_exists($id)) 
		{
			
			if( $this->lost_items_model->delete_record($id) ) {
				
				echo "Record Successfully Deleted";
			
			} else {
				
				echo "There was a problem. Please refresh and try again.";
			
			}
		}
		
		else
		{
			//Set session update to let people know the record doesn't exist
			redirect('/lost_items/', 'refresh');
		}
	}
	
	function logout()
	{
		session_destroy();
		redirect('login');
	}

}