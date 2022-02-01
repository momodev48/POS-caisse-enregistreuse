<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_city')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_city');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/country_city_list/createcity') ?>
                    <?php echo form_hidden('cityid', (!empty($intinfo->cityid)?$intinfo->cityid:null)) ?>
                    	<div class="form-group row">
                        <input name="country" type="hidden" id="country"/>
                        <label for="state" class="col-sm-4 col-form-label"><?php echo display('state') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="state" id="state" class="form-control" onchange="getcountry()">
                                <option value=""  selected="selected">Select Option</option>
                                <?php foreach($allstate as $single){?>
                                <option value="<?php echo $single->stateid;?>" data-title="<?php echo $single->countryid;?>"><?php echo $single->statename;?></option>
                                <?php } ?>
                              </select>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="state" class="col-sm-4 col-form-label"><?php echo display('city') ?> *</label>
                            <div class="col-sm-8">
                                <input name="city" class="form-control" type="text" placeholder="Add <?php echo display('city') ?>" id="city" value="">
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('edit_city');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('state') ?></th>
                            <th><?php echo display('city') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($citilist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($citilist as $city) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $city->statename; ?></td>
                                    <td><?php echo $city->cityname; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $city->cityid; ?>" value="<?php echo base_url("setting/country_city_list/updatecityfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $city->cityid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): ?>
                                        <a href="<?php echo base_url("setting/country_city_list/deletecity/$city->cityid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"><?php echo @$links?></div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/setting/assets/js/citylist.js'); ?>" type="text/javascript"></script>
     
