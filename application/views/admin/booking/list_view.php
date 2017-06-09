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
<div class="ajax">
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
            <div class="box-header">
                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Tìm kiếm theo tên khách hàng" id="search_name" name="search_name">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
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
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                        <th>Tên khách đặt</th>
                        <th>Ngày đặt</th>
                        <th>Ngày đến</th>
                        <th>Ngày trả</th>
                        <th>Phòng đặt</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_booking) && count($list_booking)){
                        foreach ($list_booking as $key => $val) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="<?php echo $val['booking_id']; ?>">
                                </td>
                                <td><a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><b><?php echo htmlspecialchars($val['fname'] . ' ' . $val['lname']); ?></b></a>
                                </td>
                                <td><a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo htmlspecialchars($val['create_date']); ?></a></td>
                                <td><a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo htmlspecialchars($val['start_date']); ?></a></td>
                                <td><a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo htmlspecialchars($val['end_date']); ?></a></td>
                                <td>
                                    <a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333">
                                        <?php
                                        $temp = array();
                                        foreach ($val['list_room'] as $k => $vl) {
                                            $temp[$k] = $vl['room'];
                                        }
                                        $str_list_room = implode(' - ', $temp);
                                        echo $str_list_room;
                                        ?>
                                    </a>
                                </td>
                                <td><a href="<?php echo base_url() . 'admin/booking/detail/' . $val['booking_id']; ?>"
                                       style="color: #333"><?php echo ($val['state'] == 0) ? 'Chưa trả phòng' : 'Đã trả phòng'; ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url(); ?>admin/booking/del/<?php echo $val['booking_id']; ?>">
                                        <button type="button" class="btn btn-default btn-xs del-btn"><i
                                                    class="fa fa-times"></i> Xóa
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo '<tr><td colspan="8">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
                <button type="submit" name="btn-delete" value="btn-delete" class="btn btn-default" id="del-list"><i class="fa fa-trash-o"></i> Xóa lựa chọn</button>
                <a href="<?php echo base_url(); ?>admin/booking/registry"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i> Đặt phòng</button></a>
                <?php echo isset($pagination)?$pagination:''; ?>
            </div>

            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>