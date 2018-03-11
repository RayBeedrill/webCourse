<?php
class WebScreenShotCurl extends ClientCurl
{
    private $apikey = WS1_API_KEY;
    private $url = 'google.com';
    private $width = 600;
    private $path = '';
    private $nameFile = 'screenshot';

    public function setApiKey($api)
    {
        if(is_string($api))
        {
            $this->apikey = $api;
        }
        else
        {
            throw new Exception(STR_ERR);
        }
    }

    public function setUrl($pageUrl)
    {
        if(is_string($pageUrl))
        {
            $this->url = $pageUrl;
        }
        else
        {
            throw new Exception(STR_ERR);
        }
    }

    public function setWidth($imgWidth)
    {
        if(is_int($imgWidth))
        {
            $this->width = $imgWidth;
        }
        else
        {
            throw new Exception(NUM_ERR);
        }
    }

    public function setPath($imgPath)
    {
        if(is_string($imgPath))
        {
            $this->path = $imgPath;
        }
        else
        {
            throw new Exception(STR_ERR);    
        }
    }

    public function setNameFile($imgName)
    {
        if(is_string($imgName))
        {
            $this->nameFile = $imgName;
        }
        else
        {
            throw new Exception(STR_ERR);
        }
    }

    public function getImg()
    {
        curl_setopt($this->curl, CURLOPT_URL, 'https://api.thumbnail.ws/api/' . $this->apikey . '/thumbnail/get');
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, array(
          'url' => $this->url,
          'width' => $this->width,
          'fullpage' => 'false'
        ));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        $image = curl_exec($this->curl);
        
        $path = $this->path . $this->nameFile . '.jpg';
        file_put_contents($path, $image);
        return '<img src="' . $path . '" alt="">';
    }
}
