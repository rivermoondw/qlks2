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
                        <th>Tổng tiềnn</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_payment) && count($list_payment)){
                        foreach ($list_payment as $key => $val) {
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
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->