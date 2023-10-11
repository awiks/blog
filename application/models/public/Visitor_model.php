<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/* Author 		: Kasnawi
   Class Name 	: Visitor Model*/

class Visitor_model extends CI_Model
{

	public function __construct()
    {
	   parent ::__construct();
	   $this->load->library('user_agent');
    }

	public function insert_visitor($url)
	{
		$ip_address = $this->input->ip_address();
		$browser    = $this->agent();

		$array = array('link_url'=>$url,
			            'ip_address'=>$ip_address,
			            'browser' => $browser,
			            'platform' => $this->agent->platform(),
			            'created_at'=>date('Y-m-d H:i:s'));

		 $cek_ip=$this->db->query("SELECT * FROM visitors WHERE 
		 	                       link_url='$url' AND ip_address='$ip_address' 
		 	                       AND browser='$browser'
		 	                       AND DATE(visit_date)=CURDATE()");
         if($cek_ip->num_rows() === 0){

		   return $this->db->insert('visitors', $array);

		 }
	}


	private function agent()
	{
		if ($this->agent->is_browser())
		{
		    $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		    $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		    $agent = $this->agent->mobile();
		}
		else
		{
		    $agent = 'Other';
		}

		return $agent;
	}

}	