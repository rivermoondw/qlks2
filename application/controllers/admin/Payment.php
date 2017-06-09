<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Admin_Controller{

    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Trả phòng';
        $this->load->model('admin/model_payment');
        $this->load->model('admin/model_booking');
        $this->load->helper('form');
        $this->data['active_parent'] = 'booking';
    }

    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->data['active'] = 'payment';
        $this->data['content_header'] = 'Danh sách trả phòng';
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
        $config['base_url'] = 'http://localhost:8080/qlks/admin/payment/index/';
        $config['total_rows'] = $this->model_payment->total();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        $total_page = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $total_page)?$total_page:$page;
        $page = ($page < 1)?1:$page;
        $page = $page - 1;
        $this->data['list_payment'] = $this->model_payment->get_payment_list(($page*$config['per_page']), $config['per_page']);
        $this->render('admin/payment/list_view');
    }

    public function detail($booking_id){
        $booking = $this->model_booking->get_booking($booking_id);
        if (!isset($booking) || count($booking) == 0){
            $this->session->set_flashdata('message_flashdata', array(
                'type' => 'error',
                'message' => 'Không có thông tin đặt phòng'
            ));
            redirect('admin/payment');
        }
        $this->data['page_title'] = 'Trả phòng';
        $this->data['content_header'] = 'Thông tin trả phòng';
        $this->data['customer'] = $this->model_booking->get_customer($booking_id);
        $this->data['list_room'] = $this->model_booking->get_list_room($booking_id);
        if (isset($this->data['list_room'])&&count($this->data['list_room'])){
            foreach ($this->data['list_room'] as $key => $val){
                $this->data['list_room'][$key]['list_service'] = $this->model_payment->get_payment_service($val['bookingroom_id']);
            }
            foreach ($this->data['list_room'] as $key => $val){
                $amount = $val['price'];
                foreach ($val['list_service'] as $k => $vl){
                    $amount += $vl['price']*$vl['count'];
                }
                $this->data['list_room'][$key]['amount'] = $amount;
            }
        }
        $this->data['state'] = $booking['state'];
        $this->data['amount'] = $this->model_payment->get_sum_amount($booking_id);
        $check = $this->model_payment->get_empty_room($booking_id);
        if ($this->input->post('submit')){
            if ($check){
                $flag = array(
                    'type' => 'error',
                    'message' => 'Phải trả phòng hết. Xin mời bấm trả phòng'
                );
                $this->session->set_flashdata('message_flashdata', $flag);
                $url = 'admin/payment/detail/'.$booking_id;
                redirect($url);
                $flag = $this->model_payment->pay($booking_id, $this->data['amount']['amount']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/payment');
            }
            else
            {
                $flag = $this->model_payment->pay($booking_id, $this->data['amount']['amount']);
                $this->session->set_flashdata('message_flashdata', $flag);
                redirect('admin/payment');
            }
        }
        $this->render('admin/payment/detail_view');
    }

    public function paymentroom($bookingroom_id)
    {
        $room = $this->model_payment->get_booking_room($bookingroom_id);
        $temp = $this->model_booking->get_list_service($bookingroom_id);
        $amount = $room['price'];
        foreach ($temp as $key=>$val){
            $amount += $val['price']*$val['count'];
        }
        $data = array(
            'state' => 1,
            'amount' => $amount
        );
        $this->model_payment->payment_room($bookingroom_id, $data);
        $this->model_booking->free_room($room);
        $booking_id = $this->model_booking->get_booking_id($bookingroom_id);
        $url = 'admin/payment/detail/'.$booking_id['booking_id'];
        redirect($url);
    }
}