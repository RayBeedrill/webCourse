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

$err = '';

// MYSQL QUERIES

try
{
    $mysqlSelect = new MySql();
}
catch(Exception $e)
{
  $err .=  $e->getMessage() . "\n";    
}

//$mysqlSelect->setSelectVal("`key`,`data`","distinct")->setFromVal(MYSQL_TABLE);

////$mysqlSelect->setSelectVal("`key`,`data`")->setFromVal(MYSQL_TABLE)->setGroupVal("`key`");

$mysqlSelect->setSelectVal("`key`,`data`")->setFromVal(MYSQL_TABLE)->setGroupVal("`key`")->setHavingVal("COUNT(`key`)")->setOrderVal(" COUNT(`key`) DESC")->setLimitVal("6");

$sqlResult = $mysqlSelect->sendQueryString();
unset($mysqlSelect);

// POSTGRESQL QUERIES

try
{
    $pgsqlSelect = new PostgreSql();
}
catch(Exception $e)
{
  $err .=  $e->getMessage() . "\n";    
}

//$pgsqlSelect->setSelectVal("key, data")->setFromVal(PGSQL_TABLE);

//$pgsqlSelect->setSelectVal("key,data",'distinct')->setFromVal(PGSQL_TABLE);

//$pgsqlSelect->setSelectVal("key,data")->setFromVal(PGSQL_TABLE)->setGroupVal("key,data");

$pgsqlSelect->setSelectVal("key,data")->setFromVal(PGSQL_TABLE)->setGroupVal("key,data")->setHavingVal("true")->setOrderVal("COUNT(key) DESC")->setLimitVal("6");

$pgsqlResult = $pgsqlSelect->sendQueryString();
unset($pgsqlSelect);

include('template/index.php');
