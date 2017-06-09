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
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->data['content_header'] = 'Trang chủ';
        $this->data['before_head'] = '
<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">
  <style>
	.custom {
		color:#fff;
		color: rgba(255,255,255,0.95);
	}
	.custom:hover {
		color:#fff;
		color: rgba(255,255,255,1);
	}
  </style>';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({
        minimumResultsForSearch: Infinity
    });
  });
</script>';

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
        $this->data['rank'] = $this->model_room->rank_list();
        $this->data['type'] = $this->model_room->type_list();
        $rank_id = NULL;
        $type_id = NULL;
        $state = NULL;
        if ($this->input->post('submit')){
            if ($this->input->post('rank_id')) $rank_id = $this->input->post('rank_id');
            if ($this->input->post('type_id')) $type_id = $this->input->post('type_id');
            if ($this->input->post('state')) $state = $this->input->post('state');
            if ($this->input->post('state')==0) $state = $this->input->post('state');
        }
        $this->data['list_room'] = $this->model_room->get_list(($page*$config['per_page']), $config['per_page'], $state, $rank_id, $type_id);
        $this->render('admin/home_view');
    }
}