<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/master-data/user_model');
   }

	public function index()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'User',
			  'content' => 'backend/master-data/user/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/master-data/user/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }

	}

	public function ajax()
	{
		$result = $this->user_model->get_user();
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			if($rows->active == '1'){
				$active = '<span class="badge badge-success">Aktif</span>';
			}
			else{
				$active = '<span class="badge badge-danger">Non aktif</span>';
			}

			$json[] = ['nomor' => $nomor,
			            'name' => $rows->name,
			            'email' => $rows->email,
			            'active' => $active,
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

		 $this->load->view('backend/master-data/user/modal-add');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function simpan()
	{
		$email = $this->security->xss_clean($this->input->post('email'));

		$array = array(
    	  'name' => $this->security->xss_clean($this->input->post('name')),
    	  'slug' => url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE),
    	  'email' => $email,
    	  'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
    	  'active'=>'1',
    	  'created_at' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('name','name','required|trim');
		$validation->set_rules('email','email','required|trim');
		$validation->set_rules('password','password','required|trim');

		if ( $validation->run() ){

			$query = $this->db->get_where('users',['email'=> $email ]);
			$count = $query->num_rows();

			if( $count === 0 ){
				$this->user_model->insert($array);
				echo 'oke';
			}
			else{
				echo 'ada';
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
			$data['edit'] = $this->user_model->edit($id);
			$this->load->view('backend/master-data/user/modal-edit',$data);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('name','name','required|trim');
		$validation->set_rules('active','active','required|trim');

		if ( $validation->run() ){
			$this->user_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete()
	{

		if ( $this->session->userdata('check_login') == '1' ){

		  $this->load->view('backend/master-data/user/delete');

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function hapus()
	{
		if ( $this->user_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}