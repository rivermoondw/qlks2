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
                <div class="form-group">
                    <label>Tên dịch vụ</label>
                    <input type="text" class="form-control" placeholder="Nhập tên dịch vụ" name="service"
                           value="<?php echo set_value('service', $service['service']); ?>">
                </div>
                <div class="form-group">
                    <label>Giá dịch vụ</label>
                    <input type="text" class="form-control" placeholder="Nhập giá dịch vụ" name="price"
                           value="<?php echo set_value('price', $service['price']); ?>">
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