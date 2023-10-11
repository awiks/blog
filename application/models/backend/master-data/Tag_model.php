<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Tag model*/

class Tag_model extends CI_Model
{
	public function get_tag()
	{
		$query = $this->db->query("SELECT * FROM tags 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function insert($array)
	{
		return $this->db->insert('tags', $array);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tags', 
		                array('sha1(id)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->tags_name    = $post['tags_name'];
     $this->slug    = url_title($post['tags_name'],'dash', TRUE);
     $this->updated_at = date('Y-m-d H:i:s');
     return $this->db->update('tags', $this, 
     	               array('sha1(id)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  return $this->db->delete('tags',
   	  	                array('sha1(id)' => $id));
    }
}