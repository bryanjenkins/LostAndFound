<?php 

class Found_items_model extends CI_Model {

	function get_records()
	{
		$q = $this->db->get('found_items');
		return $q->result();
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
		$this->db->insert('locations', $data);
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