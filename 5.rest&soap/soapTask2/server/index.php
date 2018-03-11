<?php
ini_set("soap.wsdl_cache_enabled", SERVER_WSDL_CACHE);
include('config.php');
include('libs/dbWork/Sql.php');
include('libs/dbWork/PdoWork.php');
include('libs/AutoGeekSoap.php');
try
{
$srv = new SoapServer(WSDL_PATH);
$srv->setClass("AutoGeekSoap");
$srv->handle();
}catch(SoapFault $e)
{
	echo $e->getMessage();
}


