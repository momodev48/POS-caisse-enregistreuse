<?php

// module name
$HmvcMenu["ordermanage"] = array(
    //set icon
    "icon"           => "<i class='fa fa-first-order' aria-hidden='true'></i>
", 


	"pos_invoice" => array( 
        "controller" => "order",
        "method"     => "pos_invoice",
        "permission" => "read"
    ),
	"order_list" => array( 
        "controller" => "order",
        "method"     => "orderlist",
        "permission" => "read"
    ),
	"pending_order" => array( 
        "controller" => "order",
        "method"     => "pendingorder",
        "permission" => "read"
    ),
	"complete_order" => array( 
        "controller" => "order",
        "method"     => "completelist",
        "permission" => "read"
    ),
	"cancel_order" => array( 
        "controller" => "order",
        "method"     => "cancellist",
        "permission" => "read"
    ),
	"kitchen_dashboard" => array( 
        "controller" => "order",
        "method"     => "kitchen",
        "permission" => "read"
    ),
	"counter_dashboard" => array(
		"controller" => "order",
		"method"=> "counterboard",
		"permission" => "read"
		), 
	"dashboard" => array( 
        "controller" => "dashboard",
        "method"     => "home",
        "permission" => "read"
    ),
	 
);
   

 