<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('image') ?></th>
                            <th><?php echo display('category_name') ?></th>
                            <th><?php echo display('parent_menu') ?></th> 
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)) { 
						?>
                            <?php $sl = $pagenum+1;; ?>
                            <?php foreach ($categories as $category) {
								$parentname='';
								if($category->parentid>0){
								$test=$this->category_model->findById($category->parentid);
								$parentname=$test->Name;
								}
								$catid=$category->CategoryID;
								$this->load->model('itemmanage/category_model','categorymodel'); 
								$itemexist= $this->categorymodel->checkcategoryitem($catid);
								if(!empty($itemexist)){
									$alerttext="If You Delete this Category.then Your Food also Deleted!!!!";
								}
								else{
									$alerttext=display("are_you_sure");
								}
								 ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><img src="<?php echo base_url(!empty($category->CategoryImage)?$category->CategoryImage:'assets/img/icons/default.jpg'); ?>" alt="Image" width="80"></td>
                                    <td><?php echo $category->Name; ?></td>
                                    <td><?php if($category->parentid==0){echo "";}else{echo $parentname;} ?></td>
                                    <td><?php if($category->CategoryIsActive==1){echo "Active";}else{echo "Inactive";} ?></td>
                                    <td class="center">
                                    <?php if($this->permission->method('itemmanage','update')->access()): ?>
                                        <a href="<?php echo base_url("itemmanage/item_category/create/$category->CategoryID") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('itemmanage','delete')->access()): ?>
                                        <a href="<?php echo base_url("itemmanage/item_category/delete/$category->CategoryID") ?>" onclick="return confirm('<?php echo $alerttext; ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"></div>
            </div>
        </div>
    </div>
</div>
 
