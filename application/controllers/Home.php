<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('public/home_model');
        $this->load->model('public/visitor_model');
	}

	public function index()
	{
        $url = current_url();
        $this->visitor_model->insert_visitor($url);

		$this->load->view('template/public/index',[
            'kategory'=>$this->home_model->artikel_kategori(),
            'title' => 'Catatan Koding',
            'content' => 'public/home/index',
            'javascript' => 'public/home/javascript',
        ]);
	}

	public function load_data()
    {
    	$request = $this->input->get('id');

    	$result = $this->home_model->get_artikel($request);

        $output  = '';
        $last_id = '';

        if (!empty($result)) {

            $output .= '<div class="row flex-row blog">';

            foreach ($result as $rows) {

                $output .= '<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pl-2 pr-2">
                                <div class="card box-shadow mb-4 move-up-hover">
                                <img src="' . base_url('storage/300/' . $rows->images) . '" class="card-img-top article-thumbnail">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">' . $rows->categorys_name . '</h5>
                                    <p class="card-text">
                                    <a href="' . base_url('/articles/' . $rows->slug_c . '/' . $rows->slug_a . '') . '">' . $rows->title . '</a>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <i class="fas fa-user-circle text-primary"></i>
                                    <span>
                                        <a href="' . base_url('/author/' . $rows->slug_u . '') . '" title="">' . $rows->name . '</a>
                                    </span>
                                </div>
                                </div>
                            </div>';

                $last_id = $rows->id;

            }

            $output .= '</div>';

            $output .= '<div class="mb-3 mt-3 text-center">
                            <button type="button" data-id="' . $last_id . '" id="load_more_button" class="btn btn-outline-primary btn-md">
                                Tampilkan lebih banyak
                            </button>
                        </div>';
        } else {

            $output .= '<div class="mb-3 mt-3 text-center">
                            <button type="button" class="btn btn-outline-primary btn-md">No Data Found</button>
                        </div>';
        }

        echo $output;
    }


}