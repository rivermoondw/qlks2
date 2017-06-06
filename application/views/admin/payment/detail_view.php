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
                <h3 class="box-title">Thông tin khách hàng</h3>
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
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
    <div class="col-md-6">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Thanh toán</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nội dung</th>
                            <th>Đơn giá</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum;
                    if (isset($list_room)&&count($list_room)){
                        foreach ($list_room as $key => $val){
                    ?>
                        <tr>
                            <td>Đơn giá phòng <?php echo $val['room']; ?></td>
                            <td><?php echo $val['price'] ?></td>
                        </tr>
                    <?php
                        }
                    }
                    if (isset($list_service)&&count($list_service)){
                        foreach ($list_service as $key => $val){
                    ?>
                        <tr>
                            <td>Phòng <?php echo $val['room'].' - '.$val['service'];?></td>
                            <td><?php echo $val['price'];?></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tổng tiền</th>
                            <th><?php echo $amount;?></th>
                        </tr>
                    </tfoot>
                </table>
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
</div>