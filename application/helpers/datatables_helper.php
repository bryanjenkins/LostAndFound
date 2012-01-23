<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	
if(!function_exists('dateformat')) {
	function dateformat($date) {
		return date("m-d-Y", strtotime($date));
	} 
}	

if(!function_exists('tester')) {
	function tester($text) {
		return $text;
	}
}
if(!function_exists('get_name_by_id_datatables')) {
	function get_name_by_id_datatables($id) {
		$CI =& get_instance();
		return $CI->user_model->get_name_by_id($id);;
	}
}
