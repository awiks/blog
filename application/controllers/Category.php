<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('public/category_model');
		$this->load->model('public/visitor_model');
	}

	public function index()
	{
		$url = current_url();
        $this->visitor_model->insert_visitor($url);

		$this->load->view('template/public/index',[
			'title' => 'Author',
			'category' => $this->category_model->get_category(),
			'content' => 'public/category/index',
		]);
	}
}