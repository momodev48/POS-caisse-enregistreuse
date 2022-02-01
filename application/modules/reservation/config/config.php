<?php
// module directory name
$HmvcConfig['reservation']["_title"]     = "Reservation";
$HmvcConfig['reservation']["_description"] = "Manage Reservation";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['reservation']['_database'] = true;
$HmvcConfig['reservation']["_tables"] = array( 
	'tblreservation',
);
