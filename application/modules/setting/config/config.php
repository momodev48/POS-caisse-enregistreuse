<?php
// module directory name
$HmvcConfig['setting']["_title"]     = "Setting All Method";
$HmvcConfig['setting']["_description"] = "setting method like payment,shipping,membership";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['setting']['_database'] = true;
$HmvcConfig['setting']["_tables"] = array( 
	'membership',
	'payment_method',
	'shipping_method'
);
