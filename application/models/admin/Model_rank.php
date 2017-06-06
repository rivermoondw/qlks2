<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rank extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list($start, $limit)
    {
        return $this->db->select('rank_id, rank')
            ->from('rank')
            ->limit($limit, $start)
            ->order_by('rank', 'ASC')
            ->get()->result_array();
    }

    public function get_rank_list()
    {
        return $this->db->select('rank_id, rank')
            ->from('rank')
            ->order_by('rank', 'ASC')
            ->get()->result_array();
    }

    public function get($id = 0)
    {
        return $this->db->select('rank_id, rank')
            ->from('rank')
            ->where('rank_id', (int)$id)
            ->get()->row_array();
    }

    public function add()
    {
        $this->db->insert('rank', array(
            'rank' => $this->input->post('rank')
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
        $this->db->delete('rank', array('rank_id' => (int)$id));
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
        $this->db->where_in('rank_id', $checkbox)->delete('rank');
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
        $this->db->where('rank_id', (int)$id)->update('rank', array(
            'rank' => $this->input->post('rank')
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
        return $this->db->get('rank')->num_rows();
    }
}