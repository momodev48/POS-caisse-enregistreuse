<script src="<?php echo base_url('application/modules/accounts/assets/js/cash_flow_report_search_script.js'); ?>" type="text/javascript"></script>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('cash_flow') ?></h4>
                </div>
            </div>
            <div id="printArea">
                <div class="panel-body">
                  <div  class="cash_flow_report_search_table_body">
                      <table width="100%" class="table_boxnew" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="center"><h2 class="cash_flow_re_serach_h2"><?php echo display('cash_flow_statement');?>  </h2></td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" align="center" class="cash_flow_re_serach_ml_10" ><b>On <?php echo $dtpFromDate; ?> To <?php echo $dtpToDate;?></b></td>
                        </tr>
                        <tr class="table_head">
                            <td width="73%" height="29" align="center" class="cash_flow_re_serach_ml_b"><b><?php echo display('particls')?></b></td>
                            <td width="2%">&nbsp;</td>
                            <td width="30%" align="right" class="cash_flow_re_serach_ml_right" ><b><?php echo display('amount_in_Dollar');?></b></td>
                        </tr>
                         <tr class="table_head">
                          <td colspan="3" class="cash_flow_re_serach_ml_underline_10px_left" ><strong><?php echo display('opening_cash_and_equivalent');?>:</strong></td>
                        </tr>
                        <?php
                          $sql="SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%'";

                          $sql = $this->db->query($sql);
                          $oResultAsset = $sql->result();
                  
                          $TotalOpening=0;
                          for($i=0;$i<count($oResultAsset);$i++)
                          {
                            $COAID=$oResultAsset[$i]->HeadCode;
                            $sql="SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%'";

                            $sql1 = $this->db->query($sql);
                            $oResultAmountPre = $sql1->row();
                            if($oResultAmountPre->Amount!=0)
                            {
                        ?>
                          <tr >
                              <td align="left" class="cash_flow_re_serach_ml_10"><?php echo $oResultAsset[$i]->HeadName; ?></td>
                              <td>&nbsp;</td>
                              <td align="right" style="padding-right:10px; border-left: solid 1px #000; border-right:solid 1px #000;<?php if($TotalOpening==0) echo "border-top: solid 1px #000;"; ?>">
                                  <?php 
                                      $Total=$oResultAmountPre->Amount;
                                      echo number_format($Total);
                              
                                      $TotalOpening+=$Total; 
                                  ?>
                              </td>
                          </tr>
                                <?php
                            }
                          }
                        ?>
                        <tr>
                          <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td  class="cash_flow_re_serach_border_t" >&nbsp;</td>
                        </tr>
                        <tr>
                         <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('topeneqv')?></strong></td>
                          <td>&nbsp;</td>
                           <td align="right" class="cash_flow_re_serach_ml_rightalign"><strong><?php echo number_format($TotalOpening); ?></strong></td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" class="cash_flow_re_serach_ml_underline"><b><?php echo display('cashopen')?></b></td>
                        </tr>
                        <?php
                            $TotalCurrAsset=0;
                            $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '102%' AND IsActive=1 AND HeadCode NOT LIKE '1020101%' AND HeadCode!='102' ";

                            $sql2 = $this->db->query($sql);
                            $oResultCurrAsset = $sql2->result();

                            for($s=0;$s<count($oResultCurrAsset);$s++)
                            {
                              $COAID=$oResultCurrAsset[$s]->HeadCode;
                              $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                              $sql3 = $this->db->query($sql);
                              $oResultAmount = $sql3->row();

                              if($oResultAmount->Amount!=0)
                              {
                                ?>
                                <tr >
                                    <td align="left" class="cash_flow_re_serach_ml_underline_left"><?php echo $oResultCurrAsset[$s]->HeadName; ?></td>
                                    <td>&nbsp;</td>
                                    <td align="right" style="padding-right:10px; border-left:solid 1px #000; border-right:solid 1px #000;<?php if($TotalCurrAsset==0) echo "border-top: solid 1px #000;"; ?>">
                                        <?php 
                                            $Total=$oResultAmount->Amount;
                                            echo number_format($Total);
                                            $TotalCurrAsset+=$Total; 
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                          }
                        $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '4%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                        $sql4 = $this->db->query($sql);
                        $oResultAmount = $sql4->row();

                        if($oResultAmount->Amount!=0)
                        {
                          ?>
                         <tr>
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><?php echo display('payact')?></td>
                            <td>&nbsp;</td>
                            <td align="right"  class="cash_flow_re_serach_ml_underline_10px_right">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalCurrAsset+=$Total; 
                                ?>
                            </td>
                        </tr>
                        <?php
                      }
                      ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="cash_flow_re_serach_ml_underline_top" class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('cash_gand_lie')?></strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalCurrAsset); ?></strong></td>
                        </tr>
                        
                        <tr class="table_head">
                            <td colspan="3" class="cash_flow_re_serach_ml_underline_10px_right_bpamr_decoration"><b><?php echo display('casfactive')?></b></td>
                        </tr>
                        <?php
                          $TotalCurrAssetNon=0;
                          $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '3%' AND IsActive=1 ";

                          $sql5 = $this->db->query($sql);
                          $oResultCurrAsset = $sql5->result();

                          for($s=0;$s<count($oResultCurrAsset);$s++)
                          {
                          $COAID=$oResultCurrAsset[$s]->HeadCode;
                          $sql="SELECT  SUM(acc_transaction.Credit) - SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%') ";

                          $sql6 = $this->db->query($sql);
                          $oResultAmount = $sql6->row();

                          if($oResultAmount->Amount!=0)
                          {
                        ?>
                          <tr>
                              <td align="left" class="cash_flow_re_serach_ml_underline_10px_left" ><?php echo $oResultCurrAsset[$s]->HeadName; ?></td>
                              <td>&nbsp;</td>
                              <td align="right" style="padding-right:10px; border-left:solid 1px #000; border-right:solid 1px #000;<?php if($TotalCurrAssetNon==0) echo "border-top: solid 1px #000;"; ?>">
                          <?php 
                              $Total=$oResultAmount->Amount;
                              echo number_format($Total);
                              $TotalCurrAssetNon+=$Total; 
                          ?>
                              </td>
                          </tr>
                        <?php
                            }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('cashnonlia')?></strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalCurrAssetNon); ?></strong></td>
                        </tr>
                        <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                         <tr class="table_head">
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('incdre')?></strong></td>
                           <td>&nbsp;</td>
                           <td align="right"  class=" cash_flow_re_serach_ml_underline_10px_right_bpamr_decorationdfdf">&nbsp;</td>
                      </tr>
                        
                      <?php
                      $TotalCurrLiab=0;
                      $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20101%' AND HeadCode!=20101 AND IsActive=1";

                      $sql6 = $this->db->query($sql);
                      $oResultLiab = $sql6->result();

                      for($t=0;$t<count($oResultLiab);$t++)
                      {
                      $COAID=$oResultLiab[$t]->HeadCode;

                      $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";
                      $oResultAmount=$oAccount->SqlQuery($sql);

                      $sql7 = $this->Db->query($sql);
                      $oResultAmount = $sql7->row();

                      if($oResultAmount->Amount!=0)
                      {
                        ?>
                        <tr >
                            <td align="left"  class="cash_flow_re_serach_ml_underline_10px_left" ><?php echo $oResultLiab[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" style="padding-right:10px; border-left: solid 1px #000; border-right:solid 1px #000;<?php if($TotalCurrLiab==0) echo "border-top: solid 1px #000;"; ?>" >
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                    $TotalCurrLiab+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td   class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('Tincdre')?></strong></td>
                             <td>&nbsp;</td>
                           <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalCurrLiab); ?></strong></td>
                        </tr>
                       <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('netopenactv')?></strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr class="table_head">
                            <td colspan="3" class="cash_flow_re_serach_ml_underline_10px_right_bpamr_decoration"><b><?php echo display('cfact')?></b></td>
                        </tr>
                        <?php
                        $TotalNonCurrAsset=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '101%' AND HeadCode!=101 AND IsActive=1";

                        $sql9 = $this->db->query($sql);
                        $oResultNonCurrAsset = $sql9->result();

                        for($t=0;$t<count($oResultNonCurrAsset);$t++)
                        {
                        $COAID=$oResultNonCurrAsset[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Debit)-SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql8 = $this->db->query($sql);
                        $oResultAmount = $sql8->row();

                        if($oResultAmount->Amount!=0)
                        {
                        ?>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><?php echo $oResultNonCurrAsset[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" style="padding-right:10px; border-left: solid 1px #000; border-right:solid 1px #000;<?php if($TotalNonCurrAsset==0) echo "border-top: solid 1px #000;"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalNonCurrAsset+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('ncuia')?></strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalNonCurrAsset); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                       
                        <tr class="table_head">
                            <td colspan="3" class="cash_flow_re_serach_ml_underline_10px_right_bpamr_decoration"><b><?php echo display('cfffa')?></b></td>
                        </tr>
                        <?php
                        $TotalNonCurrLiab=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '20102%' AND IsActive=1";

                        $sql10 = $this->db->query($sql);
                        $oResultNonCurrLiab = $sql10->result();

                        for($t=0;$t<count($oResultNonCurrLiab);$t++)
                        {
                        $COAID=$oResultNonCurrLiab[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql11 = $this->db->query($sql);
                        $oResultAmount = $sql11->row();

                        if($oResultAmount->Amount!=0)
                        {
                            ?>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><?php echo $oResultNonCurrLiab[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" style="padding-right:10px; border-left: solid 1px #000; border-right:solid 1px #000;<?php if($TotalNonCurrLiab==0) echo "border-top: solid 1px #000;"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                    $TotalNonCurrLiab+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                          }
                        }
                        ?>
                        <?php
                        $TotalFund=0;
                        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND HeadCode LIKE '202%' AND IsActive=1";

                        $sql12 = $this->db->query($sql);
                        $oResultFund = $sql12->result();


                        for($t=0;$t<count($oResultFund);$t++)
                        {
                        $COAID=$oResultFund[$t]->HeadCode;

                        $sql="SELECT SUM(acc_transaction.Credit)-SUM(acc_transaction.Debit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove = 1 AND VDate BETWEEN '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%' AND VNo in (SELECT VNo FROM acc_transaction WHERE COAID LIKE '1020101%')";

                        $sql13 = $this->db->query($sql);
                        $oResultAmount = $sql13->row();

                        if($oResultAmount->Amount!=0)
                        {
                        ?>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><?php echo $oResultFund[$t]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" class="cash_flow_re_serach_ml_underline_10px_right">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total,2);
                                    $TotalFund+=$Total;
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                          }
                        ?>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('netcufa')?></strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalFund+$TotalNonCurrLiab); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><strong><?php echo display('ncio')?> (<?php echo display('pflos')?> <?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab+$TotalNonCurrAsset+$TotalFund+$TotalNonCurrLiab); ?>)</strong></td>
                            <td>&nbsp;</td>
                            <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalCurrAsset+$TotalCurrAssetNon+$TotalCurrLiab+$TotalNonCurrAsset+$TotalFund+$TotalNonCurrLiab+$TotalOpening); ?></strong></td>
                        </tr>
                         <tr >
                            <td >&nbsp;</td>
                             <td>&nbsp;</td>
                           <td >&nbsp;</td>
                        </tr>
                      
                      <tr class="table_head">
                          <td colspan="3" class="cash_flow_re_serach_ml_underline_10px_left"><strong><?php echo display('clcEq')?>:</strong></td>
                        </tr>
                      <?php
                        $sql="SELECT * FROM acc_coa WHERE acc_coa.IsTransaction=1 AND acc_coa.HeadType='A' AND acc_coa.IsActive=1 AND acc_coa.HeadCode LIKE '1020101%' ";

                        $sql14 = $this->db->query($sql);
                        $oResultAsset = $sql14->result();

                        $TotalAsset=0;
                        for($i=0;$i<count($oResultAsset);$i++)
                        {
                          $COAID=$oResultAsset[$i]->HeadCode;
                          $sql="SELECT SUM(acc_transaction.Debit)- SUM(acc_transaction.Credit) AS Amount FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN  '".$dtpFromDate."' AND '".$dtpToDate."' AND COAID LIKE '$COAID%'";

                          $sql15 = $this->db->query($sql);
                          $oResultAmount = $sql15->row();

                          if($oResultAmount->Amount!=0)
                          {
                      ?>
                        <tr >
                            <td align="left" class="cash_flow_re_serach_ml_underline_10px_left"><?php echo $oResultAsset[$i]->HeadName; ?></td>
                            <td>&nbsp;</td>
                            <td align="right" style="padding-right:10px; border-left: solid 1px #000; border-right:solid 1px #000;<?php if($TotalAsset==0) echo "border-top: solid 1px #000;"; ?>">
                                <?php 
                                    $Total=$oResultAmount->Amount;
                                    echo number_format($Total);
                                        $TotalAsset+=$Total; 
                                ?>
                            </td>
                        </tr>
                              <?php
                          }
                        }
                      ?>
                        <tr>
                          <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="cash_flow_re_serach_ml_underline_top">&nbsp;</td>
                        </tr>
                        <tr>
                         <td align="left" class="cash_flow_re_serach_ml_leftalign"><strong><?php echo display('TcccE')?></strong></td>
                          <td>&nbsp;</td>
                           <td align="right" class="cash_flow_re_serach_ml_underline_10px_right_bpa"><strong><?php echo number_format($TotalAsset); ?></strong></td>
                        </tr>
                        <tr>
                          <td align="right" colspan="3">&nbsp;</td>
                        </tr>
                        
                         <tr>
                              <td colspan="3" align="center">
                                <table width="100%" cellpadding="1" cellspacing="20"  class="cash_flow_re_serach_ml_underline_10px_right_bpamr_tp">
                                    <tr>
                                        <td width="20%" class="cash_flow_re_serach_ml_underline_top" align="center"><?php echo display('pp_by')?></td>
                                        <td width="20%" class="cash_flow_re_serach_ml_underline_top" align="center"><?php echo display('act')?></td>
                                        <td width='20%' class="cash_flow_re_serach_ml_underline_tr" ><?php echo display('ausig')?></td>
                                        <td  width="20%" class="cash_flow_re_serach_ml_underline_top" align='center'><?php echo display('chairman')?></td>
                                    </tr>
                                </table>
                              </td>
                         </tr>
                    </table>
              </div>
                </div>
            </div>
            <div class="text-center cash_flow_re_serach_ml_underline_print_bnt" id="print" >
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                <a href="<?php echo base_url($pdf)?>" download>
                    <input type="button" class="btn btn-success" name="btnPdf" id="btnPdf" value="PDF"/>
                </a>
            </div>
        </div>
    </div>
</div>

