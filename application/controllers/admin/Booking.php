<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends Admin_Controller {
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Đặt phòng';
        $this->load->model('admin/model_booking');
        $this->load->model('admin/model_room');
        $this->data['active_parent'] = 'booking';
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'booking';
        $this->data['content_header'] = 'Danh sách đặt phòng';
        $this->data['before_head'] = '<!-- DataTables -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/flat/blue.css">';
        $this->data['before_body'] = '<!-- DataTables -->
<script src="' . base_url() . 'assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- iCheck -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="'.base_url('assets/admin').'/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="'.base_url('assets/admin').'/plugins/input-mask/jquery.inputmask.js"></script>
<script src="'.base_url('assets/admin').'/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="'.base_url('assets/admin').'/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="'.base_url('assets/admin').'/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="'.base_url('assets/admin').'/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="'.base_url('assets/admin').'/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- page script -->
<script>
  $(function () {
       //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
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
                $flag = $this->model_room->del_list($checkbox);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/booking');
            }
            else{
                $this->session->set_flashdata('message_flashdata', array(
                    'type' => 'error',
                    'message' => 'Bạn phải chọn đối tượng'
                ));
                redirect('admin/booking');
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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/booking/index/';
        $config['total_rows'] = $this->model_room->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $start_date = NULL;
        $end_date = NULL;
        if ($this->input->post('submit')){
            if (!empty($this->input->post('start_date'))&&!empty($this->input->post('end_date'))) {
                $str_start_date = str_replace('/', '-', $this->input->post('start_date'));
                $str_end_date = str_replace('/', '-', $this->input->post('end_date'));
                $start_date = date('Y-m-d', strtotime($str_start_date));
                $end_date = date('Y-m-d', strtotime($str_end_date));
                if ($start_date > $end_date) {
                    $flag = array(
                        'type' => 'error',
                        'message' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu'
                    );
                    $this->session->set_flashdata('message_date', $flag);
                }
            }
            else
            {
                $flag = array(
                    'type' => 'error',
                    'message' => 'Xin mời nhập ngày bắt đầu và ngày kết thúc'
                );
                $this->session->set_flashdata('message_date', $flag);
            }
        }
        $this->data['list_booking'] = $this->model_booking->get_booking_list(($page*$config['per_page']), $config['per_page'], $start_date, $end_date);
        foreach ($this->data['list_booking'] as $key => $val){
            $this->data['list_booking'][$key]['list_room'] = $this->model_booking->get_list_room($val['booking_id']);
        }
        $this->render('admin/booking/list_view');
    }

    public function detail($booking_id = 0){
        $booking = $this->model_booking->get_booking($booking_id);
        if (!isset($booking) || count($booking) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Không có thông tin đặt phòng'
            ));
            redirect('admin/booking');
        }
        if ($booking['state']==1){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Lần đặt phòng này đã thanh toán'
            ));
            redirect('admin/booking');
        }
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
        $this->data['content_header'] = 'Thông tin đặt phòng';
        $this->data['booking_id'] = $booking_id;
        $this->data['state'] = $booking['state'];
        $this->load->model('admin/model_service');
        $this->data['list_service_hotel'] = $this->model_service->get_service_list();
        if ($this->input->post('add_service')) {
            $temp = $this->input->post('service_id');
            if (is_array($temp)&&count($temp)) {
                $list_service = NULL;
                foreach ($temp as $key => $val) {
                    $list_service[] = array(
                        'booking_id' => $booking_id,
                        'service_id' => $val,
                        'create_date' => date('Y-m-d H:i:s', time())
                    );
                }
                $flag = $this->model_booking->add_service($list_service);
                $this->session->set_flashdata('message_flashdata', $flag);
            }
        }
        $this->data['guest'] = $this->model_booking->get_guest($booking_id);
        $this->data['customer'] = $this->model_booking->get_customer($booking_id);
        $this->data['list_room'] = $this->model_booking->get_list_room($booking_id);
        $this->data['list_service'] = $this->model_booking->get_list_service($booking_id);
        if ($this->input->post('check')){
            $list_room = array();
            foreach ($this->data['list_room'] as $key => $val){
                $list_room[] = array(
                    'room_id' => $val['room_id'],
                    'state' => 1
                );
            }
            $flag = $this->model_booking->check($booking_id, $list_room);
            $this->session->set_flashdata('message_flashdata', $flag);
            $url = 'admin/booking/detail/'.$booking_id;
            redirect($url);
        }
        if ($this->input->post('cancel')){
            $flag = $this->model_booking->cancel($booking_id);
            $this->session->set_flashdata('message_flashdata', $flag);
            redirect('admin/booking');
        }
        $this->render('admin/booking/detail_view');
    }

    public function registry(){
        $this->data['list_room'] = $this->model_room->get_room_empty();
        if (!isset($this->data['list_room']) || count($this->data['list_room']) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Không còn phòng cho thuê'
            ));
            redirect('admin/booking');
        }
        $this->data['active'] = 'registry';
        $this->data['before_head'] = '<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- InputMask -->
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
    //Flat red color scheme for iCheck
    $(\'input[type="checkbox"].flat-red, input[type="radio"].flat-red\').iCheck({
      checkboxClass: \'icheckbox_flat-green\',
      radioClass: \'iradio_flat-green\'
    });
  });
