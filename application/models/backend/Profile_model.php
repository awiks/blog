<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Profile model*/

class Profile_model extends CI_Model
{
	public function get_profile()
	{
		$query = $this->db->query("SELECT p.*,u.name FROM profiles p
			                       JOIN users u ON p.user_id=u.id
			                       ORDER BY p.id DESC");
		return $query->result();
	}

	public function get_users()
	{
		$query = $this->db->query("SELECT * FROM users WHERE active='1' 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('profiles', $array);
	}

	public function edit($slug)
	{
	  return $this->db->get_where('profiles', array('slug' => $slug))->row();
	}

	public function update($array,$profile_id)
	{
		return $this->db->update('profiles',$array,array('id'=>$profile_id));
	}

	public function delete()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  
	  $query  = $this->db->query("SELECT image FROM profiles WHERE id='$id'");
	  $rows   = $query->row();
	  $images = $rows->image;

	  unlink('./storage/'.$images);

   	  return $this->db->delete('profiles',array('id' => $id));
	}
}