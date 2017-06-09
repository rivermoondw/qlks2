<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_payment extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function pay($booking_id, $amount){
        $this->db->trans_begin();
        $this->db->where('booking_id', (int)$booking_id)->update('booking', array(
            'state' => 1
        ));
        $flag = $this->db->affected_rows();
        if ($flag > 0) {
            $list_room = array();
            $temp = $this->db->select('room_id')->from('bookingroom')->where('booking_id', $booking_id)->get()->result_array();
            if (isset($temp)&&count($temp)){
                foreach ($temp as $key => $val){
                    $list_room[] = $val['room_id'];
                }
            }
            else{
                $this->db->trans_rollback();
                return array(
                    'type' => 'error',
                    'message' => 'Lỗi giao dịch'
                );
            }
            $this->db->insert('payment', array(
                'booking_id' => $booking_id,
                'real_end_date' => date('Y-m-d', time()),
                'amount' => $amount,
                'create_date' => date('Y-m-d H:i:s', time())
            ));
            $flag2 = $this->db->affected_rows();
            if ($flag2 > 0) {
                $this->db->trans_commit();
                return array(
                    'type' => 'success',
                    'message' => 'Giao dịch thành công'
                );
            } else {
                $this->db->trans_rollback();
                return array(
                    'type' => 'error',
                    'message' => 'Lỗi giao dịch'
                );
            }
        }
        else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi giao dịch flag'
            );
        }
    }

    public function get_payment_list($start, $limit){
        return $this->db->select('payment_id, fname, lname, state, payment.create_date, amount, booking.booking_id')
            ->from('payment')
            ->join('booking', 'booking.booking_id = payment.booking_id')
            ->join('customer', 'customer.customer_id = booking.customer_id')
            ->where('state', 1)
            ->limit($limit, $start)
            ->order_by('payment.create_date', 'DESC')
            ->get()->result_array();
    }

    public function get_payment_detail($booking_id){
        return $this->db->select('booking.booking_id, fname, lname, payment.create_date, amount')
            ->from('payment')
            ->join('booking', 'booking.booking_id = payment.booking_id')
            ->join('customer', 'customer.customer_id = booking.customer_id')
            ->where('booking.booking_id', $booking_id)
            ->get()->row_array();
    }

    public function get_payment_service($bookingroom_id){
        return $this->db->select('room, service, service.price, count')
            ->from('bookingroom')
            ->join('room', 'room.room_id = bookingroom.room_id')
            ->join('bookingservice', 'bookingservice.bookingroom_id = bookingroom.bookingroom_id')
            ->join('service', 'service.service_id = bookingservice.service_id')
            ->where('bookingroom.bookingroom_id', $bookingroom_id)
            ->get()->result_array();
    }

    public function get_booking_room($bookingroom_id){
        return $this->db->select('room.room_id, price')
            ->from('bookingroom')
            ->join('room', 'room.room_id = bookingroom.room_id')
            ->where('bookingroom_id', $bookingroom_id)
            ->get()->row_array();
    }

    public function payment_room($bookingroom_id, $data){
        $this->db->where('bookingroom_id', (int)$bookingroom_id)->update('bookingroom', $data);
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

    public function get_sum_amount($booking_id){
        return $this->db->select_sum('amount')
            ->from('bookingroom')
            ->where('booking_id', $booking_id)
            ->get()->row_array();
    }

    public function get_empty_room($booking_id){
        return $this->db->select('room_id')
            ->from('bookingroom')
            ->where('booking_id', $booking_id)
            ->where('state', 0)
            ->get()->result_array();
    }

    public function total()
    {
        return $this->db->get('booking')->num_rows();
    }
}