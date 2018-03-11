<?php
/*
 *
 * index.php need to create objects give queries and get results
 *
 */
include('config.php');
include('lib/iWorkData.php');
include('lib/Cookies.php');
include('lib/Session.php');
include('lib/MySql.php');
include('lib/PostgreSql.php');

$session = new Session(); 

$session->saveData("some var","123");
$sessionData = $session->getData("some var");
$session->deleteData("some var");
$sessionDataDeleted = $session->getData("some var");
unset($session);

$cookies = new Cookies();

$cookies->saveData("var","valuesdasdasd");
$cookieData = $cookies->getData("var");
$cookies->deleteData("var");
$cookieDataDelete = $cookies->getData("var");

$mysql = new MySql();
$mysql->saveData("`key`, `data`","'User4','SomeValue'");
$mysqlRes = $mysql->getData("`key`,`data`");
$mysqlDeleted = $mysql->deleteData("'User4'");
unset($mysql);

$pgsql = new PostgreSql();
$pgsql->saveData("key, data","'User4','someValuee'");
$pgsqlRes = $pgsql->getData("key, data");
$pgsqlDeleted = $pgsql->deleteData("'User4'");
unset($pgsql);

include('template/index.php');
