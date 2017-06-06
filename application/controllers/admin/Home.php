<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Trang chủ';
        $this->load->model('admin/model_room');
        $this->data['active_parent'] = 'home';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['content_header'] = 'Trang chủ';
        $this->data['before_head'] = '<style>
	.custom {
		color:#fff;
		color: rgba(255,255,255,0.95);
	}
	.custom:hover {
		color:#fff;
		color: rgba(255,255,255,1);
	}
  </style>';

        $config['full_tag_open'] = '<ul class="pagination pull-right no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Trang đầu';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Trang cuối';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = 'http://localhost:8080/qlks/admin/home/index/';
        $config['total_rows'] = $this->model_room->total();
        $config['per_page'] = 12;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_room'] = $this->model_room->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/home_view');
    }
}