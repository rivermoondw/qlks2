<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_booking extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function registry(){
        $this->db->trans_begin();
        $list_room = $this->input->post('room_id');
        $date = array(
            'dob' => str_replace('/', '-', $this->input->post('dob')),
            'start_date' => str_replace('/', '-', $this->input->post('start_date')),
            'end_date' => str_replace('/', '-', $this->input->post('end_date'))
        );
        $this->db->insert('customer', array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'id' => $this->input->post('id'),
            'dob' => date('Y-m-d',strtotime($date['dob'])),
            'gender' => $this->input->post('gender'),
            'phone' => empty($this->input->post('phone'))?'':$this->input->post('phone'),
            'address' => empty($this->input->post('address'))?'':$this->input->post('address')
        ));
        $flag = $this->db->affected_rows();
        if ($flag <= 0){
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi đặt phòng'
            );
        }
        $customer_id = $this->db->insert_id();
        $this->db->insert('booking', array(
            'customer_id' => (int)$customer_id,
            'quantity' => count($list_room),
            'start_date' => date('Y-m-d',strtotime($date['start_date'])),
            'end_date' => date('Y-m-d',strtotime($date['end_date'])),
            'state' => 0,
            'create_date' => date('Y-m-d H:i:s', time())
        ));
        $flag = $this->db->affected_rows();
        if ($flag <= 0){
            $this->db->trans_rollback();
            return array(
                'type' => 'error',
                'message' => 'Lỗi đặt phòng'
            );
        }
        $booking_id = $this->db->insert_id();
        if (count($list_room) != 0){
            $data = array();
            foreach ($list_room as $key => $val){
                array_push($data, array(
                    'booking_id' => $booking_id,
                    'room_id' => $val,
                    'state' => 0,
                ));
            }
            $this->db->insert_batch('bookingroom', $data);
            $flag = $this->db->affected_rows();
            if ($flag <= 0){
                $this->db->trans_rollback();
                return array(
                    'type' => 'error',
                    'message' => 'Lỗi đặt phòng'
                );
            }
            $this->db->where_in('room_id', $list_room)->update('room', array(
                'state' => 1
            ));
            $flag = $this->db->affected_rows();
            if ($flag > 0) {
                $this->db->trans_commit();
                return array(
                    'type' => 'success',
                    'message' => 'Đặt phòng thành công'
                );
            } else {
                $this->db->trans_rollback();
                return array(
                    'type' => 'error',
                    'message' => 'Lỗi đặt phòng'
                );
            }
        }
        else{
            return array(
                'type' => 'error',
                'message' => 'Lỗi đặt phòng'
            );
        }
    }

    public function get_list_room($booking_id){
        return $this->db->select('room.room_id, room, price, room.state, bookingroom_id')
            ->from('room')
            ->join('bookingroom', 'bookingroom.room_id = room.room_id')
            ->where('booking_id', $booking_id)
            ->order_by('room', 'ASC')
            ->get()->result_array();
    }

    public function get_list_service($bookingroom_id){
        return $this->db->select('bookingservice_id, service.service_id, service, price, bookingroom.bookingroom_id, count')
            ->from('service')
            ->join('bookingservice', 'bookingservice.service_id = service.service_id')
            ->join('bookingroom', 'bookingroom.bookingroom_id = bookingservice.bookingroom_id')
            ->where('bookingroom.bookingroom_id', $bookingroom_id)
            ->order_by('service_id', 'ASC')
            ->get()->result_array();
    }

    public function service($id){
        return $this->db->select('usingservice_id, booking_id')
            ->from('usingservice')
            ->where('usingservice_id', $id)
            ->get()->row_array();
    }

    public function del_service($id){
        $this->db->delete('bookingservice', array('bookingservice_id' => (int)$id));
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

    public function get_customer($booking_id = 0){
        return $this->db->select('fname, lname, id, dob, gender, phone, address')
            ->from('customer')
            ->join('booking', 'booking.customer_id = customer.customer_id')
            ->where('booking_id', $booking_id)
            ->get()->row_array();
    }

    public function get_guest($booking_id = 0){
        return $this->db->select('guest_id, fname, lname, id, dob, gender, phone, address')
            ->from('guest')
            ->join('booking', 'booking.booking_id = guest.booking_id')
            ->where('booking.booking_id', $booking_id)
            ->order_by('lname', 'ASC')
            ->get()->result_array();
    }

    public function guest($guest_id){
        return $this->db->select('guest_id, booking_id')
            ->from('guest')
            ->where('guest_id', $guest_id)
            ->get()->row_array();
    }

    public function del_guest($guest_id){
        $this->db->delete('guest', array('guest_id' => (int)$guest_id));
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

    public function get_booking($booking_id = 0){
        return $this->db->select('booking_id, state')
            ->from('booking')
            ->where('booking_id', $booking_id)
            ->get()->row_array();
    }

    public function get_booking_list($start, $limit, $start_date = NULL, $end_date = NULL){
        $this->db->select('booking_id, fname, lname, start_date, end_date, state, create_date')
            ->from('booking')
            ->join('customer', 'customer.customer_id = booking.customer_id')
            ->where('state', 0);
        if (isset($start_date)&&isset($end_date)){
            $this->db->where('start_date >=', $start_date);
            $this->db->where('start_date <=', $end_date);
        }
            $this->db->limit($limit, $start)
            ->order_by('create_date', 'DESC');
        return  $this->db->get()->result_array();
    }

    public function add_service($list_service){
        if (is_array($list_service) && count($list_service)){
            $this->db->insert_batch('bookingservice', $list_service);
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

    public function add_guest($booking_id = 0){
        $dob = str_replace('/', '-', $this->input->post('dob'));
        $this->db->insert('guest', array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'dob' => date('Y-m-d',strtotime($dob)),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'id' => $this->input->post('id'),
            'booking_id' => (int)$booking_id
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

    public function del($id){
        $this->db->delete('booking', array('booking_id' => (int)$id));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $this->db->delete('bookingroom', array('booking_id' => (int)$id));
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

    public function free_room($list_room){
        if (is_array($list_room)&&count($list_room)){
            $this->db->where_in('room_id', $list_room);
            $this->db->update('room', array(
                'state' => 0
            ));
        }
    }

    public function get_booking_room($room_id){
        return $this->db->select('booking.booking_id, bookingroom_id')
            ->from('booking')
            ->join('bookingroom', 'bookingroom.booking_id = booking.booking_id')
            ->join('room', 'bookingroom.room_id = room.room_id')
            ->where('room.room_id', $room_id)->where('booking.state', 0)->where('room.state', 1)
            ->get()->row_array();
    }

    public function get_service_room($bookingroom){
        return $this->db->select('bookingservice_id, room.room_id')
            ->from('bookingservice')
            ->join('bookingroom', 'bookingroom.bookingroom_id = bookingservice.bookingroom_id')
            ->join('room', 'bookingroom.room_id = room.room_id')
            ->where('bookingroom.bookingroom_id', $bookingroom)
            ->get()->row_array();
    }

    public function add_count_service($bookingservice_id){
        $this->db->set('count', 'count+1', FALSE);
        $this->db->where('bookingservice_id', $bookingservice_id);
        $this->db->update('bookingservice');
    }

    public function sub_count_service($bookingservice_id){
        $this->db->set('count', 'count-1', FALSE);
        $this->db->where('bookingservice_id', $bookingservice_id);
        $this->db->update('bookingservice');
    }

    public function count_service($bookingservice_id){
        return $this->db->select('count')
            ->from('bookingservice')
            ->where('bookingservice_id', $bookingservice_id)
            ->get()->row_array();
    }

    public function get_booking_id($bookingroom_id){
        return $this->db->select('booking_id')
            ->from('bookingroom')
            ->where('bookingroom_id', $bookingroom_id)
            ->get()->row_array();
    }

    public function total()
    {
        return $this->db->get('booking')->num_rows();
    }
}