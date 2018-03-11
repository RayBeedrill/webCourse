<?php
/*
 *
 *PostgreSql class need to build queries for PostgreSql db
 *
 */
class PostgreSql extends Sql
{
    /*
     * constructor build connect to db
     */
    public function __construct()
    {
            $connectString = PGSQL_DB_ADDRESS . " " .  PGSQL_DB . " " . PGSQL_USR . " " . PGSQL_PASS;
            $dbConnection = pg_connect($connectString);
            if(!$dbConnection)
            {
                throw new Exception(CON_ERR);
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
	* sends string which formed by fluid template 
	*/
    public function sendQueryString()
    {
        $query =  parent::sendQueryString();
        
		if($result = pg_query($this->connectionLink, $query))
		{
			if(!is_bool($result))
			{
				$resultArr = array();
				while($row = pg_fetch_array($result, null, PGSQL_ASSOC))
				{
                    array_push($resultArr,$row);
                   
				} 
				$this->resetVal();
				return $resultArr;
			}
			else
			{
				$this->resetVal();
				return $result;
			}
		}
		else
		{
			return QUER_ERR; 
		}
          
   }


}
