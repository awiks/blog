<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Category Model*/

class Category_model extends CI_Model
{
	public function get_category()
	{
		$query = $this->db->query("SELECT * FROM categories
                                   ORDER BY id ASC");
		return $query->result();
	}

}