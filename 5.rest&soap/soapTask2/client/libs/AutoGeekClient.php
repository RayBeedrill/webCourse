<?php
class AutoGeekClient extends ClientSoap
{
	public function getCarList()
    {
     	$client = $this->getClient();
		$json = $client->getCarList();
		return $json;   
    }
    
    public function getCarInfo($id)
    {
    	$client = $this->getClient();
    	$json = $client->getCarInfo($id);
    	return $json;
    }    
    
    public function getCarBySettings($arr)
    {
    	$client = $this->getClient();
    	$json = $client->getCarBySettings($arr);
    	return $json;
    }

    public function getAllFilters()
    {
        $client = $this->getClient();
        $json = $client->getAllFilters();
        return $json;
    }

    public function getAllPaymentMethods()
    {
    	$client = $this->getClient();
    	$json = $client->getAllPaymentMethods();
    	return $json;
    }

    public function buyCar($arr)
    {
    	$client = $this->getClient();
    	$response = $client->buyCar($arr);
    	return $response;
    }
}

