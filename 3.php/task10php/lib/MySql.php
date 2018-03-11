<?php 
/*
 *
 * class MySql need to build queries for Mysql db 
 * 
 *
 */
class MySql extends Sql
{
    /*
     * constructor connects to db
     */
    public function __construct()
    {
            $connect = mysql_connect(MYSQL_DB_ADDRESS, MYSQL_USR, MYSQL_PASS);  
            if(!$connect)
            {
                throw new Exception(CON_ERR);
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
	* sends string which formed by fluid template 
	*/
	public function sendQueryString()
    {
        $query = sprintf( parent::sendQueryString());
        $result = mysql_query($query, $this->connectionLink);
        if(!$result)
        {
           $message = "Wrong query: " . mysql_error() . "\n";
           $massage .= "Your query: " . $query;
           return $message;
        }
        else
        {
			if(!is_bool($result))
			{
				$resultEnd = array();
				while($row = mysql_fetch_array($result,1))
				{
					array_push($resultEnd, $row);
				}
				$this->resetVal();
				return $resultEnd;
			}
            else
			{
				return $row = $result;
			}
        }
    } 


}
