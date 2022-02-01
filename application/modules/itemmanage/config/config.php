<?php
// module directory name
$HmvcConfig['itemmanage']["_title"]     = "Item Management";
$HmvcConfig['itemmanage']["_description"] = "Item info";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['itemmanage']['_database'] = true;
$HmvcConfig['itemmanage']["_tables"] = array( 
	'item_category',
	'item_foods',
	  
);
