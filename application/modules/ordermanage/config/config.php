<?php
// module directory name
$HmvcConfig['ordermanage']["_title"]     = "Order Item";
$HmvcConfig['ordermanage']["_description"] = "Manage Order item";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['ordermanage']['_database'] = true;
$HmvcConfig['ordermanage']["_tables"] = array( 
	'purchaseitem'
);
