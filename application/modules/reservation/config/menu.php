<?php

// module name
$HmvcMenu["reservation"] = array(
    //set icon
    "icon"           => "<i class='fa fa-tags' aria-hidden='true'></i>
", 

    "reservation" => array(
        //menu name
            "controller" => "reservation",
            "method"     => "index",
            "permission" => "read"
        
   ), 
   "reservation_table" => array(
        //menu name
            "controller" => "reservation",
            "method"     => "tablebooking",
            "permission" => "read"
        
   ),    
);
   

 