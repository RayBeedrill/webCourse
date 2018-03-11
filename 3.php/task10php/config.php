<?php
/*
 *
 *config file for MySql and PostgreSql 
 *and file for error constans
 */


define('MYSQL_DB_ADDRESS','localhost');

define('PGSQL_DB_ADDRESS','host=localhost');

define('MYSQL_USR','user1');
define('MYSQL_PASS','tuser1');
define('MYSQL_DB','user1');
define('MYSQL_TABLE','MY_TEST');

define('PGSQL_USR','user=user1');
define('PGSQL_PASS','password=user1z');
define('PGSQL_DB','dbname=user1');
define('PGSQL_TABLE','PG_TEST');


define('CON_ERR','Connection Failed');
define('QUER_ERR','query execution failed');
define('SEL_ALL_ERR','plese select cols');
