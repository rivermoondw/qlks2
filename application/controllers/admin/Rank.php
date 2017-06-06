<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Quản lý hạng phòng';
        $this->load->model('admin/model_rank');
        $this->load->helper('form');
        $this->data['active_parent'] = 'rank';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'rank';
        $this->data['content_header'] = 'Danh sách hạng phòng';
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
        if ($this->input->post('btn-delete')) {
            $checkbox = $this->input->post('checkbox');
            if (is_array($checkbox)) {
                $flag = $this->model_rank->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/rank');
            } else {
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/rank');
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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/rank/index/';
        $config['total_rows'] = $this->model_rank->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows'] / $config['per_page']);
        $page = ($page > $total_page) ? $total_page : $page;
        $page = ($page < 1) ? 1 : $page;
        $page = $page - 1;
        $this->data['list_rank'] = $this->model_rank->get_list(($page * $config['per_page']), $config['per_page']);
        $this->render('admin/rank/list_view');
    }

    public function add()
    {
        $this->data['active'] = 'add_rank';
        $this->data['content_header'] = 'Thêm hạng phòng';
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('rank', 'Tên hạng phòng', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/rank/add_view');
            } else {
                $flag = $this->model_rank->add();
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/rank');

            }
        }
        $this->render('admin/rank/add_view');
    }

    public function del($id = 0)
    {
        $rank = $this->model_rank->get($id);
        if (!isset($rank) || count($rank) == 0) {
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Hạng phòng không tồn tại'
            ));
            redirect('admin/rank');
        }
        $flag = $this->model_rank->del($rank['rank_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/rank');
    }

    public function edit($id = 0)
    {
        $this->data['content_header'] = 'Sửa hạng phòng';
        $rank = $this->model_rank->get($id);
        $this->data['rank'] = $rank;
        if (!isset($rank) || count($rank) == 0) {
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Hạng phòng không tồn tại'
            ));
            redirect('admin/rank');
        }
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('rank', 'Tên hạng phòng', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === FALSE) {
                $this->render('admin/rank/edit_view');
            } else {
                $flag = $this->model_rank->edit($rank['rank_id']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/rank');

            }
        }
        $this->render('admin/rank/edit_view');
    }
}