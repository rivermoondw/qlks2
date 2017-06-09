<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_room extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function rank_list()
    {
        return $this->db->get('rank')->result_array();
    }

    public function type_list()
    {
        return $this->db->get('type')->result_array();
    }

    public function get_room_list(){
        return $this->db->select('room_id, room, rank, type, state')
            ->from('room')
            ->join('rank', 'room.rank_id = rank.rank_id')
            ->join('type', 'room.type_id = type.type_id')
            ->order_by('room', 'ASC')
            ->get()->result_array();
    }

    public function get_list($start, $limit, $state = NULL, $rank_id = NULL, $type_id = NULL)
    {
        $this->db->select('room_id, room, tel, rank, type, price, state')
            ->from('room')
            ->join('rank', 'room.rank_id = rank.rank_id')
            ->join('type', 'room.type_id = type.type_id');
        if (isset($state)&&$state!='all'){
            $this->db->where('state', $state);
        }
        if (isset($rank_id)&&$rank_id!='all'){
            $this->db->where('rank.rank_id', $rank_id);
        }
        if (isset($type_id)&&$type_id!='all'){
            $this->db->where('type.type_id', $type_id);
        }
            $this->db->limit($limit, $start)
            ->order_by('room', 'ASC');
        return    $this->db->get()->result_array();
    }

    public function get_room($id = 0)
    {
        return $this->db->select('room_id, room, tel, rank, type, price, state')
            ->from('room')
            ->join('rank', 'room.rank_id = rank.rank_id')
            ->join('type', 'room.type_id = type.type_id')
            ->where('room_id', (int)$id)
            ->get()->row_array();
    }

    public function get_room_empty(){
        return $this->db->select('room_id, room')
            ->from('room')
            ->where('state', 0)
            ->get()->result_array();
    }

    public function add()
    {
        $this->db->insert('room', array(
            'room' => $this->input->post('room'),
            'tel' => $this->input->post('tel'),
            'rank_id' => $this->input->post('rank_id'),
            'type_id' => $this->input->post('type_id'),
            'price' => $this->input->post('price'),
            'state' => 0
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            return array(
                'type' => 'success',
                'message' => 'Thêm dữ liệu thành công',
				'last_id' => $this->db->insert_id()
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
        $this->db->delete('room', array('room_id' => (int)$id));
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
        $this->db->where_in('room_id', $checkbox)->delete('room');
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
        $this->db->where('room_id', (int)$id)->update('room', array(
            'room' => $this->input->post('room'),
            'tel' => $this->input->post('tel'),
            'rank_id' => $this->input->post('rank_id'),
            'type_id' => $this->input->post('type_id'),
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
        return $this->db->get('room')->num_rows();
    }
}