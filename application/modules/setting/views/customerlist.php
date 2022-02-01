<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#client-info" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_customer')?></button> 

<?php endif; ?>

</div>
<?php echo form_open('setting/customerlist/insert_customer','method="post" class="form-vertical" id="validate"')?>
            <div class="modal fade modal-warning" id="client-info" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title"><?php echo display('add_customer');?></h3>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label"><?php echo display('customer_name');?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="Customer Name"  required="">
                                </div>
                            </div>
       
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label"><?php echo display('email');?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Customer Email"  required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile');?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="Customer Mobile"  required="" min="0">
                                </div>
                            </div>
       						<div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('password');?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="<?php echo display('password');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('b_address');?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="address" id="address " rows="3" placeholder="Customer Address"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('fav_addesrr');?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="favaddress" id="favaddress " rows="3" placeholder="Customer Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close');?> </button>
                            <button type="submit" class="btn btn-success"><?php echo display('submit');?> </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('update_member');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div id="add1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content customer-list">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('bulk_upload');?></strong>
            </div>
            <div class="modal-body">
           <div class="container">    
             <br>
             
             <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="form-control alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <h3>You can export test.csv file Example-</h3>
            <h4>memberid,membername,mobile,status</h4>
            <h4>1,jhon doe,01717426371,Active</h4>
            <h2><?php echo display('import_customer')?> <?php echo display('upload_csv')?></h2>               
                       <?php echo form_open_multipart('setting/customerlist/importmembercsv',array('class' => 'form-vertical', 'id' => 'validate','name' => 'insert_attendance'))?>
                    <input type="file" name="userfile" id="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
       <?php echo form_close()?>
           
        
            
        </div>     

    </div>

</div>
</div>
</div>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('customer_name') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customerlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($customerlist as $customer) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $customer->customer_name; ?></td>
                                    <td><?php echo $customer->customer_email; ?></td>
                                    <td><?php echo $customer->customer_phone; ?></td>
                                     <td><?php echo $customer->customer_address; ?></td>
                                     <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $customer->customer_id; ?>" value="<?php echo base_url("setting/customerlist/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $customer->customer_id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif;?> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"><?php ?></div>
            </div>
        </div>
    </div>
</div>

     
