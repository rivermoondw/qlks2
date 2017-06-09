<div class="row">
    <div class="box box-primary">
        <div class="box-body">
            <?php
            $message_flashdata = $this->session->flashdata('message_flashdata');
            if (isset($message_flashdata) && count($message_flashdata)){
                if ($message_flashdata['type'] == 'success'){
                    ?>
                    <div class="alert alert-success alert-dismissible"><i class="icon fa fa-check"></i> <?php echo $message_flashdata['message']; ?></div>
                    <?php
                }
                else{
                    ?>
                    <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-ban"></i> <?php echo $message_flashdata['message']; ?></div>
                    <?php
                }
            }
            ?>
            <?php
            if (isset($list_room) && count($list_room)){
            foreach ($list_room as $key => $val){
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <?php
                if ($val['state'] == 0){
                ?>
                <div class="info-box bg-aqua">
                    <a href="<?php echo base_url().'admin/room/detail/'.$val['room_id']; ?>" class="custom"><span class="info-box-icon"><i class="fa fa-home"></i></span></a>
                <?php
                }
                else if ($val['state'] == 1){
                ?>
                    <div class="info-box bg-red">
                        <a href="<?php echo base_url().'admin/room/detail/'.$val['room_id'];?>" class="custom"><span class="info-box-icon"><i class="fa fa-home"></i></span></a>
                <?php
                }
                else{
                ?>
                        <div class="info-box bg-yellow">
                            <a href="<?php echo base_url().'admin/room/detail/'.$val['room_id'];?>" class="custom"><span class="info-box-icon"><i class="fa fa-home"></i></span></a>
                <?php
                }
                ?>
                        <div class="info-box-content">
                            <span class="info-box-number"><?php echo $val['room']; ?></span>
                            <span class="info-box-text"><?php echo $val['rank']; ?></span>
                            <span class="info-box-text"><?php echo $val['type']; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <?php
                }
                }
                else{
                    echo 'Không có dữ liệu';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /.row -->