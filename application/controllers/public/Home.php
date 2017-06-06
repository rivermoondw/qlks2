<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Trang chủ';
    }

    public function index(){
        $this->data['before_body'] = '<!-- Script to Activate the Carousel -->
    <script>
    $(\'.carousel\').carousel({
        interval: 5000 //changes the speed
    })
    </script>';
        $this->render('public/home_view');
    }
}