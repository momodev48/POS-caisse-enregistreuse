<style>
  .paddingleft10px {
    padding-left: 10px;
}
.balancesheet_head {
    font-size: 14px;
    font-weight: bold;
}
</style>
<div class="row">
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-body"> 
            <?php echo form_open('accounts/accounts/balance_sheet', array('class' => 'form-inline', 'method' => 'post')) ?>
            <?php
            $today = date('Y-m-d');
            ?>
            <div class="form-group">
                <label class="" for="from_date"><?php echo display('start_date') ?></label>
                <input type="text" name="dtpFromDate" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $from_date ?>">
            </div> 

            <div class="form-group">
                <label class="" for="to_date"><?php echo display('end_date') ?></label>
                <input type="text" name="dtpToDate" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $to_date ?>">
            </div>  

            <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
          
            <?php echo form_close() ?>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="panel panel-bd lobidrag">
<div class="panel-heading">
<div class="panel-title">
<div class="text-right" id="print">
<input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv('printArea');"/>
</div>
</div>
</div>
<div class="panel-body" id="printArea">
<div class="paddin5ps">
               <table class="print-table " width="100%">
                                    
                                    <tr>
                                        <td align="left" class="print-table-tr">
                                            <img src="<?php echo base_url().$setting->logo;?>" alt="logo">
                                        </td>
                                        <td align="center" class="print-cominfo">
                                            <span class="company-txt">
                                                <?php //echo $company_info[0]['company_name'];?>
                                               
                                            </span><br>
                                            <?php //echo $company_info[0]['address'];?>
                                            <br>
                                            <?php //echo $company_info[0]['email'];?>
                                            <br>
                                             <?php //echo $company_info[0]['mobile'];?>
                                            
                                        </td>
                                       
                                         <td align="right" class="print-table-tr">
                                            <date>
                                            <?php echo display('date')?>: <?php
                                            echo date('d-M-Y');
                                            ?> 
                                        </date>
                                        </td>
                                    </tr>            
                       
                    </table>
<table width="100%" class="table_boxnew table-bordered" cellpadding="0" cellspacing="0">
<tr class="table_head">
    <td width="73%" height="29" align="center" class="cashflowparticular"><b><?php echo display('particulars');?></b></td>
   
    <td width="30%" align="right" class="cashflowamount"><b><?php echo display('amount');?></b></td>
