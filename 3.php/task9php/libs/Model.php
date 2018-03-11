<?php 
class Model
{ 
	private $placeholderArray;
	
	public function __construct()
	{
		$this->placeholderArray = array(
									'%TITLE%'=>TITLE, 
									);  
	}

		
	public function getArrayDefault()
	{        
		return $this->placeholderArray;
	}
	
    public function addToArray($key,$value)
    {
        
         $this->placeholderArray[$key] = $value;
    }

    
}
