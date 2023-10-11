<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Author Model*/

class Author_model extends CI_Model
{
	public function get_author($slug)
	{
		$query = $this->db->query("SELECT p.*,u.name FROM profiles p
								   JOIN users u ON p.user_id=u.id
			                       WHERE u.slug='$slug'");
		return $query->row();
	}

}