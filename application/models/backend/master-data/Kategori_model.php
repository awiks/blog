<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Kategori model*/

class Kategori_model extends CI_Model
{
	public function get_kategori()
	{
		$query = $this->db->query("SELECT * FROM categories 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('categories', $array);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('categories', 
		                array('sha1(id)' => $id))->row();
	}

	public function update($array,$category_id)
	{
		return $this->db->update('categories',$array,array('id'=>$category_id));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  return $this->db->delete('categories',
   	  	                array('sha1(id)' => $id));
    }
}