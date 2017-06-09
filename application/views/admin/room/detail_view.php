<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Thông tin phòng</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Tên phòng</th>
                        <th>Số điện thoại</th>
                        <th>Hạng phòng</th>
                        <th>Loại phòng</th>
                        <th>Đơn giá</th>
                        <th>Tình trạng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $room['room'];?></td>
                        <td><?php echo $room['tel'];?></td>
                        <td><?php echo $room['rank'];?></td>
                        <td><?php echo $room['type'];?></td>
                        <td><?php echo $room['price'];?></td>
                        <td><?php echo ($room['state']==0)?'Còn trống':'Đang thuê';?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($room['state']==1){
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <a href="<?php echo base_url(); ?>admin/payment/paymentroom/<?php echo $bookingroom_id;?>"><button type="button" class="btn btn-success" id="confirm"><i class="fa fa-check"></i> Trả phòng</button></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Thông tin khách hàng</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Chứng minh thư</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $customer['fname'].' '.$customer['lname'];?></td>
                        <td><?php echo $customer['id'];?></td>
                        <td><?php echo $customer['dob'];?></td>
                        <td><?php echo $customer['gender'];?></td>
                        <td><?php echo $customer['phone'];?></td>
                        <td><?php echo $customer['address'];?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$att = array('role' => 'form');
echo form_open('', $att);
?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Dịch vụ sử dụng</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Dịch vụ</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_service) && count($list_service)){
                        foreach ($list_service as $key => $val){
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($val['service']); ?></td>
                                <td><?php echo htmlspecialchars($val['price']); ?></td>
                                <td><?php echo htmlspecialchars($val['count']); ?></td>
                                <td>
                                    <button type="submit" class="btn btn-success btn-xs" name="add" value="<?php echo htmlspecialchars($val['bookingservice_id']); ?>"><i class="fa fa-plus-circle"></i></button>
                                    <button type="submit" class="btn btn-danger btn-xs" name="sub" value="<?php echo htmlspecialchars($val['bookingservice_id']); ?>"><i class="fa fa-minus-circle"></i></button>
                                </td>
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
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Đăng ký dịch vụ</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <select class="form-control select2" name="service_id[]" multiple="multiple" data-placeholder="Nhập dịch vụ" style="width: 50%;">
                        <?php
                        foreach ($list_service_aval as $key => $val) {
                            echo '<option value="' . $val['service_id'] . '">' . $val['service'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="add_service" value="add_service"><i class="fa fa-plus"></i> Thêm</button>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();
}
?>