<div class="row">
    <?php
    $att = array('role' => 'form');
    echo form_open('', $att);
    ?>
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <?php
                $message_date = $this->session->flashdata('message_date');
                if (isset($message_date) && count($message_date)){
                    if ($message_date['type'] == 'success'){
                        ?>
                        <div class="alert alert-success alert-dismissible"><i class="icon fa fa-check"></i> <?php echo $message_date['message']; ?></div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="alert alert-danger alert-dismissible"><i class="icon fa fa-ban"></i> <?php echo $message_date['message']; ?></div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Từ ngày</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="start_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Đến ngày</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="end_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary btn-sm">
            </div>
        </div>
    </div>
    <?php echo form_close()?>
</div>
<div class="row">
    <div class="col-xs-12">
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
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Ngày thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum = 0;
                    if (isset($list_payment) && count($list_payment)){
                        foreach ($list_payment as $key => $val) {
                            $sum += $val['amount'];
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'admin/payment/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><b><?php echo htmlspecialchars($val['fname'] . ' ' . $val['lname']); ?></b></a>
                                </td>
                                <td><a href="<?php echo base_url() . 'admin/payment/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo htmlspecialchars($val['create_date']); ?></a></td>
                                <td><a href="<?php echo base_url() . 'admin/payment/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo ($val['state'] == 0) ? 'Chưa trả phòng' : 'Đã trả phòng'; ?></a>
                                </td>
                                <td><a href="<?php echo base_url() . 'admin/payment/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo htmlspecialchars($val['amount']); ?></a></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <td colspan="3"><strong>Tổng doanh thu</strong></td>
                        <td><strong><?php echo $sum;?></strong></td>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->