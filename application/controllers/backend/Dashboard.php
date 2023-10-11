<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/dashboard_model');
   }

	public function index()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'Dashboard',
			  'count_contacts' => $this->dashboard_model->get_contacts(),
			  'count_visitors' => $this->dashboard_model->get_visitors(),
			  'content' => 'backend/dashboard/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/dashboard/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}


}