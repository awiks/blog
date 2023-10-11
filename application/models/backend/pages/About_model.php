<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: About model*/

class About_model extends CI_Model
{
	public function get_abouts()
	{
		$query = $this->db->query("SELECT * FROM abouts 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('abouts', $array);
	}

	public function edit($slug)
	{
	  return $this->db->get_where('abouts', array('slug' => $slug))->row();
	}

	public function update($array,$about_id)
	{
		return $this->db->update('abouts',$array,array('id'=>$about_id));
	}

	public function delete()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  
	  $query  = $this->db->query("SELECT images FROM abouts WHERE id='$id'");
	  $rows   = $query->row();
	  $images = $rows->images;

	  unlink('./storage/'.$images);

   	  return $this->db->delete('abouts',array('id' => $id));
	}
}