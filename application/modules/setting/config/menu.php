<?php

// module name
$HmvcMenu["setting"] = array(
    //set icon
    "icon"           => "<i class='fa fa-gear' aria-hidden='true'></i>", 
  
 //group level name
       "payment_setting" => array(
       "paymentmethod_list" => array(
        //menu name
            "controller" => "paymentmethod",
            "method"     => "index",
            "permission" => "read"
        
    ),
	   "paymentmethod_setup" => array(
        //menu name
            "controller" => "paymentmethod",
            "method"     => "paymentsetup",
            "permission" => "read"
        
    ), 
	   "shipping_setting" => array(
            "controller" => "shippingmethod",
            "method"     => "index",
            "permission" => "read"
        
    ),
    ),
	//group level name
    "table_manage" => array(
       "table_list" => array(
        //menu name
            "controller" => "restauranttable",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	  "table_setting" => array(
        //menu name
            "controller" => "restauranttable",
            "method"     => "tablesetting",
            "permission" => "read"
        
    ), 
    ),   
	
	//group level name
    "customer_type" => array(
	"customer_list" => array(
        //menu name
            "controller" => "customerlist",
            "method"     => "index",
            "permission" => "read"
    ), 
    "customertype_list" => array(
        //menu name
            "controller" => "customertype",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	"thirdpartycustomer_list" => array(
        //menu name
            "controller" => "thirdpratycustomer",
            "method"     => "index",
            "permission" => "read"
        
    ),
	"list_of_card_terminal" => array(
        //menu name
            "controller" => "card_terminal",
            "method"     => "index",
            "permission" => "read"
        
    ), 
    ), 
	//group level name
   "manage_unitmeasurement" => array(
    "unit_list" => array(
        //menu name
            "controller" => "unitmeasurement",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	"ingradient_list" => array(
        //menu name
            "controller" => "ingradient",
            "method"     => "index",
            "permission" => "read"
        
    ), 
   ),  
   //group level name
   "sms_setting" => array(
    "sms_configuration" => array(
        //menu name
            "controller" => "smsetting",
            "method"     => "sms_configuration",
            "permission" => "read"
        
    ), 
	"sms_temp" => array(
        //menu name
            "controller" => "smsetting",
            "method"     => "sms_template",
            "permission" => "read"
        
    ), 
   ),
    //group level name
   "bank" => array(
   		"list_of_bank" => array("controller" => "bank_list",     "method"     => "index","permission" => "read"), 
	    "bank_transaction" => array( "controller" => "bank_list","method"     => "bank_transaction","permission" => "read")
   ),
   "language" => array(
            "controller" => "language",
            "method"     => "index",
            "permission" => "read"
        
    ),    
	
	//group level name
    "application_setting" => array(
            "controller" => "setting",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	//group level name
    "server_setting" => array(
            "controller" => "serversetting",
            "method"     => "index",
            "permission" => "read"
        
    ), 
 //group level name
    "currency" => array(
            "controller" => "currency",
            "method"     => "index",
            "permission" => "read"
        
    ), 
	//group level name
    "country" => array(
            "controller" => "country_city_list",
            "method"     => "index",
            "permission" => "read"
        
    ),   
	"state" => array(
            "controller" => "country_city_list",
            "method"     => "statelist",
            "permission" => "read"
        
    ),     
);
   

 