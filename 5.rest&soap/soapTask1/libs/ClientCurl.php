<?php

class ClientCurl
{
    protected $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
}