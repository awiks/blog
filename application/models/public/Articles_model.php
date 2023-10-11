<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Articles Model*/

class Articles_model extends CI_Model
{
	public function get_article($limit, $start)
	{
		$query = "SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
                 FROM articles a 
                 JOIN categories c ON a.category_id=c.id
                 JOIN users u ON a.user_id=u.id
                 WHERE a.status_publish='1' 
                 ORDER BY a.id DESC LIMIT ".$start.",".$limit."";
		return $this->db->query($query);
	}

	public function total_rows()
	{
		$query = $this->db->query("SELECT * FROM articles
		          WHERE status_publish='1'");
		return $query->num_rows();
	}

	public function get_category()
	{
		$query = $this->db->query("SELECT * FROM categories 
			                       ORDER BY id DESC");
		return $query->result();
	}

	public function get_post_terbaru()
	{
		$query = $this->db->query("SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
                 FROM articles a 
                 JOIN categories c ON a.category_id=c.id
                 JOIN users u ON a.user_id=u.id
                 WHERE a.status_publish='1' 
                 ORDER BY a.id DESC LIMIT 5");

		return $query->result();
	}

	public function get_populer_tag()
	{
		$query = $this->db->query("SELECT t.* FROM tag_details td
			                       JOIN tags t ON td.tag_id=t.id
			                       GROUP BY td.tag_id");
		return $query->result();
	}

	public function get_show($category,$article)
	{
		$query = $this->db->query("SELECT a.title,a.content,a.description,a.keywords,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.created_at,a.id  FROM articles a 
								   JOIN categories c ON a.category_id=c.id
								   JOIN users u ON a.user_id=u.id
								   WHERE c.slug='$category' AND 
								   a.slug='$article'");
		return $query->row();
	}

	public function insert_comments($array)
	{
		return $this->db->insert('comments', $array);
	}

	public function get_detail_tag($category,$article)
	{
		$query = $this->db->query("SELECT t.* FROM tag_details td 
			                       JOIN tags t ON td.tag_id=t.id
			                       JOIN articles a ON td.article_id=a.id
			                       JOIN categories c ON a.category_id=c.id
			                       WHERE c.slug='$category' 
			                       AND a.slug='$article'");
		return $query->result();
	}

	public function get_comments($category,$article)
	{
		$query = $this->db->query("SELECT cs.* FROM comments cs 
			                       JOIN articles a ON cs.article_id=a.id
			                       JOIN categories c ON a.category_id=c.id
			                       WHERE c.slug='$category' 
			                       AND a.slug='$article'
			                       AND cs.parent_id IS NULL");
		return $query->result();
	}

	public function total_comments($category,$article)
	{
		$query = $this->db->query("SELECT cs.* FROM comments cs 
			                       JOIN articles a ON cs.article_id=a.id
			                       JOIN categories c ON a.category_id=c.id
			                       WHERE c.slug='$category' 
			                       AND a.slug='$article'");
		return $query->result();
	}

	public function get_article_tag($slug, $limit, $start)
	{
		$query = "SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
                  FROM tag_details td
                  JOIN articles a ON td.article_id=a.id
                  JOIN tags t ON td.tag_id=t.id
                  JOIN categories c ON a.category_id=c.id
                  JOIN users u ON a.user_id=u.id
                  WHERE a.status_publish='1'
                  AND t.slug='$slug'
                  ORDER BY a.id DESC LIMIT ".$start.",".$limit."";
		
		return $this->db->query($query);
	}

	public function total_rows_tags($slug)
	{
		$query = $this->db->query("SELECT td.* FROM tag_details td 
			                       JOIN articles a ON td.article_id=a.id
                                   JOIN tags t ON td.tag_id=t.id
		                           WHERE a.status_publish='1'
		                           AND t.slug='$slug'");
		return $query->num_rows();
	}

	public function get_article_category($slug, $limit, $start)
	{
		$query = "SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
                  FROM articles a 
                  JOIN categories c ON a.category_id=c.id
                  JOIN users u ON a.user_id=u.id
                  WHERE a.status_publish='1'
                  AND c.slug='$slug'
                  ORDER BY a.id DESC LIMIT ".$start.",".$limit."";
		
		return $this->db->query($query);
	}

	public function total_rows_category($slug)
	{
		$query = $this->db->query("SELECT a.* FROM articles a 
					               JOIN categories c ON a.category_id=c.id
					               JOIN users u ON a.user_id=u.id
		                           WHERE a.status_publish='1'
		                           AND c.slug='$slug'");
		return $query->num_rows();
	}

   public function get_search($search)
   {
      $query = "SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
                 FROM articles a 
                 JOIN categories c ON a.category_id=c.id
                 JOIN users u ON a.user_id=u.id
                 WHERE a.status_publish='1'
                 AND a.title LIKE '%$search%'
                 ORDER BY a.id DESC";
      return $this->db->query($query);
   }

}