</tr>
<?php 
$fullassets=0;
foreach($fixed_assets as $assets){
$total_assets = 0;
$head_data = $this->accounts_model->assets_info($assets['HeadName']);


?>
<tr >
      <td align="left" class="paddingleft10px <?php if($assets['HeadName'] =='Current Asset' || $assets['HeadName'] =='Non Current Assets'){echo 'balancesheet_head';}?>"><?php echo $assets['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         
      </td>
  </tr>
  <?php
 
   foreach($head_data as $assets_head){
      
   $ass_balance = $this->accounts_model->assets_balance($assets_head['HeadCode'],$from_date,$to_date);?>
<?php if($assets_head['PHeadName'] == 'Current Asset'){
$child_head_current = $this->accounts_model->asset_childs($assets_head['HeadName'],$from_date,$to_date);

?>
<tr>
      <td align="left" class="paddingleft10px"><?php echo $assets_head['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
        
      </td>
  </tr>  

  <?php foreach($child_head_current as $cchead){
    $cur_ass_balance = $this->accounts_model->assets_balance($cchead['HeadCode'],$from_date,$to_date);
     $schild_head_current = $this->accounts_model->asset_childs($cchead['HeadName'],$from_date,$to_date);
    ?>
    <?php if($cur_ass_balance[0]['balance'] <> 0){?>
<tr>
      <td align="left" class="paddingleft10px"><?php echo $cchead['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
        <?php echo $cur_ass_balance[0]['balance'];
        $total_assets += $cur_ass_balance[0]['balance'];
        ?>
      </td>
  </tr> 
<?php }?>

  <?php if($cchead['HeadName'] == 'Cash At Bank' || $cchead['HeadName'] == 'Account Receivable' || $cchead['HeadName'] == 'Customer Receivable' || $cchead['HeadName'] == 'Loan Receivable'){
  foreach($schild_head_current as $scchild){
    $cur_bank_balance = $this->accounts_model->assets_balance($scchild['HeadCode'],$from_date,$to_date);
   ?>
   <?php if($cur_bank_balance[0]['balance'] <> 0){?>
    <tr >
      <td align="left" class="paddingleft10px"><?php echo $scchild['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
        <?php echo $cur_bank_balance[0]['balance'];
        $total_assets += $cur_bank_balance[0]['balance'];
        ?>
      </td>
  </tr> 
<?php }?>
<?php }}?>
  <?php }?>
<?php }?>

    <?php if($assets_head['PHeadName'] == 'Non Current Assets'){?>
    <tr >
      <td align="left" class="paddingleft10px"><?php echo $assets_head['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
        <?php echo $ass_balance[0]['balance'];
        $total_assets += $ass_balance[0]['balance'];
        ?>
      </td>
  </tr>  

<?php }?>
      
<?php }?>

     <tr >
      <td class="text-right" style="padding-right: 10px;"><b><?php echo display('total')?>  <?php echo $assets['HeadName']; ?></b></td>
    
      <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
        <b><?php echo number_format($total_assets,2);?></b>
      </td>
  </tr>
<?php 
$fullassets=$fullassets+$total_assets;
}?>
<?php 
$totalliabilities=0;
foreach($liabilities as $liability){
$total_liab = 0;
$liab_head_data = $this->accounts_model->liabilities_info($liability['HeadName']);
?>
<tr>
      <td align="left" class="paddingleft10px <?php if($liability['HeadName'] =='Current Liabilities' || $liability['HeadName'] =='Non Current Liabilities'){echo 'balancesheet_head';}?>"><?php echo $liability['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         
      </td>
  </tr>
   <?php
 
   foreach($liab_head_data as $liab_head){
  
    if($liab_head['HeadName'] == 'Tax'){
        $child_liability = $this->accounts_model->liabilities_info_tax($liab_head['HeadName']);
    }else{
        $child_liability = $this->accounts_model->liabilities_info($liab_head['HeadName']);
    }
  	?>
   <?php  if($liab_head['HeadName'] != 'Tax'){?>
<tr>
      <td align="left" class="paddingleft10px"><?php echo $liab_head['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         <?php 
         $total_liab +=0;
          ?>
      </td>
  </tr>
<?php }?>

   <?php
 
   foreach($child_liability as $chliab_head){
  	$liab_balance = $this->accounts_model->liabilities_balance($chliab_head['HeadCode'],$from_date,$to_date);

  	?>
    <?php if($liab_balance[0]['balance'] <> 0){?>
<tr >
      <td align="left" class="paddingleft10px"><?php echo $chliab_head['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         <?php 

         echo  $liab_balance[0]['balance'];
         $total_liab += $liab_balance[0]['balance'];
          ?>
      </td>
  </tr>
<?php }?>

<?php }?>
<?php } ?>
<tr >
      <td class="paddingleft10px text-right"  style="padding-right: 10px;"><b><?php echo display('total')?>  <?php echo $liability['HeadName']; ?></b></td>
    
      <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
        <b><?php echo number_format($total_liab,2);?></b>
      </td>
  </tr>
<?php 
 $totalliabilities=$totalliabilities+$total_liab;}
?>
  <?php
 $total_expense = 0;
 $total_income = 0;
   foreach($incomes as $incomelable){
    $income_balance = $this->accounts_model->income_balance($incomelable['HeadCode'],$from_date,$to_date);
    ?>
    <tr>
      <td align="left" class="paddingleft10px balancesheet_head"><?php echo $incomelable['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         <?php echo $income_balance[0]['balance'];
         $total_income += $income_balance[0]['balance'];
         ?>
      </td>
    </tr>
    <?php }?>
<tr >
      <td class="paddingleft10px text-right"  style="padding-right: 10px;"><b><?php echo display('total')?>  <?php echo display('income'); ?></b></td>
    
      <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
        <b><?php echo number_format($total_income,2);?></b>
      </td>
  </tr>
     <?php
   foreach($expenses as $expense){
    $expense_balance = $this->accounts_model->income_balance($expense['HeadCode'],$from_date,$to_date);
    ?>
    <tr>
      <td align="left" class="paddingleft10px balancesheet_head"><?php echo $expense['HeadName']; ?></td>
    
      <td align="right" class="cashflowamnt" >
         <?php echo $expense_balance[0]['balance'];
           $total_expense += $expense_balance[0]['balance'];
         ?>
      </td>
    </tr>
    <?php }?>
    <tr>
      <td class="paddingleft10px text-right"  style="padding-right: 10px;"><b><?php echo display('total')?>  <?php echo display('expense'); ?></b></td>
    
      <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
        <b><?php echo number_format($total_expense,2);?></b>
      </td>
  </tr>
  <tr>
      <td class="paddingleft10px text-right"  style="padding-right: 10px;"><b><?php echo display('total')?>  <?php echo "Owner's Equity"; ?></b></td>
    
      <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
        <b><?php //$fullassets-$totalliabilities;
		echo number_format($fullassets-$totalliabilities,2);?></b>
      </td>
  </tr>

</table>
</div>
</div>
</div>
</div>
</div>
<script src="<?php echo base_url('application/modules/accounts/assets/js/coa_print_script.js'); ?>" type="text/javascript"></script>