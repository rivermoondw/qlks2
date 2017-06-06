<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php echo validation_errors(); ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
            <div class="box-body">
                <div class="form-group <?php echo (form_error('room')) ? 'has-error' : ''; ?>">
                    <label>Tên phòng</label>
                    <input type="text" class="form-control" placeholder="Nhập tên phòng" name="room"
                           value="<?php echo set_value('room', ''); ?>">
                </div>
                <div class="form-group <?php echo (form_error('tel')) ? 'has-error' : ''; ?>">
                    <label>Số điện thoại phòng</label>
                    <input type="text" class="form-control" placeholder="Nhập số điện thoại phòng" name="tel"
                           value="<?php echo set_value('tel', ''); ?>">
                </div>
                <div class="form-group">
                    <label>Hạng phòng</label>
                    <select class="form-control select2" name="rank_id" style="width: 100%;">
                        <?php
                        foreach ($rank as $key => $val) {
                            echo '<option value="' . $val['rank_id'] . '">' . $val['rank'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Loại phòng</label>
                    <select class="form-control select2" name="type_id" style="width: 100%;">
                        <?php
                        foreach ($type as $key => $val) {
                            echo '<option value="' . $val['type_id'] . '">' . $val['type'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group <?php echo (form_error('price')) ? 'has-error' : ''; ?>">
                    <label>Giá phòng</label>
                    <input type="text" class="form-control" placeholder="Nhập giá phòng" name="price"
                           value="<?php echo set_value('price', ''); ?>">
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