<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/parts/admin_master_header_view'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php
                echo isset($content_header)?$content_header:'';
                ?>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $the_view_content; ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $this->load->view('templates/parts/admin_master_footer_view'); ?>