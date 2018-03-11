<?php 
/*
 *
 * index.php need to create objects give queries and get results
 *
 */
include('config.php');
include('lib/Sql.php');
include('lib/ActiveRecords.php');
include('lib/MySql.php');
include('lib/PostgreSql.php');
include('lib/MyTest.php');
include('lib/PdoWork.php');


$err = '';
try
{
// MYSQL pdo work
    
//$mysql = new PdoWork("Mysql");
//$mysql->setInsertVal(MYSQL_TABLE,"`key`,`data`")->setValuesVal("'user4','task12'");
//$sqlResult = $mysql->sendQueryString();
//unset($mysql);

//$mysql = new PdoWork("Mysql");
//$mysql->setUpdateVal(MYSQL_TABLE)->setSetVal("`data` = 'UpdatedData task12'")->setWhereVal("`key` = 'user4'");
//$sqlResult = $mysql->sendQueryString();
//unset($mysql);

//$mysql = new PdoWork("Mysql");
//$mysql->setDeleteVal(MYSQL_TABLE)->setWhereVal("`key`='user4'");
//$sqlResult = $mysql->sendQueryString();
//unset($mysql);

$mysql = new PdoWork("Mysql");
$mysql->setSelectVal("`key`,`data`")->setFromVal(MYSQL_TABLE);
$sqlResult = $mysql->sendQueryString();
unset($mysql);

// POSTGRESQL pdo work

//$pgsql = new PostgreSql();
//$pgsql->setInsertVal(PGSQL_TABLE,"key,data")->setValuesVal("'user4','someData'");
//$pgsqlResult = $pgsql->sendQueryString();
//unset($pgsql);

//$pgsql = new PostgreSql();
//$pgsql->setUpdateVal(PGSQL_TABLE)->setSetVal("data = 'UpdatedData'")->setWhereVal("key = 'user4'");
//$pgsqlResult = $pgsql->sendQueryString();
//unset($pgsql);

//$pgsql = new PostgreSql();
//$pgsql->setDeleteVal(PGSQL_TABLE)->setWhereVal("key='user4'");
//$pgsqlResult = $pgsql->sendQueryString();
//unset($pgsql);

$pgsql = new PostgreSql();
$pgsql->setSelectVal("key, data")->setFromVal(PGSQL_TABLE);
$pgsqlResult = $pgsql->sendQueryString();
unset($pgsql);
}
catch(Exception $e)
{
    $err .= $e->getMessage() . "\n";
}

include('template/index.php');
