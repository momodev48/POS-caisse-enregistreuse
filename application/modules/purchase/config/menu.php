<?php

// module name
$HmvcMenu["purchase"] = array(
    //set icon
    "icon"           => "<i class='fa fa-shopping-cart' aria-hidden='true'></i>
", 

   "purchase_item" => array( 
        "controller" => "purchase",
        "method"     => "index",
        "permission" => "read"
    ),
	"purchase_add" => array( 
        "controller" => "purchase",
        "method"     => "create",
        "permission" => "create"
    ),
	"purchase_return" => array( 
        "controller" => "purchase",
        "method"     => "return_form",
        "permission" => "create"
    ),
	"return_invoice" => array( 
        "controller" => "purchase",
        "method"     => "return_invoice",
        "permission" => "create"
    ),
	//group level name
    "supplier_manage" => array(
            "controller" => "supplierlist",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	"supplier_ledger" => array(
            "controller" => "supplierlist",
            "method"     => "supplier_ledger_report",
            "permission" => "read"
        
    ),
);
   

 