<?php
// here constants for connecting to BD
// // Mysql
define('MYSQL_DB_ADDRESS','localhost');
define('MYSQL_DB','user4');
define('MYSQL_USR','user4');
define('MYSQL_PASS','tuser4');

//define('MYSQL_DB_ADDRESS','localhost');
//define('MYSQL_DB','geekAuto');
//define('MYSQL_USR','root');
//define('MYSQL_PASS','');

define('WSDL_PATH','http://192.168.0.15/~user4/SOAP/task2/server/wsdl/AutoWsdl.wsdl');
//define('WSDL_PATH','http://soaptask2.loc/server/wsdl/AutoWsdl.wsdl');
define('SERVER_WSDL_CACHE', 0);

// // Errors
 define('SEL_ALL_ERR','forbidden "*" symbol for argument');
 define('QUERY_ERR','Query is not string!');
 define('BUY_ERR','you not set some values to buy car!');
