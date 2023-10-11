<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kontak extends CI_Controller {

   public function __construct(){
	parent ::__construct();
	$this->load->model('backend/kontak_model');
   }

	public function index()
	{
		if ( $this->session->userdata('check_login') == '1' ){

			$this->load->view('template/backend/index',[
			  'title' => 'Kontak',
			  'content' => 'backend/kontak/index',
			  'modal' => 'template/backend/modal',
			  'javascript' => 'backend/kontak/javascript',
			]);

		}
	    else{
	     redirect('cpanel/auth');
	    }
	}

	public function ajax()
	{
		$result = $this->kontak_model->get_kontak();
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			if( $rows->read === '0' ){
				$read = '<span class="badge badge-warning">Belum dibaca</span>';
			}
			else{
				$read = '<span class="badge badge-success">Sudah dibaca</span>';
			}

			$json[] = ['nomor' => $nomor,
			            'name' => $rows->name,
			            'email' => $rows->email,
			            'phone' => $rows->phone,
			            'read' => $read,
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

}