<?php
/*
 *
 *PostgreSql class need to build queries for PostgreSql db
 *
 */
class PostgreSql implements iWorkData
{
    protected $connectionLink;

    /*
     * constructor build connect to db
     */
    public function __construct()
    {
        $connectString = PGSQL_DB_ADDRESS . " " .  PGSQL_DB . " " . PGSQL_USR . " " . PGSQL_PASS;
        $dbConnection = pg_connect($connectString);
        if(!$dbConnection)
        {
            die(CON_ERR);
        }
        else
        {
            $this->connectionLink = $dbConnection;
        }
    }

    /*
     * destructor interups connect to db
     */
    public function  __destruct()
    {
        pg_close($this->connectionLink); 
    }
	
    /*
	* sends string query 
	*/
    public function saveData($key, $value)
    {	
		$check = pg_query("SELECT  " . $key . " FROM ". PGSQL_TABLE ." WHERE key='User4'") 
		or die ("Error.<hr>" . QUER_ERR);
		if(!pg_num_rows($check))
		{
			$query = "INSERT INTO " . PGSQL_TABLE . " (" . $key . ") " . " VALUES " . "( ". $value . ")";
			
			if($result = pg_query($this->connectionLink, $query))
			{
				return $result;
			}
			else
			{
				return QUER_ERR;
			}
		}
    }
    

	/*
	*	gets variable by key
	*/    
    public function getData($key)
    {
        $query = "SELECT " . $key  .  " FROM " . PGSQL_TABLE . " WHERE key='User4' " ;
        if($result = pg_query($this->connectionLink, $query))
		{
				$resultArr = array();
				while($row = pg_fetch_array($result,NULL,1))
				{
					array_push($resultArr,$row);
				}
				
				return $resultArr;
		}
		else
		{
			return SEL_ERR;
		}
        
    }
    
	
	/*
	*	deletes variable by key
	*/
    public function deleteData($key)
    {
        $query =   "DELETE FROM " . PGSQL_TABLE . " WHERE key=" . $key ;
        if($result = pg_query($this->connectionLink, $query))
		{
			return DELETE_SQL;
		}
		else
		{
			return QUER_ERR;
		}	
    }
}
