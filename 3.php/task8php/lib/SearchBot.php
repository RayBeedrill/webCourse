<?php
/*
 * Class for working with search query and working with result;
 *
 */

class SearchBot
{
    protected $url;
    protected $output;
    protected $curl;

	/*
	* curl init
	*/
    public function __construct()
    {
        $this->curl = curl_init();
    }

	/*
	* curl get query and returns taxt-content. Than DOMDocument filters text-content and returns part of page
	*/
    public function getContentByUrl($query)
    {   
    	$ref="User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36)";
       
        curl_setopt($this->curl, CURLOPT_USERAGENT, $ref);
        curl_setopt($this->curl, CURLOPT_URL, SEARCH_ADDRESS . $query);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);
        $this->output = curl_exec($this->curl);
		
        $page = $this->output;
		
		$dom = new DOMDocument();
		$internalErrors = libxml_use_internal_errors(true);
		$dom->loadHTML($page);
        libxml_use_internal_errors($internalErrors);
        $name = $dom->getElementsByTagName('h3');
        $desc = $dom->getElementsByTagName('span');
        $result = array();
        $counter = 0;
        foreach($name as $tag)
        {
            if($tag->hasAttribute('class'))
            {
                if($tag->getAttribute('class')=='r')
                {
                    $linkList = $tag->childNodes;
                    $result[$counter]['name'] = $tag->textContent;
                    foreach($linkList as $link)
                    {
                        if($link->nodeType == 1)
                        {
                            if($link->localName == 'a')
                            {
                                $result[$counter]['href'] = $link->getAttribute('href');
                                $counter++;
                            } 
                        }
                    }
                }
            }
        }
        $i = 0;
        foreach($desc as $tag)
        {
            if($tag->hasAttribute('class') && $tag->getAttribute('class')=== 'st')
            {
                $result[$i]['desc'] = $tag->textContent;
                $i++;    
            }
        } 
                
       		return $result;
    }
    
	/*
	* curl destroy
	*/
    public function __destruct()
    {
        curl_close($this->curl);	
    }
	
}

