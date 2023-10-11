<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portofolio extends CI_Controller {

  public function __construct()
  {
  	parent ::__construct();
  	$this->load->model('public/portofolio_model');
    $this->load->model('public/visitor_model');
  }
 
  public function index()
  {
    $url = current_url();
    $this->visitor_model->insert_visitor($url);

  	$this->load->view('template/public/index',[
      'result' => $this->portofolio_model->get_portofolio(),
      'title' => 'Portofolio',
      'content' => 'public/portofolio/index'
    ]);
  }

}