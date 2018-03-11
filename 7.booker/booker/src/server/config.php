<?php

date_default_timezone_set('Europe/Kiev');	
// test mode
define('TEST_MODE',true);
// cross domain
define('CROSS_QUER',false);

// here constants for connecting to BD

// Mysql
define('MYSQL_DB_ADDRESS','localhost');
define('MYSQL_DB','user4');
define('MYSQL_USR','user4');
define('MYSQL_PASS','tuser4');

//define('MYSQL_DB_ADDRESS','localhost');
//define('MYSQL_DB','booker');
//define('MYSQL_USR','root');
//define('MYSQL_PASS','');

// REST api default format
define('DEF_FORMAT','json');

// Errors
define('SEL_ALL_ERR','forbidden "*" symbol for argument');
define('QUERY_ERR','Query is not string!');
