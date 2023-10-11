<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Artikel extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/pages/artikel_model');
   }

	public function index()
	{
		if ( $this->session->userdata('check_login') == '1' ){

		$config['base_url']    = base_url('cpanel/pages/artikel');
        $config['total_rows']  = $this->artikel_model->total_rows();
        $config['per_page']    = 8; 
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
       
        $page       = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $result     = $this->artikel_model->get_article($config["per_page"], $page)->result();
        $pagination = $this->pagination->create_links();

		$this->load->view('template/backend/index',[
		  'total_artikel' => $this->artikel_model->total_rows(),
		  'page' => $page,
		  'result' => $result,
		  'pagination' => $pagination,
		  'title' => 'Artikel',
		  'content' => 'backend/pages/artikel/index',
		  'modal' => 'template/backend/modal',
		  'javascript' => 'backend/pages/artikel/javascript',
		]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function show($random_string)
	{
		if ( $this->session->userdata('check_login') == '1' ){

			if( !$this->artikel_model->get_show($random_string) ):
				$content = 'template/backend/404';
				$title   ='Not Found';
			else :
				$content = 'backend/pages/artikel/show';
				$title   = 'Show Artikel';
			endif;

			$this->load->view('template/backend/index',[
				'show' => $this->artikel_model->get_show($random_string),
				'tags' => $this->artikel_model->get_show_tags($random_string),
				'title' => $title,
				'content' => $content,
				'modal' => 'template/backend/modal',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}


	public function create()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[articles.title]');
        $this->form_validation->set_rules('user_id', 'Author', 'required|trim');
        $this->form_validation->set_rules('status_publish', 'Status Publish', 'required|trim');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('tag[]', 'Tag', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			if ( $this->session->userdata('check_login') == '1' ){

				$this->load->view('template/backend/index',[
					'title' => 'Artikel',
					'category' => $this->artikel_model->get_category(),
					'users' => $this->artikel_model->get_users(),
					'tag' => $this->artikel_model->get_tag(),
					'content' => 'backend/pages/artikel/create',
					'modal' => 'template/backend/modal',
					'javascript' => 'backend/pages/artikel/javascript',
				]);
			}
		    else{
		     redirect('cpanel/auth');
		    }
        }
        else
        {
        	$config = array(
        		'image_library' => 'gd2',
	            'upload_path' => './storage/900/',
	            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG',
	            'encrypt_name'=>TRUE,
	        );

	        $this->load->library('upload', $config);

        	if ( $this->upload->do_upload('images') ){

        		$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
				$this->resize_image($filename);

				$array = array(
				  'random_id' => random_string('alnum', 100),
		    	  'title' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('title'))),
		    	  'slug' => url_title($this->security->xss_clean($this->stripHTMLtags($this->input->post('title'))),'dash', TRUE),
		    	  'keywords' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('keywords'))),
		    	  'description' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('description'))),
		    	  'user_id' => $this->security->xss_clean($this->input->post('user_id')),
		    	  'content' => $this->input->post('content'),
		    	  'category_id' => $this->security->xss_clean($this->input->post('category_id')),
		    	  'images' => $filename,
		    	  'setting_slider' => $this->security->xss_clean($this->input->post('setting_slider')),
		    	  'status_publish' => $this->security->xss_clean($this->input->post('status_publish')),
		    	  'created_at' => date('Y-m-d H:i:s')
				);

	            $this->artikel_model->insert($array);

	            $article_id = $this->db->insert_id();

	            $tag = $this->input->post('tag');

	            for ($i=0; $i < count($tag); $i++) {

	            	$array = array(
	            		       'article_id'=>$article_id,
	            		       'tag_id'=>$tag[$i],
	            		       'created_at'=> date('Y-m-d H:i:s')
	            		     );

	            	$this->artikel_model->insert_detail_tag($array);

	            }

	            $this->session->set_flashdata('success', 'Data berhasil disimpan');

	            redirect('cpanel/pages/artikel');
	        }
	        else{

	        	if ( $this->session->userdata('check_login') == '1' ){

					$this->load->view('template/backend/index',[
						'title' => 'Artikel',
						'category' => $this->artikel_model->get_category(),
						'users' => $this->artikel_model->get_users(),
						'tag' => $this->artikel_model->get_tag(),
						'content' => 'backend/pages/artikel/create',
						'modal' => 'template/backend/modal',
						'javascript' => 'backend/pages/artikel/javascript',
					]);

					$this->session->set_flashdata('warning', 'Maaf tipe file yang anda masukan salah');

				}
			    else{
			     redirect('cpanel/auth');
			    }
	        }
        }

	}

	public function edit($random_string)
	{

		if ( $this->session->userdata('check_login') == '1' ){

			if( !$this->artikel_model->edit($random_string) ):
				$content = 'template/backend/404';
				$title   ='Not Found';
			else:
				$content = 'backend/pages/artikel/edit';
				$title   = 'Artikel';
			endif;

			$this->load->view('template/backend/index',[
				'title' => $title,
				'category' => $this->artikel_model->get_category(),
				'users' => $this->artikel_model->get_users(),
				'tag' => $this->artikel_model->get_tag(),
				'detail_tags' => $this->artikel_model->get_show_tags($random_string),
				'edit' => $this->artikel_model->edit($random_string),
				'content' => $content,
				'modal' => 'template/backend/modal',
				'javascript' => 'backend/pages/artikel/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
        $this->form_validation->set_rules('user_id', 'Author', 'required|trim');
        $this->form_validation->set_rules('status_publish', 'Status Publish', 'required|trim');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('tag[]', 'Tag', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

        $random_id = $this->security->xss_clean($this->input->post('_token'));
        $tag       = $this->input->post('tag');

        $artikel = $this->artikel_model->edit($random_id);

        if(! $artikel )show_404();

        $article_id = $artikel->id;
        $images     = $artikel->images;

        if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('warning', 'Data gagal disimpan');

            redirect()->to($_SERVER['HTTP_REFERER']);
        }
        else
        {
        	if( !$_FILES["images"]['name'] ){

        		$array = array(
		    	  'keywords' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('keywords'))),
		    	  'description' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('description'))),
		    	  'user_id' => $this->security->xss_clean($this->input->post('user_id')),
		    	  'content' => $this->input->post('content'),
		    	  'category_id' => $this->security->xss_clean($this->input->post('category_id')),
		    	  'setting_slider' => $this->security->xss_clean($this->input->post('setting_slider')),
		    	  'status_publish' => $this->security->xss_clean($this->input->post('status_publish')),
		    	  'updated_at' => date('Y-m-d H:i:s')
				);

        		$this->artikel_model->update($array,$article_id);
        		$this->artikel_model->delete_tags($article_id);

        		for ($i=0; $i < count($tag); $i++) {

	            	$array = array(
	            		       'article_id'=>$article_id,
	            		       'tag_id'=>$tag[$i],
	            		       'created_at'=> date('Y-m-d H:i:s')
	            		     );

	            	$this->artikel_model->insert_detail_tag($array);
	            }

        		$this->session->set_flashdata('success', 'Data berhasil diperbarui');

	            redirect('cpanel/pages/artikel');
        	}
        	else{

        		$config = array(
	        		'image_library' => 'gd2',
		            'upload_path' => './storage/900/',
		            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG',
		            'encrypt_name'=>TRUE,
		        );

		        $this->load->library('upload', $config);

		        if ( $this->upload->do_upload('images') ){

		        	$upload_data = $this->upload->data();
	                $filename = $upload_data['file_name'];
					$this->resize_image($filename);

					unlink('./storage/900/'.$images);
					unlink('./storage/300/'.$images);

					$array = array(
			    	  'keywords' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('keywords'))),
			    	  'description' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('description'))),
			    	  'user_id' => $this->security->xss_clean($this->input->post('user_id')),
			    	  'content' => $this->input->post('content'),
			    	  'category_id' => $this->security->xss_clean($this->input->post('category_id')),
			    	  'images' => $filename,
			    	  'setting_slider' => $this->security->xss_clean($this->input->post('setting_slider')),
			    	  'status_publish' => $this->security->xss_clean($this->input->post('status_publish')),
			    	  'updated_at' => date('Y-m-d H:i:s')
					);

		            $this->artikel_model->update($array,$article_id);
        		    $this->artikel_model->delete_tags($article_id);

		            for ($i=0; $i < count($tag); $i++) {

		            	$array = array(
		            		       'article_id'=>$article_id,
		            		       'tag_id'=>$tag[$i],
		            		       'created_at'=> date('Y-m-d H:i:s')
		            		     );

		            	$this->artikel_model->insert_detail_tag($array);
		            }

		            $this->session->set_flashdata('success', 'Data berhasil diperbarui');

		            redirect('cpanel/pages/artikel');
		        
		        }
		        else{

		        	$this->session->set_flashdata('warning', 'Maaf tipe file yang anda masukan salah');
	        
	        	   redirect()->to($_SERVER['HTTP_REFERER']);
		        }
        	}
        }
	}

	public function delete()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('backend/pages/artikel/delete');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->artikel_model->delete()){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
	}

	private function resize_image($filename)
    {
        $img_source = './storage/900/' . $filename;
        $img_target = './storage/300/';

        // image lib settings
        $config = array(
            'image_library' => 'gd2',
            'source_image' => $img_source,
            'new_image' => $img_target,
            'maintain_ratio' => TRUE,
            'width' => 300,
            'height' => 200,
        );
        
        // load image library
        $this->load->library('image_lib', $config);

        if(!$this->image_lib->resize())
            echo $this->image_lib->display_errors();
        $this->image_lib->clear();
    }


	private function stripHTMLtags($str)
    {
	    $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	    $t = htmlentities($t, ENT_QUOTES, "UTF-8");
	    return $t;
    }

}