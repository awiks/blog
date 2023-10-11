<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Artikel model*/

class Artikel_model extends CI_Model
{

	public function get_article($limit, $start)
	{
		$query = "SELECT a.id,a.title,a.slug as slug_a,a.images,c.slug as slug_c,
		          u.name,u.slug as slug_u,c.categorys_name,a.id,a.status_publish,a.random_id
                  FROM articles a 
                  JOIN categories c ON a.category_id=c.id
                  JOIN users u ON a.user_id=u.id
                  ORDER BY a.id DESC LIMIT ".$start.",".$limit."";
		return $this->db->query($query);
	}

	public function total_rows()
	{
		$query = $this->db->query("SELECT * FROM articles");
		return $query->num_rows();
	}

	public function get_tag()
	{
		$query = $this->db->query("SELECT * FROM tags 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function get_category()
	{
		$query = $this->db->query("SELECT * FROM categories 
			                       ORDER BY id DESC");
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
		return $this->db->insert('articles', $array);
	}

	public function insert_detail_tag($array)
	{
		return $this->db->insert('tag_details', $array);
	}

	public function get_show($random_string)
	{
		$query = $this->db->query("SELECT a.*,u.name,c.categorys_name FROM articles a
							       JOIN users u ON a.user_id=u.id
							       JOIN categories c ON a.category_id=c.id 
			                       WHERE random_id='$random_string'");

		return $query->row();
	}

	public function get_show_tags($random_string)
	{
		$query = $this->db->query("SELECT t.*,td.tag_id FROM tag_details td
			                       JOIN tags t ON td.tag_id=t.id
			                       JOIN articles a ON td.article_id=a.id
			                       WHERE a.random_id='$random_string'");

		return $query->result();
	}

	public function edit($random_string)
	{
	  if(empty($random_string)) show_404();
	  return $this->db->get_where('articles', 
		                array('random_id' => $random_string))->row();
	}

	public function update($array,$article_id)
	{
		return $this->db->update('articles',$array,array('id'=>$article_id));
	}

	public function delete_tags($article_id)
	{
		return $this->db->delete('tag_details',array('article_id'=>$article_id));
	}

	public function delete()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  
	  $query  = $this->db->query("SELECT images FROM articles WHERE id='$id'");
	  $rows   = $query->row();
	  $images = $rows->images;

	  unlink('./storage/900/'.$images);
	  unlink('./storage/300/'.$images);

	  $this->db->delete('tag_details',array('article_id'=>$id));

   	  return $this->db->delete('articles',array('id' => $id));
	}
}