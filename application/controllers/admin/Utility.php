<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý tiện nghi';
        $this->load->model('admin/model_utility');
        $this->load->helper('form');
        $this->data['active_parent'] = 'utility';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'utility';
        $this->data['content_header'] = 'Danh sách tiện nghi';
        $this->data['before_head'] = '<!-- DataTables -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/flat/blue.css">';
        $this->data['before_body'] = '<!-- DataTables -->
<script src="' . base_url() . 'assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- iCheck -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<script>
  $(function () {
      $(".del-btn").click(function(){
          if(!confirm ("Bạn có muốn xóa không?")) event.preventDefault();
      });
      $(\'#del-list\').click(function(){
        $("input[name=\'checkbox[]\']").each(function(index){
            if ($(this).is(\':checked\')){
                if(!confirm ("Bạn có muốn xóa lựa chọn không?")) event.preventDefault();
                return false;
            }
        });
      });
      //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $(\'#example2 input[type="checkbox"]\').iCheck({
      checkboxClass: \'icheckbox_flat-blue\',
      radioClass: \'iradio_flat-blue\'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data(\'clicks\');
      if (clicks) {
        //Uncheck all checkboxes
        $("#example2 input[type=\'checkbox\']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass(\'fa-square-o\');
      } else {
        //Check all checkboxes
        $("#example2 input[type=\'checkbox\']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass(\'fa-check-square-o\');
      }
      $(this).data("clicks", !clicks);
    });
  });
</script>';
        if ($this->input->post('btn-delete')){
            $checkbox = $this->input->post('checkbox');
            if (is_array($checkbox)){
                $flag = $this->model_utility->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/utility');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/utility');
            }
        }

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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/utility/index/';
        $config['total_rows'] = $this->model_utility->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_utility'] = $this->model_utility->get_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/utility/list_view');
    }

    public function add()
    {
        $this->data['active'] = 'add_utility';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
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
        $this->data['content_header'] = 'Thêm tiện nghi';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('utility', 'Tên tiện nghi', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/utility/add_view');
            }
            else{
                $flag = $this->model_utility->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/utility');
            }
        }
        $this->render('admin/utility/add_view');
    }

    public function del($id = 0)
    {
        $utility = $this->model_utility->get_utility($id);
        if (!isset($utility) || count($utility) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Tiện nghi không tồn tại'
            ));
            redirect('admin/utility');
        }
        $flag = $this->model_utility->del($utility['utility_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/utility');
    }

    public function edit($id = 0)
    {
        $utility = $this->model_utility->get_utility($id);
        if (!isset($utility) || count($utility) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Tiện nghi không tồn tại'
            ));
            redirect('admin/utility');
        }
        $this->data['content_header'] = 'Sửa tiện nghi';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
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
        $this->data['utility'] = $utility;
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('utility', 'Tên tiện nghi', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/utility/edit_view');
            }
            else{
                $flag = $this->model_utility->edit($utility['utility_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/utility');

            }
        }
        $this->render('admin/utility/edit_view');
    }

    public function detail($room_id){
        $this->load->model('admin/model_room');
        $room = $this->model_room->get_room($room_id);
        if (!isset($room) || count($room) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Phòng không tồn tại'
            ));
            redirect('admin/room');
        }
        $this->data['active'] = 'detail_utility';
        $this->data['before_head'] = '<!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
      $(".del-btn").click(function(){
          if(!confirm ("Bạn có muốn xóa không?")) event.preventDefault();
      });
      $(\'#del-list\').click(function(){
        $("input[name=\'checkbox[]\']").each(function(index){
            if ($(this).is(\':checked\')){
                if(!confirm ("Bạn có muốn xóa lựa chọn không?")) event.preventDefault();
                return false;
            }
        });
      });
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>';
        $this->data['content_header'] = 'Thêm tiện nghi cho phòng';
        $this->data['room'] = $this->model_room->get_room($room_id);
        $this->data['list_utility'] = $this->model_utility->get_list_room_utility($room_id);
        $this->data['list_utility_aval'] = $this->model_utility->get_list_utility();
        if ($this->input->post('add_utility')){
            $temp = $this->input->post('utility_id');
            if (is_array($temp)&&count($temp)!=0) {
                $list_utility = NULL;
                foreach ($temp as $key => $val) {
                    $list_utility[] = array(
                        'room_id' => $room_id,
                        'utility_id' => $val
                    );
                }

                $flag = $this->model_utility->add_utility($list_utility);
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = 'admin/utility/detail/'.$room_id;
                redirect($url);
            }
        }
        $this->render('admin/utility/detail_view');
    }

    public function del_utility($roomutility_id){
        $utility = $this->model_utility->get_room_utility($roomutility_id);
        if (!isset($utility) || count($utility) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Tiện nghi không tồn tại'
            ));
            redirect('admin/utility');
        }
        $flag = $this->model_utility->del_utility($utility['roomutility_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        $url = 'admin/utility/detail/'.$utility['room_id'];
        redirect($url);
    }
}