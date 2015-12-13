<?php


if ( ! function_exists('get_user'))
{
	function get_user ($id)
	{
		$CI = get_instance();
		$CI->load->database();
		$query = $CI->db->get_where('user',array('id'=>$id));
		 
		 return $row = $query->row();
		 
		 
	}
}
