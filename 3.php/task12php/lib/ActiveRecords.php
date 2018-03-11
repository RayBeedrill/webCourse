<?php
/*
 *Active Records base class it gives posibility to get names of cols from table wich will save in $colsArr
 */
class ActiveRecords extends Sql
{
    protected $colsArr = array();
    protected $keysArr = array();

    /*
     * gets some value from key colsArr
    */    
	public function __get($name)
	{
	    if(array_key_exists($name, $this->colsArr))
        {
            return $this->colsArr[$name];
        }
        else
        {
            throw new Exception(ACT_COL_ERR);
        }
    }
    
    /*
     * sets some value in colsArr
    */    
	public function __set($name, $value)
	{
	    if(array_key_exists($name, $this->colsArr))
        {
            $this->colsArr[$name] = $value;
        }
        else
        {
            throw new Exception(ACT_COL_ERR);
        }
    }

    /*
     * returns array with cols name
     */
    public function getCols()
    {
        return $this->colsArr;
    }

     
}
