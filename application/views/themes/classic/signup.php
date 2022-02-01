 
 <!--Start Login Area-->
    <section class="menu_area sect_pad">
        <div class="container wow fadeIn">
           <div class="row">
                <div class="col-sm-12">
                <div class="panel-body">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('message') ?>
                    </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('exception')) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('exception') ?>
                    </div>
                    <?php } ?>
                    <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo validation_errors() ?>
                    </div>
                    <?php } ?>
                                    <p>please enter your details in the boxes below.</p>
                                    <div class="rrtt">
                                      <?= form_open_multipart('hungry/submitregister','class="row"') ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email">Name</label>
                                                <input type="text" id="user_name" class="form-control" name="user_name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email">Email</label>
                                                <input type="email" id="user_email" class="form-control" name="user_email" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email">Phone</label>
                                                <input type="text" id="phone" class="form-control" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="u_pass">Password <abbr class="required" title="required">*</abbr></label>
                                                <input type="password" id="u_pass" class="form-control" name="u_pass" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email">Picture</label>
                                                <input name="UserPicture" id="UserPicture" type="file" style="width:100%;" />
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email">Address</label>
                                                <textarea name="address" class="form-control" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success btn-sm search" value="Reginter Now">&nbsp; OR &nbsp;<a href="<?php echo base_url().'mylogin'?>" class="btn btn-success btn-sm search">Login</a>
                                        </div>
                                        <?php echo form_close() ?>
                                   
                                </div>
            </div>
            </div>
            </div>
        </div>
    </section>
    <!--End Login Area-->
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/signup.js"></script>
    