
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            
            <div class="panel-body">
						<?php echo form_open("setting/kitchensetting/save_kitchenuser_access") ?>
                        <div class="form-group row">
                                <label for="user_id" class="col-sm-1 col-form-label"><?php echo display('user') ?> *</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="user_id" id="user_id" required="">
                                        <option value="">--Select--</option>
                                        <?php 
                                           foreach($alluser as $val){
                                            echo '<option value="'.$val->id.'">'.$val->firstname.' '.$val->lastname.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="role_id" class="col-sm-2 col-form-label"><?php echo display('kitchen_name') ?> *</label>
                                <div class="col-sm-3">
                               <select class="form-control" name="kitchen" id="kitchen" required="">
                                        <option value="">--Select--</option>                                        
                                        <?php 
                                           foreach($allkitchen as $kitchen){
                                            echo '<option value="'.$kitchen->kitchenid.'">'.$kitchen->kitchen_name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                            </div>
            <?php echo form_close();?>
			<table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('kitchen_name') ?></th>
                            <th><?php echo display('user') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($allkitchenuser)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($allkitchenuser as $allkitch) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $allkitch->kitchen_name; ?></td>                                   
                                    <td><?php echo $allkitch->firstname.' '.$allkitch->lastname; ?></td> 
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>










 
 