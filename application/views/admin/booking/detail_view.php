<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <a href="<?php echo base_url(); ?>admin/payment/detail/<?php echo $booking_id;?>"><button type="button" class="btn btn-success"><i class="fa fa-check"></i> Thanh toán</button></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin khách</h3>
            </div>
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
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Tên khách</th>
                        <th>Chứng minh thư</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Phòng đặt</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $dob = strtotime($customer['dob']);
                        ?>
                        <td><?php echo htmlspecialchars($customer['fname'].' '.$customer['lname']); ?></td>
                        <td><?php echo htmlspecialchars($customer['id']); ?></td>
                        <td><?php echo date('d-m-Y', $dob); ?></td>
                        <td><?php echo ($customer['gender']==0)?'Nữ':'Nam'; ?></td>
                        <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                        <td><?php echo htmlspecialchars($customer['address']); ?></td>
                        <td>
                            <?php
                            $temp = array();
                            foreach ($list_room as $key => $val){
                                $temp[$key] = $val['room'];
                            }
                            $str_list_room = implode(' - ',$temp);
                            echo $str_list_room;
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin khách đi cùng</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Tên khách</th>
                        <th>Chứng minh thư</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>SĐT</th>
                        <th colspan="2">Địa chỉ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($guest) && count($guest)){
                        foreach ($guest as $key => $val){
                            $date = strtotime($val['dob']);
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($val['fname']).' '.htmlspecialchars($val['lname']); ?></td>
                                <td><?php echo htmlspecialchars($val['id']); ?></td>
                                <td><?php echo date('d-m-Y', $date); ?></td>
                                <td><?php echo ($val['gender']==0)?'Nữ':'Nam'; ?></td>
                                <td><?php echo htmlspecialchars($val['phone']); ?></td>
                                <td><?php echo htmlspecialchars($val['address']); ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/booking/del_guest/<?php echo $val['guest_id']; ?>"><button type="button" class="btn btn-default btn-xs del-btn"><i class="fa fa-times"></i> Xóa</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="7">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer no-border">
                <a href="<?php echo base_url().'admin/booking/guest/'.$booking_id; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</button></a>
                <?php echo isset($pagination)?$pagination:''; ?>
            </div>
        </div>
    </div>
</div>