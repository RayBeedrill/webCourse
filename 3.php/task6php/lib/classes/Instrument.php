<?php
/*
*
* Class of instrument object
*
*/
class Instrument implements iInstrument
{
	protected $name;
	protected $category;
	
	/*
	*
	* in constructor you give name and category of instrument
	*/
	public function __construct($name, $category)
	{
		$this->name = $name;
		$this->category = $category;
	}
	
	/*
	*
	* returns name of insterument
	*/
    public function getName()
	{
		return $this->name;
	}
    
	/*
	*
	* returns category of instrument
	*/
	public function getCategory()
	{
		return $this->category;
	}
}
