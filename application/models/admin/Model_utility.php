<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_utility extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('utility_id, utility')
            ->from('utility')
            ->limit($limit, $start)
            ->order_by('utility', 'ASC')
            ->get()->result_array();
    }

    public function get_list_utility(){
        return $this->db->select('utility_id, utility')
            ->from('utility')
            ->get()->result_array();
    }

    public function get_list_room_utility($room_id){
        return $this->db->select('roomutility_id, utility, utility.utility_id')
            ->from('roomutility')
            ->join('utility', 'utility.utility_id = roomutility.utility_id')
            ->where('room_id', $room_id)
            ->get()->result_array();
    }

    public function get_room_utility($roomutility_id){
        return $this->db->select('roomutility_id, room_id')
            ->from('roomutility')
            ->where('roomutility_id', (int)$roomutility_id)
            ->get()->row_array();
    }

    public function get_utility($id = 0)
    {
        return $this->db->select('utility_id, utility')
            ->from('utility')
            ->where('utility_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('utility', array(
            'utility' => $this->input->post('utility')
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
        $this->db->delete('utility', array('utility_id' => (int)$id));
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
        $this->db->where_in('utility_id', $checkbox)->delete('utility');
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
        $this->db->where('utility_id', (int)$id)->update('utility', array(
            'utility' => $this->input->post('utility')
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
    
    public function add_utility($list_utility){
        if (is_array($list_utility) && count($list_utility)){
            $this->db->insert_batch('roomutility', $list_utility);
        }
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm thành công'
            );
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi'
            );
        }
    }

    public function del_utility($roomutility_id){
        $this->db->delete('roomutility', array('roomutility_id' => (int)$roomutility_id));
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

    public function total()
    {
        return $this->db->get('utility')->num_rows();
    }
}