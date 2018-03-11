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


$err = '';
try
{
    $table = new MyTest();
    $table->key = "'user4-task11'"; 
    $table->data = "'someData'"; 
	$table->Save();
    //$table->delete('`data`=\'someData\'');
    $result = $table->find('`key`,`data`'); 
}
catch(Exception $e)
{
    $err .= $e->getMessage() . "\n";
}

include('template/index.php');
