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
            if (count($list_room)){
                $this->db->where_in('room_id', $list_room)->update('room', array(
                    'state' => 0
                ));
            }
            $flag1 = $this->db->affected_rows();
            if ($flag1 > 0){
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
            else{
                $this->db->trans_rollback();
                return array(
                    'type' => 'error',
                    'message' => 'Lỗi giao dịch flag 1'
                );
            }
        } else {
            return array(
                'type' => 'error',
                'message' => 'Lỗi giao dịch flag'
            );
        }
    }

    public function get_payment_list($start, $limit){
        return $this->db->select('payment_id, fname, lname, state, payment.create_date, amount')
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

    public function get_payment_service($booking_id){
        return $this->db->select('room, service, service.price')
            ->from('bookingroom')
            ->join('room', 'room.room_id = bookingroom.room_id')
            ->join('bookingservice', 'bookingservice.bookingroom_id = bookingroom.bookingroom_id')
            ->join('service', 'service.service_id = bookingservice.service_id')
            ->where('booking_id', $booking_id)
            ->get()->result_array();
    }

    public function total()
    {
        return $this->db->get('booking')->num_rows();
    }
}