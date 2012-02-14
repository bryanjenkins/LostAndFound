<?php 

class Users_model extends CI_Model {

	function validate($username, $password)
	{
		$q = $this
					->db
					->where('username', $username)
					->where('password', sha1($password))
					->limit(1)
					->get('users');
		
		if ( $q->num_rows() == 1 ) 
		{
			//This User Exists
			return $q->row_array();
		}
	}
}