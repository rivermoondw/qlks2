<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <?php echo $before_head; ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>admin/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><strong>Quản lý khách sạn</strong></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>assets/admin/dist/img/Screenshot_12.png" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Nhân viên lễ tân</p>
                    <p>Yowzah</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><h5 style="color: #fff">Menu chính</h5></li>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'home') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/home"><span>Trang chủ</span></a></li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'booking') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Đặt phòng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'registry') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/booking/registry"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'registry') ? 'text-aqua' : ''; ?>"></i>Đặt phòng</a>
                        </li>
                        <li class="<?php echo (isset($active) && $active == 'booking') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/booking"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'booking') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách đặt phòng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'payment') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/payment"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'payment') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách trả phòng</a></li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'room') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Phòng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'room') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/room"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'room') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách phòng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'add_room') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/room/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'add_room') ? 'text-aqua' : ''; ?>"></i>Thêm
                                phòng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'service') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Dịch vụ</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'service') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/service"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'service') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách dịch vụ</a></li>
                        <li class="<?php echo (isset($active) && $active == 'add_service') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/service/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'add_service') ? 'text-aqua' : ''; ?>"></i>Thêm
                                dịch vụ</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'rank') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Hạng phòng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'rank') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/rank"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'rank') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách hạng phòng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'add_type') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/rank/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'add_rank') ? 'text-aqua' : ''; ?>"></i>Thêm
                                hạng phòng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'type') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Loại phòng</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'type') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/type"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'type') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách loại phòng</a></li>
                        <li class="<?php echo (isset($active) && $active == 'add_type') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/type/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'add_type') ? 'text-aqua' : ''; ?>"></i>Thêm
                                loại phòng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php echo (isset($active_parent) && $active_parent == 'utility') ? 'active' : ''; ?>">
                    <a href="#">
                        <span>Tiện nghi</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo (isset($active) && $active == 'utility') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/utility"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'utility') ? 'text-aqua' : ''; ?>"></i>Danh
                                sách tiện nghi</a></li>
                        <li class="<?php echo (isset($active) && $active == 'add_utility') ? 'active' : ''; ?>"><a
                                    href="<?php echo base_url(); ?>admin/utility/add"><i
                                        class="fa fa-circle-o <?php echo (isset($active) && $active == 'add_utility') ? 'text-aqua' : ''; ?>"></i>Thêm
                                tiện nghi</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo (isset($active_parent) && $active_parent == 'statistic') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>admin/statistic"><span>Thống kê</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>