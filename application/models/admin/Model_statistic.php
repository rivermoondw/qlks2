<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_statistic extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function count_room($start_date, $end_date, $room_id = NULL){
        $this->db->select('COUNT(room.room_id) as count')
            ->from('room')
            ->join('bookingroom', 'bookingroom.room_id = room.room_id')
            ->join('booking', 'booking.booking_id = bookingroom.booking_id')
            ->where('booking.start_date >=', $start_date)
            ->where('booking.start_date <=', $end_date);
        if ($room_id){
            $this->db->where('room.room_id', $room_id);
        }
         return   $this->db->get()->row_array();
    }

    public function total()
    {
        return $this->db->get('room')->num_rows();
    }
}