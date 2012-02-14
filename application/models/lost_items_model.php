<?php 

class Lost_items_model extends CI_Model {

	
	function get_records()
	{
		$q = $this->db->select('lost_items.id as id, lost_items.item as item, locations.location as location, lost_items.date as date')
									->from('lost_items')
									->join('locations', 'lost_items.location_id = locations.id')
									->order_by('lost_items.date', 'desc');
		
		return $q->get()->result_array();
		
	}
	
	
	function get_record($id)
	{
		
		$q = $this->db->where('lost_items.id', $id)
									->select('lost_items.id as id, lost_items.item as item, locations.id as location, lost_items.name as name, lost_items.phone as phone, lost_items.email as email')
									->from('lost_items')
									->join('locations', 'lost_items.location_id = locations.id');
		$data = $q->get()->result_array();
		
		return $data[0];
		
	}
	
	
	function record_exists($id)
	{
		$q = $this->db->where('id', $id)
				      ->select('id')
				      ->from('lost_items')
				      ->get();
		if ($q->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	
	function add_record($data)
	{
		$expirationDate = $this->dateformat->offset_date_with_months(3);
		
		$this->db->set('date', 'NOW()', FALSE); 
		$this->db->set('expiration', $expirationDate);
		$this->db->insert('lost_items', $data);
		
		// For jQuery to add new row
		//echo $this->db->insert_id();
	}
	
	function update_record($id, $data)
	{
		$this->db->set('edit_date', 'NOW()', FALSE); 
		$this->db->where('id', $id);
		$this->db->update('lost_items', $data);
	}
	
	function return_record($id, $data)
	{
		$this->db->set('returned_date', 'NOW()', FALSE); 
		$this->db->where('id', $id);
		$this->db->update('lost_items', $data);
	}
	
	function delete_record($id)
	{
	 	$this->db->where('id', $id);
	 	$this->db->delete('lost_items'); 
	}

}