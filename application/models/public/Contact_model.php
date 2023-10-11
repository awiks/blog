<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

/* Author 		: Kasnawi
   Class Name 	: Contact Model*/

class Contact_model extends CI_Model
{

		public function chapcha()
	{

		$vals = array(
		        
		        'img_path'      => './captcha/',
		        'img_url'       => base_url('captcha'),
		        'img_height' =>'50',
                'expiration' => 7200,
                'word_length'   => 6,
                'font_size'  => 20,
                'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(206, 212, 218, 1),
                'text' => array(0, 0, 0),
                'grid' => array(255, 255, 255)
                )
		);

		$cap =  create_captcha($vals);

		$data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);

		$query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);

		return $cap['image'];
	}

	public function insert($array)
	{
		return $this->db->insert('contacts', $array);
	}

}