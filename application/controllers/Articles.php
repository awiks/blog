<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('public/articles_model');
        $this->load->model('public/visitor_model');
	}

	public function index()
	{

        $url = current_url();
        $this->visitor_model->insert_visitor($url);

		$config['base_url']    = base_url('articles');
        $config['total_rows']  = $this->articles_model->total_rows();
        $config['per_page']    = 9; 
        $config["uri_segment"] = 2;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
       
        $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data['result'] = $this->articles_model->get_article($config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $data['category'] = $this->articles_model->get_category();
        $data['lates'] = $this->articles_model->get_post_terbaru();
        $data['tag_detail'] = $this->articles_model->get_populer_tag();
		$data['title'] = 'Articles';
		$data['content'] = 'public/articles/index';
		$this->load->view('template/public/index',$data);
	}

	public function show($category,$article)
	{
		$show = $this->articles_model->get_show($category,$article);
		
		if(!$show)show_404();

        $url = current_url();
        $this->visitor_model->insert_visitor($url);

		$this->load->view('template/public/index',[
			 'article_id'=> $show->id,
             'title'=> $show->title,
			 'description'=> $show->description,
			 'author'=> $show->name,
			 'keywords'=> $show->keywords,
			 'contents'=> $show->content,
			 'images'=> $show->images,
			 'slug_a'=> $show->slug_a,
			 'slug_c'=> $show->slug_c,
             'created_at'=> $show->created_at,
             'tags' => $this->articles_model->get_detail_tag($category,$article),
             'comments' => $this->articles_model->get_comments($category,$article),
             'total_comments' => $this->articles_model->total_comments($category,$article),
             'category' => $this->articles_model->get_category(),
             'lates' => $this->articles_model->get_post_terbaru(),
             'tag_detail' => $this->articles_model->get_populer_tag(),
			 'content'=> 'public/articles/show',
             'javascript'=> 'public/articles/javascript'
		]);
	}

    public function comments()
    {
        $name       = $this->security->xss_clean($this->stripHTMLtags($this->input->post('name')));
        $id         = $this->security->xss_clean($this->input->post('article_id'));
        $parent_id  = $this->security->xss_clean($this->input->post('parent_id'));
        $email      = $this->security->xss_clean($this->input->post('email'));
        $comment    = $this->security->xss_clean($this->stripHTMLtags($this->input->post('comment')));
        $created_at = date('Y-m-d H:i:s');
        $ip_address = $this->input->ip_address();

        $rows = $this->db->get_where('articles',array('id'=>$id))->row();
        $article_id = $rows->id;

        $validation = $this->form_validation;
        $validation->set_rules('name','Nama','required|trim');
        $validation->set_rules('email','Email','required|trim|valid_email');
        $validation->set_rules('comment','Pesan','required|trim');

        if ( $validation->run() == TRUE )
        {
            if( $parent_id == '' ){
                $array = array('article_id'=>$article_id,
                               'name'=> $name,
                               'email'=>$email,
                               'comment'=>$comment,
                               'ip_address'=>$ip_address,
                               'created_at'=>$created_at);
            }
            else{
                $array = array('article_id'=>$article_id,
                               'parent_id'=>$parent_id,
                               'name'=> $name,
                               'email'=>$email,
                               'comment'=>$comment,
                               'ip_address'=>$ip_address,
                               'created_at'=>$created_at);
            }

            $this->articles_model->insert_comments($array);

            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

	public function tags($slug=true)
	{

        $url = current_url();
        $this->visitor_model->insert_visitor($url);

	    $config['base_url']    = base_url('articles/tags');
        $config['total_rows']  = $this->articles_model->total_rows_tags($slug);
        $config['per_page']    = 9; 
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
       
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['result'] = $this->articles_model->get_article_tag($slug, $config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $data['category'] = $this->articles_model->get_category();
        $data['lates'] = $this->articles_model->get_post_terbaru();
        $data['tag_detail'] = $this->articles_model->get_populer_tag();
    	$data['title'] = 'Articles';
    	$data['content'] = 'public/articles/tag';
    	$this->load->view('template/public/index',$data);
	}

     public function category($slug=true)
     { 

        $url = current_url();
        $this->visitor_model->insert_visitor($url);

	    $config['base_url']    = base_url('articles/category');
        $config['total_rows']  = $this->articles_model->total_rows_category($slug);
        $config['per_page']    = 9; 
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
       
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['result'] = $this->articles_model->get_article_category($slug, $config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $data['category'] = $this->articles_model->get_category();
        $data['lates'] = $this->articles_model->get_post_terbaru();
        $data['tag_detail'] = $this->articles_model->get_populer_tag();
    	$data['title'] = 'Articles';
    	$data['content'] = 'public/articles/category';
    	$this->load->view('template/public/index',$data);
   }
     
   public function key()
   {
      $url = current_url();
      $this->visitor_model->insert_visitor($url);
      $search = $this->input->get('search');
      $this->load->view('template/public/index',[
        'key' => $search,
        'result' => $this->articles_model->get_search($search)->result(),
        'category' =>$this->articles_model->get_category(), 
        'lates' =>$this->articles_model->get_post_terbaru(), 
        'tag_detail' =>$this->articles_model->get_populer_tag(), 
        'title' => 'Searching...',
        'content' => 'public/home/search'
      ]);
   }

   private function stripHTMLtags($str)
   {
     $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
     $t = htmlentities($t, ENT_QUOTES, "UTF-8");
     return $t;
   }
}