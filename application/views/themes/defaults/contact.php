 <!-- Contact Area -->
 <section class="contact_area sect_pad">
     <div class="container">
         <div class="row">
             <div class="col-sm-12">
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
                 <h3 class="mb-3"><?php echo display('get_in_touch')?></h3>
                 <?php echo form_open('hungry/sendemail','method="post"')?>
                     <div class="form-row">
                         <div class="form-group col-md-6">
                             <label for="firstname"><?php echo display('first_name') ?></label>
                             <input type="text" class="form-control" id="firstname" name="firstname" required>
                         </div>
                         <div class="form-group col-md-6">
                             <label for="lastname"><?php echo display('last_name') ?></label>
                             <input type="text" class="form-control" id="lastname" name="lastname" required>
                         </div>
                         <div class="form-group col-md-6">
                             <label for="email"><?php echo display('email') ?></label>
                             <input type="email" class="form-control" id="email" name="email" required>
                         </div>
                         <div class="form-group col-md-6">
                             <label for="phone"><?php echo display('phone') ?></label>
                             <input type="number" class="form-control" id="phone" name="phone" required>
                         </div>

                         <div class="form-group col-md-12">
                             <label for="comments"><?php echo display('write_comments')?></label>
                             <textarea class="form-control" id="comments" rows="5" name="comments" required></textarea>
                         </div>
                     </div>
                     <button type="submit" class="btn btn-success"><?php echo display('send') ?></button>
                 </form>
             </div>
         </div>
     </div>
 </section>
 <!-- End Contact Area -->