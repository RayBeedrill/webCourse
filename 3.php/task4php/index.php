<?php
/*
 *
 * index.php need to create objects give queries and get results
 *
 */
include('config.php');
include('lib/Sql.php');
include('lib/MySql.php');
include('lib/PostgreSql.php');

// MYSQL QUERIES
//$mysqlInsert = new MySql();
//$mysqlInsert->setInsertVal(MYSQL_TABLE,"`key`,`data`")->setValuesVal("'user4','someData'");
//$mysqlInsert->sendQueryString();
//unset($mysqlInsert);

//$mysqlUpdate = new MySql();
//$mysqlUpdate->setUpdateVal(MYSQL_TABLE)->setSetVal("`data` = 'UpdatedData'")->setWhereVal("`key` = 'user4'");
//$result = $mysqlUpdate->sendQueryString();
//unset($mysqlUpdate);

//$mysqlDelete = new MySql();
//$mysqlDelete->setDeleteVal(MYSQL_TABLE)->setWhereVal("`key`='user4'");
//$result = $mysqlDelete->sendQueryString();
//unset($mysqlDelete);

$mysqlSelect = new MySql();
$mysqlSelect->setSelectVal("`key`,`data`")->setFromVal(MYSQL_TABLE);
$sqlResult = $mysqlSelect->sendQueryString();
unset($mysqlSelect);


// POSTGRESQL QUERIES

//$pgsqlInsert = new PostgreSql();
//$pgsqlInsert->setInsertVal(PGSQL_TABLE,"key,data")->setValuesVal("'user4','someData'");
//$result = $pgsqlInsert->sendQueryString();
//unset($pgsqlInsert);

//$pgsqlUpdate = new PostgreSql();
//$pgsqlUpdate->setUpdateVal(PGSQL_TABLE)->setSetVal("data = 'UpdatedData'")->setWhereVal("key = 'user4'");
//$result = $pgsqlUpdate->sendQueryString();
//unset($pgsqlUpdate);

//$pgsqlDelete = new PostgreSql();
//$pgsqlDelete->setDeleteVal(PGSQL_TABLE)->setWhereVal("key='user4'");
//$result = $pgsqlDelete->sendQueryString();
//unset($pgsqlDelete);

$pgsqlSelect = new PostgreSql();
$pgsqlSelect->setSelectVal("key, data")->setFromVal(PGSQL_TABLE);
$pgsqlResult = $pgsqlSelect->sendQueryString();
unset($pgsqlSelect);

include('template/index.php');
