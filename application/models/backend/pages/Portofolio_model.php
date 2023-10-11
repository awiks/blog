<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Portofolio model*/

class Portofolio_model extends CI_Model
{
	public function get_portofolios()
	{
		$query = $this->db->query("SELECT * FROM portofolios 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('portofolios', $array);
	}

	public function edit($slug)
	{
	  return $this->db->get_where('portofolios', array('slug' => $slug))->row();
	}

	public function update($array,$about_id)
	{
		return $this->db->update('portofolios',$array,array('id'=>$about_id));
	}

	public function delete()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  
	  $query  = $this->db->query("SELECT images FROM portofolios WHERE id='$id'");
	  $rows   = $query->row();
	  $images = $rows->images;

	  unlink('./storage/'.$images);

   	  return $this->db->delete('portofolios',array('id' => $id));
	}
}