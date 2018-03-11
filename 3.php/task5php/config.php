<?php
/*
 *
 *config file for MySql and PostgreSql 
 *and cookies, session
 *and file for error constans
 */

define('COOK_LIFETIME',3600);
define('COOK_ERR','cookie not seted');
define('SES_ERR','this session var not empty');
define('SES_VAL','DATA NOT FOUND');
define('DELETE_SQL','DATA DELETED');
define('SETED_MYSQL','This record is already in base');

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
define('EXEC_ERR','Enter some value');
define('SEL_ERR','enter some column');
define('QUER_ERR','query execution failed');
