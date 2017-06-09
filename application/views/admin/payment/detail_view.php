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
<div class="row">
    <div class="col-md-6">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin trả phòng</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl>
                    <dt>Tên khách hàng</dt>
                    <dd><?php echo htmlspecialchars($customer['fname']).' '.htmlspecialchars($customer['lname']); ?></dd>
                    <dt>Chứng minh thư</dt>
                    <dd><?php echo htmlspecialchars($customer['id']);?></dd>
                    <dt>Phòng thuê</dt>
                    <?php
                    foreach ($list_room as $key => $val){
                        echo '<dd>'.$val['room'].'</dd>';
                    }
                    ?>
                    <dt>Thành tiền</dt>
                    <dd><?php echo $amount['amount'];?></dd>
                </dl>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <?php
                $att = array('role' => 'form');
                echo form_open('', $att);
                ?>
                <button type="submit" name="submit" value="submit" class="btn btn-sm <?php echo ($state==1)?'disabled btn-danger':'btn-success';?>" <?php echo ($state==1)?'disabled':'';?>><i class="fa fa-check"></i> <?php echo ($state==1)?'Đã thanh toán':'Xác nhận';?></button>
                <?php echo form_close();?>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
    <div class="col-md-6">
        <div class="box box-solid box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Thanh toán</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <?php
                    if (isset($list_room)&&count($list_room)){
                        foreach ($list_room as $key => $val){
                            ?>
                            <div class="panel box <?php echo ($val['state']==1)?'box-success':'box-danger' ?>">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $key; ?>" style="color:#000;">Phòng <?php echo $val['room']; ?></a>
                                    </h4>
                                    <div class="box-tools pull-right">
                                        <a href="<?php echo base_url(); ?>admin/payment/paymentroom/<?php echo $val['bookingroom_id'];?>"><button type="submit" class="btn btn-sm <?php echo ($val['state']==0)?'disabled btn-danger':'btn-success';?>" <?php echo ($val['state']==0)?'disabled':'';?>><i class="fa fa-check"></i> <?php echo ($val['state']==0)?'Đã trả':'Trả phòng';?></button></a>
                                    </div>
                                </div>
                                <div id="<?php echo $key; ?>" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Nội dung</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Đơn giá phòng <?php echo $val['room'];?></td>
                                                <td>1</td>
                                                <td><?php echo $val['price'] ?></td>
                                            </tr>
                                            <?php
                                            if (isset($val['list_service'])&&count($val['list_service'])){
                                                foreach ($val['list_service'] as $k => $vl){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $vl['service'];?></td>
                                                        <td><?php echo $vl['count'];?></td>
                                                        <td><?php echo $vl['price'];?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="2">Tổng tiền</th>
                                                <th><?php echo $val['amount'];?></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>