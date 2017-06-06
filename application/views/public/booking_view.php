<div class="row">
    <div class="box">
        <div class="col-md-6">
            <hr>
            <h2 class="intro-text text-center">Tìm kiếm phòng trống</h2>
            <hr>
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Email Address</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label>Message</label>
                        <textarea class="form-control" rows="6"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="save" value="contact">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            <?php
            echo form_close();
            ?>
        </div>
        <div class="col-md-6">
            <hr>
            <h2 class="intro-text text-center">Thông tin khách hàng</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, vitae, distinctio, possimus repudiandae cupiditate ipsum excepturi dicta neque eaque voluptates tempora veniam esse earum sapiente optio deleniti consequuntur eos voluptatem.</p>
            <?php
            $att = array('role' => 'form');
            echo form_open('', $att);
            ?>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Email Address</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label>Message</label>
                        <textarea class="form-control" rows="6"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="save" value="contact">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>