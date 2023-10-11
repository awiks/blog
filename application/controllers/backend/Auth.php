<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('backend/auth_model');
	}
	
	public function index()
	{

		$this->form_validation->set_rules('email','email','trim|required');
		$this->form_validation->set_rules('password','password','trim|required');

		if ( $this->form_validation->run() == FALSE )
		{
		    
		    $this->load->view('backend/auth/index');

		}
		else{

			$this->_login();
		}

	}

	private function _login()
	{

		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$result  = $this->auth_model->get_users($email);

		if ( $result == null ){

			$this->session->set_flashdata('message','<div class="alert alert-danger">
	    												<i class="fas fa-info-circle"></i> Email is not registered !!
	    											 </div>');

		    redirect('cpanel/auth');

		}
		else{

			if ( $result->active == '2' ){

				$this->session->set_flashdata('message','<div class="alert alert-danger">
		        											<i class="fas fa-info-circle"></i> This email has not been activated !
		        										</div>');

		        redirect('cpanel/auth');
			}
			else{

				if ( password_verify($password, $result->password) ){

					$array = array('name' => $result->name,
						            'email' => $result->email,
						            'check_login' => '1');

					$this->session->set_userdata($array);

					$this->session->set_flashdata('success','Login Success <br> <b>'.$result->name.'');

					redirect('cpanel/dashboard');
				
				}
				else{

				    $this->session->set_flashdata('message','<div class="alert alert-danger">
		          												<i class="fas fa-info-circle"></i> Password wrong !
		          											 </div>');

		            redirect('cpanel/auth');

				}
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata(array('name', 'email', 'check_login'));
		redirect('cpanel/auth');
	}

}