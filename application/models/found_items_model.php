<?php 

class Found_items_model extends CI_Model {

	function get_records()
	{
		$q = $this->db->select('found_items.id as id, found_items.item as item, containers.container as container, locations.location as location, found_items.found_date as date')
									->from('found_items')
									->join('containers', 'found_items.container_id = containers.id')
									->join('locations', 'found_items.location_id = locations.id');
		
		return $q->get()->result_array();
		
	}
	
	function get_record($id)
	{
		/*
$q = $this->db->where('id', $id)
									->select('')
*/
		
	}
	/*
function add_record($data)
	{
		$this->db->set('found_date', 'NOW()', FALSE);
		$this->db->set('found_date', 'NOW()', FALSE);
		$this->db->set('expiration', 'NOW()', FALSE);
		$this->db->insert('found_items', $data);
	}
*/

	/*
function add_record()
	{
		
		$this->db->set('item', 'Black iPhone 4s', FALSE);
		$this->db->set('container_id', 2, FALSE);
		$this->db->set('location_id', 1, FALSE);
		$this->db->set('user_id', 1, FALSE);
		$this->db->set('found_date', '2012-01-16 18:00:32', FALSE);
		$this->db->set('expiration', '2012-01-16 18:00:32', FALSE);
		$this->db->set('status_id', 1, FALSE);
		$this->db->insert('found_items');
	}
*/

function add_record($data)
	{
		$this->db->set('found_date', 'NOW()', FALSE); 
		$this->db->set('expiration', 'NOW()', FALSE);
		$this->db->insert('found_items', $data);
		
		// For jQuery to add new row
		echo $this->db->insert_id();
	}
	/*
function update_record($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('found_items', $data);
	}
	
	function delete_record()
	{
	 	//$this->db->where('id', $this->uri->segment(3));
	 	$this-db->delete('found_items');
	}
*/

}