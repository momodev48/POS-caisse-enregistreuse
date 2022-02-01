<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/splitorder.css'); ?>">


            <div id="payprint_marge" class="modal-dialog modal-inner" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><ul class="nav nav-tabs" role="tablist">
                        	<?php 
							if(!empty($tablefloor)){
							$f=0;	
							foreach($tablefloor as $floor){
							$f++;	
							?>
                        	<li class="<?php if($f==1){ echo "active";}?>"> <a href="#floor<?php echo $floor->tbfloorid;?>" id="florlist<?php echo $f;?>" role="tab" data-toggle="tab" class="home" onclick="showfloor(<?php echo $floor->tbfloorid;?>)"><?php echo $floor->floorName;?></a> </li>
                            <?php } } ?>
                        </ul></h4>
                    </div>
                    <div class="modal-body">
                    	
                         <div class="tab-content">
                         	<?php 
							if(!empty($tablefloor)){
							$a=0;	
							foreach($tablefloor as $floor){
							$a++;	
							?>
        					<div class="tab-pane fade <?php if($a==1){echo "active in";}?>" id="floor<?php echo $floor->tbfloorid;?>"></div>
                            <?php } } ?>
                         </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="multi_table()"class="btn btn-success btn-md"><?php echo display('submit')?></button>
                        <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><?php echo display('cancel')?></button>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function(){
    			$("#florlist1").trigger("click");
			});
	</script>
	
});
