<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Tag extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/master-data/tag_model');
   }

	public function index()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'Tag',
			  'content' => 'backend/master-data/tag/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/master-data/tag/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function ajax()
	{
		$result = $this->tag_model->get_tag();
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'tags_name' => $rows->tags_name,
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

		  $this->load->view('backend/master-data/tag/modal-add');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function simpan()
	{
		$array = array(
    	  'tags_name' => $this->security->xss_clean($this->input->post('tags_name')),
    	  'slug' => url_title($this->security->xss_clean($this->input->post('tags_name')), 'dash', TRUE),
    	  'created_at' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('tags_name','tags_name','required|trim');

		if ( $validation->run() ){
			$this->tag_model->insert($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$id = $this->security->xss_clean($this->input->post('id'));
			$data['edit'] = $this->tag_model->edit($id);
			$this->load->view('backend/master-data/tag/modal-edit',$data);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('tags_name','tags_name','required|trim');

		if ( $validation->run() ){
			$this->tag_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete()
	{
		if ( $this->session->userdata('check_login') == '1' ){

		 $this->load->view('backend/master-data/tag/delete');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->tag_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}