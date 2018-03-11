<?php

class TeamInfoCurl extends ClientCurl
{
    private $teamArray;

    private $soapUrl = "http://footballpool.dataaccess.eu/data/info.wso?op=Teams";
    
    private $xmlPostString = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <Teams xmlns="http://footballpool.dataaccess.eu">
        </Teams>
      </soap:Body>
    </soap:Envelope>';

    private $contentLen;
    private $headers = array(
        "POST /data/info.wso HTTP/1.1",
        "Host: footballpool.dataaccess.eu",
        "Content-Type: text/xml; charset=utf-8",
        ); 
    
    function __construct() {
        parent::__construct();
        $this->contentLen = strlen($this->xmlPostString) ;
        array_push($this->headers,"Content-length: " . $this->contentLen);
        $this->getTeams();
    } 

    private function getTeams()
    {
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->curl, CURLOPT_URL, $this->soapUrl);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->xmlPostString); 
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
    
        $response = curl_exec($this->curl); 
        
        $response1 = str_replace("<soap:Body>","",$response);
        $response2 = str_replace("</soap:Body>","",$response1);
        $response3 = str_replace("<m:TeamsResult>","",$response2);
        $response4 = str_replace("</m:TeamsResult>","",$response3);
    
        $teams = new SimpleXMLElement($response4);
        
    
        foreach($teams->children('m',true)->children('m',true) as $team)
        {
            $name = $team->sName->__toString();
            $src = $team->sCountryFlag->__toString();
            $this->teamArray[$name] = $src;
        }   
    }

    public function getTeamBlock()
    {
        $arr = $this->teamArray;
        $temp .= '<div class="teams">';

        foreach($arr as $name => $src)
        {
            $temp .= '<div class="one-team">';
            $temp .= '<p class="team-name">' .  $name . '</p>';
            $temp .= '<img class="team-flag" src="' .  $src . '" alt="">';
            $temp .= '</div>';
        }
        
        $temp .= '</div>';
        return $temp;
    }

    public function setHeaders($headersStr)
    {
        if(is_string($headersStr))
        {
            $this->headers = $headersStr;
        }
        else
        {
            throw new Exception(STR_ERR);    
        }
    }

    public function setUrl($url)
    {
        if(is_string($url))
        {
            $this->soapUrl = $url;
        }
        else
        {
            throw new Exception(STR_ERR);    
        }
    }
    public function setXMLString($xml)
    {
        if(is_string($xml))
        {
            $this->xmlPostString = $xml;
        }
        else
        {
            throw new Exception(STR_ERR);    
        }
    }
}

