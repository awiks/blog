<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Kontak model*/

class Kontak_model extends CI_Model
{
	public function get_kontak()
	{
		$query = $this->db->query("SELECT * FROM contacts 
			                       ORDER BY id DESC");
		return $query->result();
	}

}