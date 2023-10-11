<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class About extends CI_Controller {

    public function __construct(){
		parent ::__construct();
		$this->load->model('backend/pages/about_model');
    }

	public function index()
	{

		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'About',
			  'about'=> $this->about_model->get_abouts(),
			  'content' => 'backend/pages/about/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/pages/about/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }

	}

	public function create()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
				'title' => 'About',
				'content' => 'backend/pages/about/create',
				'modal' => 'template/backend/modal',
				'javascript' => 'backend/pages/about/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function simpan()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Publish', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('warning', 'Data gagal disimpan');

            redirect('cpanel/pages/about/create');
        }
        else
        {
        	$config = array(
        		'image_library' => 'gd2',
	            'upload_path' => './storage/',
	            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG',
	            'encrypt_name'=>TRUE,
	        );

	        $this->load->library('upload', $config);

	        if ( $this->upload->do_upload('images') ){

	        	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];

                $array = array(
				  'slug' => random_string('alnum', 100),
		    	  'title' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('title'))),
		    	  'content' => $this->input->post('content'),
		    	  'images' => $filename,
		    	  'status' => $this->security->xss_clean($this->input->post('status')),
		    	  'created_at' => date('Y-m-d H:i:s')
				);

				$this->about_model->insert($array);

				$this->session->set_flashdata('success', 'Data berhasil disimpan');

	            redirect('cpanel/pages/about');

	        }
	        else{

	        	 $this->session->set_flashdata('warning', 'Maaf tipe file yang anda masukan salah');
	        
	        	 redirect('cpanel/pages/about/create');
	        }
        }
	}

	public function edit($slug)
	{
		if ( $this->session->userdata('check_login') == '1' ){

			if( !$this->about_model->edit($slug) ):
				$content = 'template/backend/404';
				$title   ='Not Found';
			else:
				$content = 'backend/pages/about/edit';
				$title   = 'About';
			endif;

			$this->load->view('template/backend/index',[
				'title' => $title,
				'edit' => $this->about_model->edit($slug),
				'content' => $content,
				'modal' => 'template/backend/modal',
				'javascript' => 'backend/pages/about/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Publish', 'required|trim');

        $slug  = $this->security->xss_clean($this->input->post('_token'));

        $about = $this->about_model->edit($slug);

        if(! $about )show_404();

        $about_id = $about->id;
        $images   = $about->images;

        if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('warning', 'Data gagal disimpan');

            redirect()->to($_SERVER['HTTP_REFERER']);
        }
        else
        {
        	if( !$_FILES["images"]['name'] ){

        		$array = array(
		    	  'title' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('title'))),
		    	  'content' => $this->input->post('content'),
		    	  'status' => $this->security->xss_clean($this->input->post('status')),
		    	  'updated_at' => date('Y-m-d H:i:s')
				);

				$this->about_model->update($array,$about_id);

				$this->session->set_flashdata('success', 'Data berhasil diperbarui');

	            redirect('cpanel/pages/about');

	        	}
	        	else{

	        		$config = array(
		        		'image_library' => 'gd2',
			            'upload_path' => './storage/',
			            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG',
			            'encrypt_name'=>TRUE,
			        );

			        $this->load->library('upload', $config);

			        if ( $this->upload->do_upload('images') ){

			        	$upload_data = $this->upload->data();
		                $filename = $upload_data['file_name'];

		                unlink('./storage/'.$images);

		                $array = array(
				    	  'title' => $this->security->xss_clean($this->stripHTMLtags($this->input->post('title'))),
				    	  'content' => $this->input->post('content'),
				    	  'images' => $filename,
				    	  'status' => $this->security->xss_clean($this->input->post('status')),
				    	  'updated_at' => date('Y-m-d H:i:s')
						);

						$this->about_model->update($array,$about_id);

						$this->session->set_flashdata('success', 'Data berhasil disimpan');

			            redirect('cpanel/pages/about');

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

		 $this->load->view('backend/pages/about/delete');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->about_model->delete()){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
	}


	private function stripHTMLtags($str)
    {
	    $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	    $t = htmlentities($t, ENT_QUOTES, "UTF-8");
	    return $t;
    }

}