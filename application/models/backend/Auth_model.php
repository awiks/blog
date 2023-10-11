<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Auth model*/

class Auth_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_users($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('active','1');

		return $this->db->get()->row();
	}

}