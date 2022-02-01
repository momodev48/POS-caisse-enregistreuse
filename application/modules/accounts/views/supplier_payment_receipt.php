<link href="<?php echo base_url('application/modules/accounts/assets/css/supplier_payment_receipt.css') ?>" rel="stylesheet" type="text/css"/>

<!-- Printable area start -->
<script src="<?php echo base_url('application/modules/accounts/assets/js/supplier_payment_receipt_script.js'); ?>" type="text/javascript"></script>
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' class="supplier_payment_receipt_f_family" >
                                <table border="0" width="100%">
                                    <tr>
                                        <td>

                                            <table border="0" width="100%">
                                                
                                                <tr>
                                                    <td align="center" class="supplier_payment_receipt_td">
                                                      
                                                        <span  class="supplier_payment_receipt_f_17" >
                                                            <?php echo $company_info->storename;?>
                                                        </span><br>
                                                        <?php echo $company_info->address;?><br>
                                                        <?php echo $company_info->phone;?><br>
                                                       
                                                        
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td align="center"><?php echo $supplier_info->supName;?><br>
                                                        <?php if ($supplier_info->supAddress) { ?>
                                                            <?php echo $supplier_info->supAddress;?><br>
                                                        <?php } ?>
                                                        <?php if ($supplier_info->supMobile) { ?>
                                                           <?php echo $supplier_info->supMobile;?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><nobr>
                                                    <date>
                                                        <?php echo display('date')?>: <?php echo $payment_info->VDate;?> 
                                                    </date>
                                                </nobr></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo display('voucher_no'); ?> : <?php echo $payment_info->VNo?></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left"><?php echo display('payment_type'); ?> : <?php echo  'Payment';?></td>
                                    </tr>
                                    <tr>
                                    <td class="text-left"><?php echo display('amount'); ?> : <?php echo $payment_info->Debit;?></td>
                                    </tr>
                                     <tr>
                                    <td class="text-left"><?php echo display('remark'); ?> : <?php echo $payment_info->Narration;?></td>
                                    </tr>
                                </table>

                               
                               
                                </td>
                                 <tr>
                                    
                                    <td> <?php echo display('paid_by')?>: <?php echo $this->session->userdata('user_name');?>

                                        <div  class="supplier_payment_receipt_f_tp">
                                        <?php echo display('signature') ?>
                                          
                                    </div></td>
                                   
                                </tr>
                                </tr>
                                <tr>
                                    <td>Powered  By: <a href="#"><?php echo $company_info->storename;?></a></td>
                                     
                                </tr>
                                </table>


                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('accounts/accounts/supplier_payments'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>

                    </div>
                </div>
            </div>
        </div>