</script>';
        $this->data['content_header'] = 'Đặt phòng';
        if ($this->input->post('submit')){
            $this->form_validation->set_rules('fname','Họ đệm', 'trim|required');
            $this->form_validation->set_rules('lname','Tên', 'trim|required');
            $this->form_validation->set_rules('id','Chứng minh thư', 'trim|required');
            $this->form_validation->set_rules('dob','Ngày sinh', 'trim|required');
            $this->form_validation->set_rules('start_date','Ngày đến', 'trim|required');
            $this->form_validation->set_rules('end_date','Ngày trả', 'trim|required');
            $this->form_validation->set_rules('room_id[]','Phòng thuê', 'required');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE){
                if (!empty($this->input->post('start_date'))&&!empty($this->input->post('end_date'))) {
                    $str_start_date = str_replace('/', '-', $this->input->post('start_date'));
                    $str_end_date = str_replace('/', '-', $this->input->post('end_date'));
                    $start_date = date('Y-m-d', strtotime($str_start_date));
                    $end_date = date('Y-m-d', strtotime($str_end_date));
                    if ($start_date > $end_date) {
                        $flag = array(
                            'type' => 'error',
                            'message' => 'Ngày trả phải lớn hơn ngày đến'
                        );
                        $this->session->set_flashdata('message_flashdata', $flag);
                        redirect('admin/booking/registry');
                    }
                    else
                    {
                        $flag = $this->model_booking->registry();
                        $this->session->set_flashdata('message_flashdata', $flag);
                        redirect('admin/booking');
                    }
                }
            }
        }
        $this->render('admin/booking/registry_view');
    }

    public function guest($booking_id = 0){
        $this->data['content_header'] = 'Đăng ký khách đi cùng';
        $this->data['before_head'] = '<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="' . base_url() . 'assets/admin/plugins/select2/select2.min.css">';
        $this->data['before_body'] = '<!-- InputMask -->
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="' . base_url() . 'assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<!-- Select2 -->
<script src="' . base_url() . 'assets/admin/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="' . base_url() . 'assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
    //Flat red color scheme for iCheck
    $(\'input[type="checkbox"].flat-red, input[type="radio"].flat-red\').iCheck({
      checkboxClass: \'icheckbox_flat-green\',
      radioClass: \'iradio_flat-green\'
    });
  });
</script>';
        if ($this->input->post()) {
            $this->form_validation->set_rules('fname','Họ đệm', 'trim|required');
            $this->form_validation->set_rules('lname','Tên', 'trim|required');
            $this->form_validation->set_rules('id','Chứng minh thư', 'trim|required');
            $this->form_validation->set_rules('dob','Ngày sinh', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-red"><i class="fa fa-times-circle-o"></i> <b>', '</b></div>');
            if ($this->form_validation->run() === TRUE) {
                $flag = $this->model_booking->add_guest($booking_id);
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = 'admin/booking/detail/'.$booking_id;
                redirect($url);
            }
        }
        $this->render('admin/booking/registry_guest_view');
    }

    public function del_guest($guest_id){
        $guest = $this->model_booking->guest($guest_id);
        if (!isset($guest) || count($guest) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Lỗi'
            ));
            redirect('admin/booking/detail/'.$guest['booking_id']);
        }
        $flag = $this->model_booking->del_guest($guest['guest_id']);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/booking/detail/'.$guest['booking_id']);
    }


    public function del($id){
        $booking = $this->model_booking->get_booking($id);
        if (!isset($booking) || count($booking) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Đặt phòng không tồn tại'
            ));
            redirect('admin/booking');
        }
        $flag = $this->model_booking->del($booking['booking_id']);
        $list_room = $this->model_booking->get_list_room($booking['booking_id']);
        $this->model_booking->free_room($list_room);
        $this->session->set_flashdata('message_flashdata', $flag);
        redirect('admin/booking');
    }
}