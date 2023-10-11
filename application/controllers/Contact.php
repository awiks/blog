<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('public/contact_model');
		$this->load->model('public/visitor_model');
	}

	public function index()
	{
		$capcha   = $this->security->xss_clean($this->input->post('capcha'));
		$name     = $this->security->xss_clean($this->stripHTMLtags($this->input->post('name')));
		$email    = $this->security->xss_clean($this->input->post('email'));
		$phone    = $this->security->xss_clean($this->stripHTMLtags($this->input->post('phone')));
		$message  = $this->security->xss_clean($this->stripHTMLtags($this->input->post('message')));
		$ip_address = $this->input->ip_address();
		$created_at = date('Y-m-d H:i:s');

		$validation = $this->form_validation;
		$validation->set_rules('name','Nama','required|trim');
		$validation->set_rules('email','Email','required|trim|valid_email');
		$validation->set_rules('phone','Phone','required|trim');
		$validation->set_rules('message','Pesan','required|trim');

		if ( $validation->run() == TRUE ){

			// First, delete old captchas
			$expiration = time() - 7200; // Two hour limit
			$this->db->where('captcha_time < ', $expiration)
			         ->delete('captcha');

			// Then see if a captcha exists:
			$sql = "SELECT COUNT(*) AS count FROM captcha 
			        WHERE word='$capcha' AND ip_address='$ip_address'
			        AND captcha_time > $expiration";

			$binds = array(isset($_POST['captcha']), $ip_address, $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();

			if ( $row->count == 0)
			{
			    $this->session->set_flashdata('messages', '<div class="alert alert-warning">Anda harus mengirimkan kata yang muncul di captcha.</div>');

			    $this->load->view('template/public/index',[
					'title' => 'Contact',
					'captcha' => $this->contact_model->chapcha(),
					'content' => 'public/contact/index',
				]);
			}
			else
			{
				$array = array(
					           'name'=>$name,
					           'email'=>$email,
					           'phone'=>$phone,
					           'message'=>$message,
					           'created_at'=>$created_at
			                   );

				$this->contact_model->insert($array);

				$this->session->set_flashdata('messages', '<div class="alert alert-success">Pesan anda berhasil terkirim, terima kasih sudah menghubungi kami.</div>');
				
				redirect('contact');
			}
		}
		else{

			$url = current_url();
	        $this->visitor_model->insert_visitor($url);

			$this->load->view('template/public/index',[
				'title' => 'Contact',
				'captcha' => $this->contact_model->chapcha(),
				'content' => 'public/contact/index',
			]);
		}

	}

	private function stripHTMLtags($str)
    {
	    $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	    $t = htmlentities($t, ENT_QUOTES, "UTF-8");
	    return $t;
    }
}