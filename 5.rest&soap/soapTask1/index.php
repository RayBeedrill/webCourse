<?php
include('config.php');   
include('libs/ClientSoap.php');
include('libs/ClientCurl.php');
include('libs/WebScreenShotSoap.php');
include('libs/WebScreenShotCurl.php');
include('libs/TeamInfoSoap.php');
include('libs/TeamInfoCurl.php');
$msg ='';
$screenSoap = new WebScreenShotSoap(WS1_URL1);
$screenCurl = new WebScreenShotCurl();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $srcCurl = $_POST['webSrcCurl'];
    $srcSoap = $_POST['webSrcSoap'];
    if(is_string($srcSoap))
    {
        $imgSoap =  $screenSoap->setUrl($srcSoap);
    }

    if(is_string($srcCurl))
    {       
         $imgCurl =  $screenCurl->setUrl($srcCurl);
    }
}
try
{
    try 
    {
        //$screenSoap->setUrl(WEBPAGE_SOAP);
        $screenSoap->setWidth(SCREEN_WIDTH_SOAP);
        $screenSoap->setNameFile(SCREEN_NAME_SOAP);
        $imgSoap = $screenSoap->getImg();

        $footballSoap = new TeamInfoSoap(WS2_URL2);
        $teamsSoap = $footballSoap->getTeamBlock();
        
    }
    catch (SoapFault $fault)
    {
        $msg = "Error: " . $fault->faultcode . ": " . $fault->getMessage() . "\n";
    }

//$screenCurl->setUrl(WEBPAGE_CURL);
$screenCurl->setWidth(SCREEN_WIDTH_CURL);
$screenCurl->setNameFile(SCREEN_NAME_CURL);
$imgCurl = $screenCurl->getImg();



$footballCurl = new TeamInfoCurl();
$teamsCurl = $footballCurl->getTeamBlock();
}
catch (Exception $e)
{
    $msg =  $e->getMessage();
}

include('templates/index.php');