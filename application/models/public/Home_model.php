<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: Kasnawi
   Class Name 	: Home Model*/

class Home_model extends CI_Model
{
   public function get_slider()
   {
		$this->db->select('a.title,a.slug as slug_a,a.content,a.images,c.slug as slug_c');
		$this->db->from('articles a');
		$this->db->join('categories c','a.category_id=c.id');
		$this->db->where('a.setting_slider','1');
		$this->db->where('a.status_publish','1');
		$this->db->order_by('a.id','ASC');
		return $this->db->get()->result();
   }

   public function get_artikel($request)
   {

		if ( $request > 0 ) {

		  $query = $this->db->query("SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id 
		  	                         FROM articles a 
		  	                         JOIN categories c ON a.category_id=c.id
		  	                         JOIN users u ON a.user_id=u.id
		  	                         WHERE a.status_publish='1' AND 
		  	                         a.id < '$request' ORDER BY a.id DESC
		  	                         LIMIT 12");
		  $result = $query->result();

      }else {
         $query = $this->db->query("SELECT a.title,a.slug as slug_a,a.images,c.slug as slug_c,u.name,u.slug as slug_u,c.categorys_name,a.id
		  	                         FROM articles a 
		  	                         JOIN categories c ON a.category_id=c.id
		  	                         JOIN users u ON a.user_id=u.id
		  	                         WHERE a.status_publish='1' ORDER BY a.id DESC
		  	                         LIMIT 12");
		  $result = $query->result();
      }

		return $result;
   }

   public function artikel_kategori()
   {
      $query = $this->db->query("SELECT c.id,c.categorys_name,c.slug AS slug_c
                                 FROM articles a 
                                 JOIN categories c ON a.category_id=c.id
                                 GROUP BY a.category_id
                                 ORDER BY a.id DESC");

      return $query->result();
   }
   
}