<?php

// module name
$HmvcMenu["report"] = array(
    //set icon
    "icon"           => "<i class='fa fa-qrcode' aria-hidden='true'></i>
", 

    "purchase_report" => array(
        //menu name
            "controller" => "reports",
            "method"     => "index",
            "permission" => "read"
        
    ), 
 	"stock_report_product_wise" => array(
        //menu name
            "controller" => "reports",
            "method"     => "productwise",
            "permission" => "read"
        
    ), 
	
	"purchase_report_ingredient" => array(
        //menu name
            "controller" => "reports",
            "method"     => "ingredientwise",
            "permission" => "read"
        
    ), 
	"sell_report" => array(
        //menu name
            "controller" => "reports",
            "method"     => "sellrpt",
            "permission" => "read"
        
    ),
	"sell_report_filter" => array(
        //menu name
            "controller" => "reports",
            "method"     => "sellrpt2",
            "permission" => "read"
        
    ), 
	"sele_by_date" => array(
            "controller" => "reports",
            "method"     => "sellrptbydate",
            "permission" => "read"
        
    )
);
   

 