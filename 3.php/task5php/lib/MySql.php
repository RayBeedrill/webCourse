<?php 
/*
 *
 * class MySql need to build queries for Mysql db 
 * 
 *
 */
class MySql implements iWorkData 
{
        protected $connectionLink;
    /*
     * constructor connects to db
     */
    public function __construct()
    {
        $connect = mysql_connect(MYSQL_DB_ADDRESS, MYSQL_USR, MYSQL_PASS);  
        if(!$connect)
        {
            die(CON_ERR);
        }
        else
        {
            $this->connectionLink = $connect;
            mysql_select_db(MYSQL_DB, $this->connectionLink); 
            return 1;
        } 
    }

    /*
     * destructor interrupts connection to db
    */
    public function __destruct()
    {
        mysql_close($this->connectionLink);
        return 1;
    }

	
	/*
	*	saves variable in db
	*/
    public function saveData($key, $val)
    { 
		$check = mysql_query("SELECT  " . $key . " FROM ". MYSQL_TABLE ." WHERE `key`='user4'", $this->connectionLink) 
		or die ("Error.<hr>" . mysql_error());
		if(!mysql_num_rows($check))
		{
			$query = "INSERT INTO " . MYSQL_TABLE . " ($key) " .  " VALUES " . " ($val) ";
             
			$result = mysql_query($query, $this->connectionLink);
			if(!$result)
			{
				die(mysql_error());
			}
			else
			{
			    return	$result;
			}
		}
		else
		{
			return SETED_MYSQL;
		}
    }
   
	
	/*
	*	gets variable from db
	*/
    public function getData($key)
    {
		if("*" !== $key)
		{	
			$query = "SELECT " . $key . " FROM " . MYSQL_TABLE;
			$result = mysql_query($query, $this->connectionLink);
			if(!$result)
			{
				die(mysql_error());
			}
			else
			{
				$resultEnd = array();
				while($row = mysql_fetch_array($result,1))
				{
					array_push($resultEnd, $row);
				}
				
				return $resultEnd;
			}	
		}
		else
		{
			return SEL_ERR;
		}
    } 

	
	/*
	*	delete variable in db
	*/
    public function deleteData($key)
    {
        $query = "DELETE FROM " . MYSQL_TABLE . " WHERE " . "`key`=" . $key;
        $result = mysql_query($query, $this->connectionLink);
        if(!$result)
        {
            die(mysql_error());
        }
        else
        {
            return DELETE_SQL;
        }
    }
    
} 
