<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('public/author_model');
		$this->load->model('public/visitor_model');
	}

	public function index($slug)
	{
		$profile = $this->author_model->get_author($slug);
        if( !$profile )show_404();

        $url = current_url();
        $this->visitor_model->insert_visitor($url);

		$this->load->view('template/public/index',[
			'title' => 'Author',
			'profile' => $profile,
			'content' => 'public/author/index',
		]);
	}

}