<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_service extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('service_id, service, price')
            ->from('service')
            ->limit($limit, $start)
            ->order_by('service', 'ASC')
            ->get()->result_array();
    }

    public function get_service_list()
    {
        return $this->db->select('service_id, service, price')
            ->from('service')
            ->order_by('service', 'ASC')
            ->get()->result_array();
    }

    public function get($id = 0)
    {
        return $this->db->select('service_id, service, price')
            ->from('service')
            ->where('service_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('service', array(
            'service' => $this->input->post('service'),
            'price' => $this->input->post('price')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi thêm dữ liệu'
            );
        }
    }

    public function del($id = 0)
    {
        $this->db->delete('service', array('service_id' => (int)$id));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Xóa dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function del_list($checkbox = NULL)
    {
        $this->db->where_in('service_id', $checkbox)->delete('service');
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Đã xóa (' . count($checkbox) . ') dữ liệu'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa dữ liệu'
            );
        }
    }

    public function edit($id = 0)
    {
        $this->db->where('service_id', (int)$id)->update('service', array(
            'service' => $this->input->post('service'),
            'price' => $this->input->post('price')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Cập nhật dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi cập nhật dữ liệu'
            );
        }
    }

    public function total()
    {
        return $this->db->get('service')->num_rows();
    }

    public function add_service_room($bookingroom_id){
        $this->db->insert('bookingservice', array(
            'bookingroom_id' => $bookingroom_id,
            'service_id' => $this->input->post('service_id')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm dữ liệu thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi thêm dữ liệu'
            );
        }
    }
}