<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/model_statistic');
    }

    public function index(){
        $this->load->helper('form');
        $this->data['page_title'] = 'Thống kê';
        $this->data['content_header'] = 'Thống kê';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '<!-- Select2 -->
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
<!-- iCheck 1.0.1 -->
<script src="'.base_url('assets/admin').'/plugins/iCheck/icheck.min.js"></script>
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
  });
</script>';
        if ($this->input->post('submit')){
            if (!empty($this->input->post('start_date'))&&!empty($this->input->post('end_date'))) {
                $str_start_date = str_replace('/', '-', $this->input->post('start_date'));
                $str_end_date = str_replace('/', '-', $this->input->post('end_date'));
                $start_date = date('Y-m-d', strtotime($str_start_date));
                $end_date = date('Y-m-d', strtotime($str_end_date));
                if ($start_date <= $end_date) {
                    $this->data['sum_count'] = $this->model_statistic->count_room($start_date, $end_date);
                    $this->load->model('admin/model_room');
                    $list_room = $this->model_room->get_room_list();
                    if (isset($list_room)&&count($list_room)){
                        foreach ($list_room as $key => $val){
                            $this->data['list_room'][$key] = array(
                                'room' => $val['room'],
                                'rank' => $val['rank'],
                                'type' => $val['type'],
                                'count' => $this->model_statistic->count_room($start_date, $end_date, $val['room_id'])
                            );
                        }
                    }
                }
                else{
                    $flag = array(
                        'type' => 'error',
                        'message' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu'
                    );
                    $this->session->set_flashdata('message_flashdata', $flag);
                }
            }
            else{
                $flag = array(
                    'type' => 'error',
                    'message' => 'Xin mời nhập ngày bắt đầu và ngày kết thúc'
                );
                $this->session->set_flashdata('message_flashdata', $flag);
            }
        }
        $this->render('admin/statistic/statistic_view');
    }
}