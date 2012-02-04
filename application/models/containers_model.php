<?php 

class Containers_model extends CI_Model {

	function get_containers()
	{
		$q = $this->db->select('id, container')
									->from('containers');
		
		return $q->get()->result_array();
	}
	
	function add_record($data) 
	{
		$this->db->insert('containers', $data);
	}
	
}