<?php
/*
*
* Interface of band object
*
*/
class Band implements iBand
{
	protected $name;
	protected $genre;
	protected $bandList =  array();

   /*
   *  Construcor gives name and genre of band
   */
	public function __construct($name, $genre)
	{
		$this->name = $name;
		$this->genre = $genre;
	}

   /*
   *  returns name of band
   */
	public function getName()
   {
		return $this->name;
	}

   /*
   *  returns Genre of band
   */
	public function getGenre()
   {
		return $this->genre;
	}

   /*
   *  Adds Musician to band, and assining band to musician
   */
	public function addMusician(iMusician $obj)
	{
		$type = $obj->getMusicianType();
		$this->bandList[$type] = $obj;
		$obj->assingToBand($this);

	}
	
   /*
   *  returns all musicians in group
   */
	public function getMusician()
	{
		return $this->bandList;
	}

   /*
   *  return array with all info about group
   */
	public function getGroupInfo()
	{
		$list = $this->getMusician();
		$list2 = array();

		foreach ($list as $role => $musician)
      {
		$list2[$role] = array
            		(
            			'name' => $musician->getName(),
            			'instruments' => $musician->getInstrument(),
            			'bands' => $musician->getBandList(),
            		);
      }

		$group = array
		(
			"name" => $this->getName(),
			"genre" => $this->getGenre(),
			"bandList" => $list2
		);

		return $group;
	}
}
