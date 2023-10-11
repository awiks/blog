<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: About Model*/

class About_model extends CI_Model
{
	public function get_about()
	{
		$query = $this->db->query("SELECT * FROM abouts
			WHERE status='1' ORDER BY id DESC");
		return $query->result();
	}

}