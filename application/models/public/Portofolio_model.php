<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Portofolio Model*/

class Portofolio_model extends CI_Model
{
	public function get_portofolio()
	{
		$query = $this->db->query("SELECT * FROM portofolios
			WHERE status='1' ORDER BY id DESC");
		return $query->result();
	}

}