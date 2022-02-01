<?php

// module name
$HmvcMenu["production"] = array(
    //set icon
    "icon"           => "<i class='fa fa-product-hunt' aria-hidden='true'></i>
", 

   "set_productionunit" => array( 
        "controller" => "production",
        "method"     => "productionunit",
        "permission" => "create"
    ),
	
   "production_set_list" => array( 
        "controller" => "production",
        "method"     => "index",
        "permission" => "read"
    ),
	"production_add" => array( 
        "controller" => "production",
        "method"     => "create",
        "permission" => "create"
    ),
	
);
   

 