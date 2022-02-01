        <center><h2> Please wait, while we transfer to secure payment panel...</h2></center>
        <?php if($paymentinfo->Islive==1){?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://bfssecure.rma.org.bt/BFSSecure/makePayment">
        <?php }
		else{
		?>
        <form id="payment_gw" name="payment_gw" method="POST" action="http://uatbfssecure.rma.org.bt:8080/BFSSecure/makePayment">
        <?php } 
		$bfs_benfBankCode = '01';
		$bfs_benfId = $paymentinfo->marchantid;
		$bfs_msgType = 'AR';
		$bfs_txnCurrency = 'BTN';
		$bfs_version = '1.0';
		$PGSecretKey = base_url().'assets/BE10000072.key';
		date_default_timezone_set('Asia/Thimphu');
		$bfs_benfTxnTime=date('yymdhis');
		$bfs_orderNo=$random_number;
		$bfs_txnAmount= number_format((float)$orderinfo->totalamount, 2, '.', '');
		$bfs_remitterEmail=$paymentinfo->email;
		$bfs_paymentDesc='Online Food Order System';
		$PGData = $bfs_benfBankCode."|".$bfs_benfId."|".$bfs_benfTxnTime."|".$bfs_msgType."|".$bfs_orderNo."|".$bfs_paymentDesc."|".$bfs_remitterEmail."|
		".$bfs_txnAmount."|".$bfs_txnCurrency."|".$bfs_version;
		$fp = fopen($PGSecretKey, "r");
		$priv_key = fread($fp, 8192);
		fclose($fp);
		$pkeyid = openssl_get_privatekey($priv_key);
		openssl_sign($PGData, $signature, $pkeyid, "sha1WithRSAEncryption");
		
		$final_checkSum = bin2hex($signature);
		$final_checkSum = strtoupper($final_checkSum);
		// free the key from memory
		 openssl_free_key($pkeyid);
		?>
        <input type="hidden" value="<?php echo $bfs_benfBankCode; ?>" name="bfs_benfBankCode">
        <input type="hidden" value="<?php echo $bfs_benfId; ?>" name="bfs_benfId">
        <input type="hidden" value="<?php echo $bfs_benfTxnTime.$orderinfo->order_id; ?>" name="bfs_orderNo">
        <input type="hidden" value="<?php echo $bfs_benfTxnTime; ?>" name="bfs_benfTxnTime">
        <input type="hidden" value="<?php echo $bfs_msgType; ?>" name="bfs_msgType">
        <input type="hidden" value="<?php echo $bfs_paymentDesc; ?>" name="bfs_paymentDesc">
        <input type="hidden" value="<?php echo $bfs_remitterEmail; ?>" name="bfs_remitterEmail">
        <input type="hidden" value="<?php echo $bfs_txnAmount; ?>" name="bfs_txnAmount">
        <input type="hidden" value="<?php echo $bfs_txnCurrency; ?>" name="bfs_txnCurrency">
        <input type="hidden" value="<?php echo $bfs_version; ?>" name="bfs_version">
        <input type="hidden" value="<?php echo $final_checkSum; ?>" name="bfs_checkSum">

<input type="submit" value="Pay with SSLCOMMERZ" name="pay" class="display-none">
</form> 
    
        <script>
            window.onload = function(){
              document.forms['payment_gw'].submit()
            }        
        </script>
        
