<?php
class Booking extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Đặt phòng';
        $this->load->helper('form');
    }

    public function index(){
        $this->render('public/booking_view');
    }
}