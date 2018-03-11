<?php
/*
*
* Interface of musician object
*
*/
class Musician implements iMusician
{
	protected $name;
	protected $type;
	protected $instruments = array();
	protected $bands = array();
	
	/*
	*	Construcor gives name and role of musician
	*/
	public function __construct($name, $type)
	{
		$this->name = $name;
		$this->type = $type;
	}
	
	/*
	*	Give instrument to musician
	*/
	public function addInstrument(iInstrument $obj)
	{
		$name = $obj->getName();
		$this->instruments[$name] = $obj->getCategory();
		return 1;
	}
	
	/*
	*	returns name of musician
	*/
    public function getName()
	{
		return $this->name;
	}

	/*
	*	returns array of instruments
	*/
    public function getInstrument()
	{
		return $this->instruments;
	}
	
	/*
	*	function wich adds band where musician plays
	*/	
    public function assingToBand(iBand $nameBand)
	{
		$name = $nameBand->getName();
		array_push($this->bands,$name);
	}

	/*
	*	return bands Array
	*/
	public function getBandList()
	{
		return $this->bands;
	}
	
	/*
	*	return role of musician
	*/
    public function getMusicianType()
	{
		return $this->type;
	}
}
