<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
        <div class="col-sm-12 col-md-12">
           <div class="panel panel-bd lobidrag">
          
            <div class="form-group text-right">
 <?php if($this->permission->method('purchase','create')->access()): ?>
<a href="<?php echo base_url("purchase/purchase/create")?>" class="btn btn-primary btn-md"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('purchase_add')?></a> 
<?php endif; ?>

</div> 
            <div class="panel-body" id="printArea">
            <div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								
							</div>
             <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('ingredients') ?></th>
                                        <th><?php echo display('qnty') ?>  </th>
                                       
                                       
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <?php 
                                    $sl=1;
                                    foreach ($outstock as $details) {?>
                                      
                                   
                                    <tr>
                                        <td ><?php echo $details->ingredient_name; ?></td>
                                        <td><?php echo $details->stock_qty; ?></td>
                                        
                                        
                                    </tr>                              
                                <?php $sl++; } 
                                 ?>
                                </tbody>                               
                               
                            </table>
            </div> 
             <div class="text-center purchase_outstock" id="print" >
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                
            </div>
        </div> 
        </div>
    </div>
    <script src="<?php echo base_url('application/modules/purchase/assets/js/outstock_script.js'); ?>" type="text/javascript"></script>