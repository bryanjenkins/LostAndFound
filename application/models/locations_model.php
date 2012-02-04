<?php 

class Locations_model extends CI_Model {

	function get_locations()
	{
		$q = $this->db->select('id, location')
									->from('locations');
		
		return $q->get()->result_array();
	}

	function add_record($data) 
	{
		$this->db->insert('locations', $data);
	}
	
}