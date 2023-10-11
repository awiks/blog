<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Dashboard model*/

class Dashboard_model extends CI_Model
{
	public function get_about()
	{
		$query = $this->db->query("SELECT * FROM abouts
			WHERE status='1' ORDER BY id DESC");
		return $query->result();
	}

	public function get_visitors()
	{
		$query = $this->db->query("SELECT * FROM visitors");

		return $query->result();
	}

	public function get_contacts()
	{
		$query = $this->db->query("SELECT * FROM contacts");

		return $query->result();
	}
}