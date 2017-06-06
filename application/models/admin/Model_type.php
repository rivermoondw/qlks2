<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_type extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('type_id, type')
            ->from('type')
            ->limit($limit, $start)
            ->order_by('type', 'ASC')
            ->get()->result_array();
    }

    public function get_type_list()
    {
        return $this->db->select('type_id, type')
            ->from('type')
            ->order_by('type', 'ASC')
            ->get()->result_array();
    }

    public function get($id = 0)
    {
        return $this->db->select('type_id, type')
            ->from('type')
            ->where('type_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('type', array(
            'type' => $this->input->post('type')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm hạng phòng thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi thêm hạng phòng'
            );
        }
    }

    public function del($id = 0)
    {
        $this->db->delete('type', array('type_id' => (int)$id));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Xóa hạng phòng thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa hạng phòng'
            );
        }
    }

    public function del_list($checkbox = NULL)
    {
        $this->db->where_in('type_id', $checkbox)->delete('type');
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Đã xóa (' . count($checkbox) . ') hạng phòng'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi xóa hạng phòng'
            );
        }
    }

    public function edit($id = 0)
    {
        $this->db->where('type_id', (int)$id)->update('type', array(
            'type' => $this->input->post('type')
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Cập nhật hạng phòng thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi cập nhật hạng phòng'
            );
        }
    }

    public function total()
    {
        return $this->db->get('type')->num_rows();
    }
}