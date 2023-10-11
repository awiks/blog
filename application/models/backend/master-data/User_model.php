<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: User model*/

class User_model extends CI_Model
{
	public function get_user()
	{
		$query = $this->db->query("SELECT * FROM users 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('users', $array);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('users', 
		                array('sha1(id)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->name    = $post['name'];
     $this->slug    = url_title($post['name'],'dash', TRUE);
     $this->active    = $post['active'];
     $this->updated_at = date('Y-m-d H:i:s');
     return $this->db->update('users', $this, 
     	               array('sha1(id)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  return $this->db->delete('users',
   	  	                array('sha1(id)' => $id));
    }
}