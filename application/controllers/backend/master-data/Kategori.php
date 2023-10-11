<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kategori extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/master-data/kategori_model');
   }

	public function index()
	{

		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'Kategori',
			  'content' => 'backend/master-data/kategori/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/master-data/kategori/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function ajax()
	{
		$result = $this->kategori_model->get_kategori();
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'images'=> '<img src="'.base_url('storage/'.$rows->images.'').'" alt="Image Category" style="width:45px;">',
			            'categorys_name' => $rows->categorys_name,
			            'slug' => $rows->slug,
			            'created_at' => date('d-m-Y H:i:s',strtotime($rows->created_at)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		if ( $this->session->userdata('check_login') == '1' ){
		  $this->load->view('backend/master-data/kategori/modal-add');
		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function simpan()
	{
		
		$validation = $this->form_validation;
		$validation->set_rules('categorys_name','categorys_name','required|trim');

		if ( $validation->run() ){

			$config = array(
        		'image_library' => 'gd2',
	            'upload_path' => './storage/',
	            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG|svg',
	            'encrypt_name'=>TRUE,
	        );

	        $this->load->library('upload', $config);

	        if ( $this->upload->do_upload('images') ){

	        	$upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];

                $array = array(
		    	  'categorys_name' => $this->security->xss_clean($this->input->post('categorys_name')),
		    	  'slug' => url_title($this->security->xss_clean($this->input->post('categorys_name')), 'dash', TRUE),
		    	  'images' => $filename,
		    	  'created_at' => date('Y-m-d H:i:s')
				);

				$this->kategori_model->insert($array);
			    echo 'oke';
	        }
	        else{
	        	echo 'filed';
	        }
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$id = $this->security->xss_clean($this->input->post('id'));
			$data['edit'] = $this->kategori_model->edit($id);
			$this->load->view('backend/master-data/kategori/modal-edit',$data);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$validation = $this->form_validation;
		$validation->set_rules('categorys_name','categorys_name','required|trim');

		$category = $this->kategori_model->edit($id);

        if(!$category )show_404();

        $category_id = $category->id;
        $images      = $category->images;

		if ( $validation->run() == TRUE ){

			if( !$_FILES["images"]['name'] ){

				$array = array(
		    	  'categorys_name' => $this->security->xss_clean($this->input->post('categorys_name')),
		    	  'slug' => url_title($this->security->xss_clean($this->input->post('categorys_name')), 'dash', TRUE),
		    	  'updated_at' => date('Y-m-d H:i:s')
				);

				$this->kategori_model->update($array,$category_id);
				echo 'oke';
			}
			else{

				$config = array(
	        		'image_library' => 'gd2',
		            'upload_path' => './storage/',
		            'allowed_types' => 'jpg|png|jpeg|JPEG|JPG|PNG|svg',
		            'encrypt_name'=>TRUE,
		        );

		        $this->load->library('upload', $config);

		        if ( $this->upload->do_upload('images') ){

		        	$upload_data = $this->upload->data();
		            $filename = $upload_data['file_name'];

		            if( $images != null){
		            	unlink('./storage/'.$images);
		            }

		            $array = array(
			    	  'categorys_name' => $this->security->xss_clean($this->input->post('categorys_name')),
			    	  'slug' => url_title($this->security->xss_clean($this->input->post('categorys_name')), 'dash', TRUE),
			    	  'images' => $filename,
			    	  'updated_at' => date('Y-m-d H:i:s')
					);

		        	$this->kategori_model->update($array,$category_id);

				    echo 'oke';

		        }
		        else{
		        	echo 'filed';
		        }
			}
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		if ( $this->session->userdata('check_login') == '1' ){

		 $this->load->view('backend/master-data/kategori/delete');
		 
		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->kategori_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}