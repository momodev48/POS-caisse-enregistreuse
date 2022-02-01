<div class="row">
        <div class="col-md-12">
            <div  class="panel panel-default panel-form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-body">
                            <div class="portlet-body form">
                            <?php  
                                echo form_open_multipart('dashboard/smsetting/save_sms_template', array('class' => 'form-horizontal','method'=>'post','id' => 'MyForm','role'=>'form'));  
                            ?>
                                
                            <div class="form-body">
                               <input type="hidden" name="id" id="id" value=""/>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php echo display('template_name');?> : </label>
                                        <div class="col-md-8">
                                            <input type="text" id="template_name" class="form-control" value="" required="1" name="template_name" placeholder="<?php echo display('template_name');?>">
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php echo display('type');?> : </label>
                                        <div class="col-md-8">
                                            <?php echo form_dropdown('type', array('' => 'Select Option','Cancel' => 'Cancel', 'Neworder' =>'New Order',  'CompleteOrder' => 'Complete Order',  'Processing' => 'Processing'), null, array('class'=>'form-control dont-select-me', 'id'=>'type', 'required'=>'required')) ?> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php echo display('sms_template');?> : </label>
                                        <div class="col-md-8">
                                             <textarea name="message" id="message" value="" class="form-control" required="1" rows="6"></textarea>
                                        </div>
                                    </div> 
                                </div>

                                   <div class="form-group row">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                            <button type="submit" class="btn btn-success sav_btn"><?php echo display('submit');?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel-body">
                           <p  class="dashboard_sms_template">
                               <?php echo display('sms_template_warning');?>
                           </p>
                        </div>
                    </div>
                </div>
            </div>  
         </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ng-scope">
                <h2> <?php echo display('sms_template_list');?></h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="center">
                                <th class="all"> <?php echo display('set_default');?> </th>
                                <th class="all"><?php echo display('template_name');?></th>
                                <th class="all"><?php echo display('type');?></th>
                                <th class="all"><?php echo display('sms_template');?> </th>
                                <th class="all"><?php echo display('action');?> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($template as $value) {?>
                            <tr>
                                <td> 
                                    <a class="btn btn-info" href="<?php echo base_url(); ?>dashboard/smsetting/set_default_template/<?php echo $value->id . '/' . $value->default_status; ?>"><span class="glyphicon glyphicon-<?php echo $value->default_status==1?'ok':'remove';?>"></span></a>
                                </td>
                                <td id="t_<?php echo $value->id;?>"><?php echo $value->template_name; ?></td>
                                <td id="ts_<?php echo $value->type; ?>"><?php echo $value->type; ?></td>
                                <td id="td_<?php echo $value->id;?>"><?php echo $value->message; ?></td>
                                
                                <td width="70">
                                    <a data-id="<?php echo $value->id;?>" class="edit btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> </a>
                                    <a  class="btn btn-xs btn-danger" href="<?php echo base_url();?>dashboard/smsetting/delete_teamplate/<?php echo $value->id ;?>" onclick="return confirm('Are you want to delelte?');">
                                    <i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo base_url('application/modules/dashboard/assest/js/banner.js'); ?>" type="text/javascript"></script>