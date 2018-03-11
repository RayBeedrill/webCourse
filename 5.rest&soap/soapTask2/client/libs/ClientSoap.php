<?php
class ClientSoap
{
    protected $soapClient;

    public function __construct($url)
    {
        $this->soapClient = new SoapClient($url);
    }
    
    protected function getClient()
    {
        return $this->soapClient;
    }
}
