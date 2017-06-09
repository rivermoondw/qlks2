<div class="row">
    <?php
    $att = array('role' => 'form');
    echo form_open('', $att);
    ?>
    <div class="col-md-12">
        <div class="box box-solid">
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
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Thống kê thuê phòng</h3>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tên phòng</th>
                        <th>Hạng phòng</th>
                        <th>Loại phòng</th>
                        <th>Số lượt thuê</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_room) && count($list_room)){
                        foreach ($list_room as $key => $val){
                            $count = $val['count']['count'];
                            $ave = ($sum_count['count']!=0)?($count/$sum_count['count'])*100:0;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($val['room']); ?></td>
                                <td><?php echo $val['rank']; ?></td>
                                <td><?php echo $val['type']; ?></td>
                                <td>
                                    <div class="clearfix">
                                        <?php echo $count.'/'.$sum_count['count'];?>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-green" style="width: <?php echo $ave;?>%;"></div>
                                    </div>
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
    <!-- left -->
    <div class="col-md-6">
    </div>
</div>