<?php 

class Found_items_model extends CI_Model {

	
	function get_records()
	{
		$q = $this->db->select('found_items.id as id, found_items.item as item, containers.container as container, locations.location as location, found_items.found_date as date')
									->from('found_items')
									->join('containers', 'found_items.container_id = containers.id')
									->join('locations', 'found_items.location_id = locations.id')
									->order_by('found_items.found_date', 'desc');
		
		return $q->get()->result_array();
		
	}
	
	
	function get_record($id)
	{
		
		$q = $this->db->where('found_items.id', $id)
									->select('found_items.id as id, found_items.item as item, containers.id as container, locations.id as location')
									->from('found_items')
									->join('containers', 'found_items.container_id = containers.id')
									->join('locations', 'found_items.location_id = locations.id');
		$data = $q->get()->result_array();
		
		return $data[0];
		
	}
	
	
	function record_exists($id)
	{
		$q = $this->db->where('id', $id)
				      ->select('id')
				      ->from('found_items')
				      ->get();
		if ($q->num_rows() == 0) {
			return false;
		} else {
			return true;
		}
	}
	
	
	function add_record($data)
	{
		$this->db->set('found_date', 'NOW()', FALSE); 
		$this->db->set('expiration', 'NOW()', FALSE);
		$this->db->insert('found_items', $data);
		
		// For jQuery to add new row
		echo $this->db->insert_id();
	}
	
	function update_record($id, $data)
	{
		$this->db->set('edit_date', 'NOW()', FALSE); 
		$this->db->where('id', $id);
		$this->db->update('found_items', $data);
	}
	
	function delete_record($id)
	{
	 	$this->db->where('id', $id);
	 	$this->db->delete('found_items'); 
	}

}