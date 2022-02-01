<div class="row">
     <div class="col-md-12">
            <div class="panel sms-form">
                <div class="panel-body">
                    <p>
                     To get <b>50</b> free sms from smsrank.com click <b><a href="http://door.smsrank.com/signup" target="_blank">here</a></b> and register in registration section click Already envato user and put your envato purchace key and product id  after registration put your username and password into the password and user name field this form. 
                 </p>
             </div>
         </div>
     </div>
     <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
             <?php echo form_open('setting/smsetting/update_sms_configuration', array('method'=>'post','role'=>'form')); ?> 
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="center bg-success">
                            <th><?php echo display('status');?></th>
                            <th><?php echo display('gateway');?> </th>
                            <th><?php echo display('username');?> </th>
                            <th><?php echo display('password');?> </th>
                            <th><?php echo display('userid');?> </th>
                            <th><?php echo display('from');?> </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php  foreach ($gateways as $gateway) { ?> 
                            <tr> 
                                <input type="hidden" name="id[]" value="<?php echo $gateway['id'];?>">
                                <td><input type="radio" name="status[]" <?php echo $gateway['status']==1?'checked':''?> class="form-control" value="<?php echo $gateway['id'];?>"></td>
                                <td><?php echo '<a target="_blank" href="'.$gateway['link'].'">'.$gateway['gateway'].'</a>'?></td>
                                <td><input type="text" class="form-control" value="<?php echo $gateway['user_name'];?>" name="user_name[]"></td>
                                <td>
                                    <?php if(3 == $gateway['id']) {?>
                                        <input type="text" class="form-control" data-toggle="tooltip" title="handle" value="<?php echo $gateway['password']?>" name="password[]">
                                    <?php }else{ ?>
                                        <input type="text" class="form-control" value="<?php echo $gateway['password']?>" name="password[]">
                                    <?php }?>
                                   </td>
                                   <?php if(3 != $gateway['id']){?>
                                    <td><input type="text" class="form-control" readonly value="<?php echo $gateway['userid']?>" name="userid[]"></td>
                                <?php }else{?>
                                    <td><input type="text" class="form-control" value="<?php echo $gateway['userid']?>" name="userid[]"></td>
                                <?php };?>
                                <td><input type="text" class="form-control" value="<?php echo $gateway['sms_from']?>" name="sms_from[]"></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
             <div class="form-group text-right">
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update');?></button>
                    </div>
             </form>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url('application/modules/setting/assets/js/sms-form.js'); ?>" type="text/javascript"></script>