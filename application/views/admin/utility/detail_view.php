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
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">Tiện nghi trong phòng</h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Tiện nghi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_utility) && count($list_utility)){
                        foreach ($list_utility as $key => $val){
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($val['utility']); ?></td>
                                <td><a href="<?php echo base_url(); ?>admin/utility/del_utility/<?php echo $val['roomutility_id']; ?>"><button type="button" class="btn btn-default btn-xs del-btn"><i class="fa fa-times"></i> Xóa</button></a></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="2">Không có dữ liệu</td></tr>';
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
                <?php
                $att = array('role' => 'form');
                echo form_open('', $att);
                ?>
                <div class="form-group">
                    <select class="form-control select2" name="utility_id[]" multiple="multiple" data-placeholder="Nhập dịch vụ" style="width: 100%;">
                        <?php
                        foreach ($list_utility_aval as $key => $val) {
                            echo '<option value="' . $val['utility_id'] . '">' . $val['utility'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="add_utility" value="add_utility"><i class="fa fa-plus"></i> Thêm</button>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();
?>