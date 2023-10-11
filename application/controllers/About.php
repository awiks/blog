<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

  public function __construct()
  {
  	parent ::__construct();
  	$this->load->model('public/about_model');
    $this->load->model('public/visitor_model');
  }
 
  public function index()
  {

    $url = current_url();
    $this->visitor_model->insert_visitor($url);

  	$this->load->view('template/public/index',[
      'title' => 'About',
      'result' => $this->about_model->get_about(),
      'content' => 'public/about/index',
    ]);
  }

}