<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Profile extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/profile_model');
   }

	public function index()
	{

		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'Profile',
			  'profile'=> $this->profile_model->get_profile(),
			  'content' => 'backend/profile/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/profile/javascript',
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
				'title' => 'Artikel',
				'users' => $this->profile_model->get_users(),
				'content' => 'backend/profile/create',
				'javascript' => 'backend/profile/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function simpan()
	{
		$this->form_validation->set_rules('user_id', 'Author', 'required|trim');
        $this->form_validation->set_rules('about', 'About', 'required|trim');

        if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('warning', 'Data gagal disimpan');

            redirect('cpanel/profile/create');
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

                $user_id = $this->security->xss_clean($this->input->post('user_id'));

                $array = array(
				  'slug' => random_string('alnum', 100),
		    	  'user_id' => $user_id,
		    	  'about' => $this->input->post('about'),
		    	  'image' => $filename,
		    	  'created_at' => date('Y-m-d H:i:s')
				);

				$query = $this->db->get_where('users',['id'=> $user_id ]);
			    $count = $query->num_rows();

			    if( $count === 0 ){
					$this->profile_model->insert($array);
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
					redirect('cpanel/profile');
				}
				else{
					
					$this->session->set_flashdata('warning', 'Maaf Author yang anda pilih sudah ada.');
	        
	        	    redirect('cpanel/profile/create');
				}
	        }
	        else{

	        	 $this->session->set_flashdata('warning', 'Maaf tipe file yang anda masukan salah');
	        
	        	 redirect('cpanel/profile/create');
	        }
        }
	}

	public function edit($slug)
	{
		if ( $this->session->userdata('check_login') == '1' ){

			if( !$this->profile_model->edit($slug) ):
				$content = 'template/backend/404';
				$title   ='Not Found';
			else:
				$content = 'backend/profile/edit';
				$title   = 'Portofolio';
			endif;

			$this->load->view('template/backend/index',[
				'title' => $title,
				'users' => $this->profile_model->get_users(),
				'edit' => $this->profile_model->edit($slug),
				'content' => $content,
				'javascript' => 'backend/profile/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
		$this->form_validation->set_rules('about', 'About', 'required|trim');

        $slug  = $this->security->xss_clean($this->input->post('_token'));

        $profile = $this->profile_model->edit($slug);

        if(! $profile )show_404();

        $profile_id = $profile->id;
        $images   = $profile->image;

        if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('warning', 'Data gagal disimpan');

            redirect()->to($_SERVER['HTTP_REFERER']);
        }
        else
        {
        	if( !$_FILES["images"]['name'] ){

        		$array = array(
		    	  'about' => $this->input->post('about'),
		    	  'updated_at' => date('Y-m-d H:i:s')
				);

				$this->profile_model->update($array,$profile_id);

				$this->session->set_flashdata('success', 'Data berhasil diperbarui');

	            redirect('cpanel/profile');

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
			    	  'about' => $this->input->post('about'),
			    	  'image' => $filename,
			    	  'updated_at' => date('Y-m-d H:i:s')
					);

					$this->profile_model->update($array,$profile_id);

					$this->session->set_flashdata('success', 'Data berhasil disimpan');

		            redirect('cpanel/profile');

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

		  $this->load->view('backend/profile/delete');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->profile_model->delete()){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
	}
}