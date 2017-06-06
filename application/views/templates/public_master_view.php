<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/parts/public_master_header_view'); ?>
<div class="container">
    <?php echo $the_view_content;?>
</div>
<?php $this->load->view('templates/parts/public_master_footer_view'); ?>