 <div class="modal fade" id="lostpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"><?php echo display('forgot_password')?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body passwordupdate">
                 <div class="form-group">
                     <label class="control-label" for="user_email"><?php echo display('please_enter_your_email')?></label>
                     <input type="text" id="user_email2" class="form-control" name="user_email2">
                 </div>
                 <a onclick="lostpassword();" class="btn btn-success btn-sm lost-pass"><?php echo display('submit')?></a>
             </div>

         </div>
     </div>
 </div>
 <!--Start Login Area-->
 <section class="menu_area sect_pad">
     <div class="container wow fadeIn">
         <div class="row p-4">
             <div class="panel-body">
                 <p><?php echo display('shopping_details_information_msg')?></p>
                 <div class="row">
                     <div class="col-sm-6">
                         <div class="form-group">
                             <label class="control-label" for="user_email"><?php echo display('email') ?></label>
                             <input type="text" id="user_email" class="form-control" name="user_email">
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <label class="control-label" for="u_pass"><?php echo display('password') ?> <abbr class="required" title="required">*</abbr></label>
                             <input type="password" id="u_pass" class="form-control" name="u_pass">
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="checkbox checkbox-success">
                             <input id="brand1" type="checkbox">
                             <label for="brand1"><?php echo display('remember_me')?></label>
                             <a   class="lost-pass login_pa_cursor" data-toggle="modal" data-target="#lostpassword" data-dismiss="modal"><?php echo display('forgot_password')?></a>
                         </div>
                         <a  class="btn btn-success btn-sm search login_pa_cursors" onclick="logincustomer();"><?php echo display('login')?></a>&nbsp; <?php echo display('or')?> &nbsp;<a href="<?php echo base_url() . 'hungry/signup' ?>" class="btn btn-success btn-sm search"><?php echo display('register')?></a><?php $facrbooklogn = $this->db->where('directory', 'facebooklogin')->where('status', 1)->get('module')->num_rows(); if ($facrbooklogn == 1) { ?>&nbsp; <?php echo display('or')?> &nbsp;
                         <a class="btn btn-primary btn-sm  search text-white" href="<?php echo base_url('facebooklogin/facebooklogin/index/1') ?>"><i class="fa fa-facebook pr-1"></i><?php echo display('facebook_login') ?></a>
                     <?php } ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <?php 
 $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>
 <!--End Login Area-->
 <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/login.js"></script>
