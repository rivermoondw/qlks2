<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin khách đi cùng</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            validation_errors();
            ?>
            <div class="box-body">
                <div class="form-group <?php echo (form_error('fname')) ? 'has-error' : ''; ?>">
                    <label>Họ đệm</label>
                    <input type="text" class="form-control" placeholder="Nhập họ đệm" name="fname"
                           value="<?php echo set_value('fname', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('lname')) ? 'has-error' : ''; ?>">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="Nhập tên" name="lname"
                           value="<?php echo set_value('lname', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('id')) ? 'has-error' : ''; ?>">
                    <label>Chứng minh thư</label>
                    <input type="text" class="form-control" placeholder="Nhập chứng minh thư" name="id"
                           value="<?php echo set_value('id', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('dob')) ? 'has-error' : ''; ?>">
                    <label>Ngày sinh</label>
                    <input type="text" class="form-control" placeholder="Nhập ngày sinh" name="dob"
                           value="<?php echo set_value('dob', ''); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
                <div class="form-group">
                    <label>Giới tính: </label>
                    <input type="radio" name="gender" value="0" class="flat-red" checked>
                    <label>Nam </label>
                    <input type="radio" name="gender" value="1" class="flat-red">
                    <label>Nữ</label>
                </div>
                <div class="form-group <?php echo (form_error('phone')) ? 'has-error' : ''; ?>">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                           value="<?php echo set_value('phone', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('address')) ? 'has-error' : ''; ?>">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address"
                           value="<?php echo set_value('address', ''); ?>">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary">
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (left) -->
</div>
<!-- /.row -->