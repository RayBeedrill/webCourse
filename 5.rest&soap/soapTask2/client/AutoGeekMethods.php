<?php
ini_set("soap.wsdl_cache_enabled", WSDL_CACHE);
include('config.php');
include('libs/ClientSoap.php');
include('libs/AutoGeekClient.php');


try
{
	$client = new AutoGeekClient(WSDL_PATH);

	if($_POST['getCarList'])
	{
		echo $client->getCarList();
	}

	if($_POST['getCarInfo'])
	{
		echo $client->getCarInfo($_POST['getCarInfo']);
	}

	if($_POST['getCarBySettings'])
	{	
		echo $client->getCarBySettings($_POST['getCarBySettings']);
	}

	if($_POST['getAllFilters'])
	{
		echo $client->getAllFilters();
	}

	if($_POST['getAllPaymentMethods'])
	{
		echo $client->getAllPaymentMethods();
	}

	if($_POST['buyCar'])
	{
		echo $client->buyCar($_POST['buyCar']);
	} 
}
catch(SoapFault $e)
{
	echo $e->getMessage;
}
