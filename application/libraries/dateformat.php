<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dateformat {

    function format_date($mysql_date)
	{
	  return date("m-d-Y", strtotime($mysql_date));
	}
	
	function offset_date_with_months($num_of_months)
	{
		$date = date("Y-m-d");// current date
		$date = strtotime(date("Y-m-d", strtotime($date)) . " +$num_of_months month");
		
		return date("Y-m-d", $date);
	}

}
