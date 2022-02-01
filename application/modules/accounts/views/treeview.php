
<link href="<?php echo base_url('application/modules/accounts/assets/css/treeview.css') ?>" rel="stylesheet" type="text/css"/>
<?php 
 function allpheadtable($headlist){
		foreach($headlist as $menu){
			 echo '<tr><td>'.$menu->HeadCode.'</td><td>'.$menu->HeadName.'</td><td>'.$menu->PHeadName.'</td><td>'.$menu->HeadType.'</td><td>&nbsp;</td></tr>';
			if(!empty($menu->sub)){
				all_subpheadtable($menu->sub);
			}
		}
	}
function all_subpheadtable($sub_menu){
	foreach($sub_menu as $menu){
		$update='';
		$remove='';
		$alerttxt="You Can not Remove this Head!!! Because the Head have some Child Head";
		 $ci =& get_instance();
		 if($ci->permission->method('accounts','update')->access()):
		$update='<input name="url" type="hidden" id="url_'.$menu->HeadCode.'" value="'.base_url("accounts/accounts/updatecoa").'" /><a onclick="editinfo('.$menu->HeadCode.')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;';
		endif; 
		if($ci->permission->method('accounts','delete')->access()): 
		$exitid = $ci->db->select("*")->from('acc_coa')->where('PHeadName',$menu->HeadName)->get()->row();
		if(!empty($exitid)){
			$remove='<a  onclick="return confirm(\''.$alerttxt.'\')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>'; 
		}
		 else{
			 $remove='<a href="'.base_url("accounts/accounts/deletehead/$menu->HeadCode").'" onclick="return confirm(\''.display("are_you_sure").'\')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
			 }
		endif;
		
		
		echo '<tr><td>'.$menu->HeadCode.'</td><td>'.$menu->HeadName.'</td><td>'.$menu->PHeadName.'</td><td>'.$menu->HeadType.'</td><td>'.$update.$remove.'</td></tr>';
		if(!empty($menu->sub)){
			
				all_subpheadtable($menu->sub);
				
		}		
	}
}	
	?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">   
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('update');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>         
             <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                         
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
<?php if($this->permission->method('accounts','update')->access() || $this->permission->method('accounts','create')->access()): ?>
                <div class="col-md-6" id="newform"></div>
                 <?php endif; ?>
            </div>
            			
                        <div class="row">
                        	<?php  echo form_open_multipart("accounts/accounts/insert_coa2");?>
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('coa_head')?> *</label>
                                    <div class="col-sm-8">
                                   <select name="coahead" class="form-control" onchange="selectparenthead()" id="coahead" required>
                                        <option value="" selected="selected"><?php echo display('coa_head')?></option> 
                                        <?php foreach($coa_head as $coa){?>
                                        <option value="<?php echo $coa->HeadName;?>" class='bolden' data-lebel="<?php echo $coa->HeadType;?>" data-pheadlevel="<?php echo $coa->HeadLevel;?>" data-headcode="<?php echo $coa->HeadCode;?>"><?php echo $coa->HeadName;?></option>
                                         <?php } ?>
                                    </select>
                                    <input name="headcode" type="hidden" value="" id="headcode" />
                                    <input name="pheadcode" type="hidden" value="" id="pheadcode" />
                                    <input name="headlebel" type="hidden" value="" id="headlebel" />
                                    <input name="headtype" type="hidden" value="" id="headtype" />
                                    </div>
                    			</div>
                                <div class="form-group row">
                                <label for="firstname" class="col-sm-4 col-form-label">Head Name *</label>
                                <div class="col-sm-8">
                                    <input name="headname" class="form-control" type="text" placeholder="Head Name" id="headname"  value="<?php echo (!empty($categoryinfo->Name)?$categoryinfo->Name:null) ?>" required>
                                </div>
                    </div>
                    		</div>
                    		<div class="col-lg-7">
                              <div class="form-group row">
                                    <label for="lastname" class="col-sm-4 col-form-label">Parent Head Name</label>
                                    <div class="col-sm-8">
                                       <select name="Parentcategory" class="form-control" id="Parentcategory" onchange="getheadcode()">
                                            <option value="" selected="selected">Parent Head Name</option> 
                                        </select>
                                    </div>
                    </div>
                    		  <div class="form-group row">
                                    <label for="lastname" class="col-sm-6 col-form-label"><input type="checkbox" name="IsTransaction" value="1" id="IsTransaction" size="28"><label for="IsTransaction"> Transaction</label>
        <input type="checkbox" value="1" name="IsActive" id="IsActive" checked="" size="28"><label for="IsActive"> Active</label>
        <input type="checkbox" value="1" name="IsGL" id="IsGL" size="28"><label for="IsGL"> GL</label></label>
                                    <div class="col-sm-6">
                                       <div class="form-group text-right">
                                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                            <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                                        </div>
                                    </div>
                    			</div>
                            </div>
                            </form>
                            <div class="col-lg-12">
                            <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo "Head Code"; ?></th>
                            <th><?php echo "Head Name"; ?></th>
                            <th><?php echo "Parent Head"; ?></th>
                            <th><?php echo "Head Type"; ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php allpheadtable($allheadname); ?>
                                

                    </tbody>
                </table>
                </div>
                        </div>
 </div> 
</div>
 </div> 
</div>
<script src="<?php echo base_url('application/modules/accounts/assets/js/treeview_script.js'); ?>" type="text/javascript"></script>