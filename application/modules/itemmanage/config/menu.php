<?php

// module name
$HmvcMenu["itemmanage"] = array(
    //set icon
    "icon"           => "<i class='fa fa-cube' aria-hidden='true'></i>
", 

    
 //group level name
    "manage_category" => array(
        //menu name
       "add_category" => array(
        //menu name
            "controller" => "item_category",
            "method"     => "create",
            "permission" => "create"
        
    ), 
       "category_list" => array(
        //menu name
            "controller" => "item_category",
            "method"     => "index",
            "permission" => "read"
        
    ), 
        
    ),  
    //group level name
   "manage_food" => array(
    "add_food" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "create",
            "permission" => "create"
    ), 
    "food_list" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "index",
            "permission" => "read"
        
    ),
	"food_varient" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "foodvarientlist",
            "permission" => "read"
        
    ), 
	"food_availablity" => array(
        //menu name
            "controller" => "item_food",
            "method"     => "availablelist",
            "permission" => "read"
        
    ), 
   ),
    //group level name
   "manage_addons" => array(
    "add_adons" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "create",
            "permission" => "create"
    ), 
    "addons_list" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "index",
            "permission" => "read"
        
    ),
	"assign_adons_list" => array(
        //menu name
            "controller" => "menu_addons",
            "method"     => "assignaddons",
            "permission" => "read"
        
    ),    
   ),
    
    
);
   

 