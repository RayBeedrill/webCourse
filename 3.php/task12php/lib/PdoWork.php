<?php

class PdoWork extends Sql
{
	public function __construct($db)
	{
        $mysqlConnect = "mysql:host=" . MYSQL_DB_ADDRESS .";dbname=" .MYSQL_DB ;
        $pgsqlConnect = 'pgsql:' . PGSQL_DB_ADDRESS .";" . PGSQL_DB . ";" . PGSQL_USR . ";" . PGSQL_PASS;
        
        switch($db)
		{
			case "Mysql":
                $pdo = new PDO($mysqlConnect,MYSQL_USR ,MYSQL_PASS );
			break;
			case "Pgsql":
                $pdo = new PDO($pgsqlConnect);
			break;
			default:
				throw new Exception(PDO_DB_CHOOSE);
        }

        $this->connectionLink = $pdo;
        $this->connectionLink->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function __destruct()
    {
        $this->connectionLink = NULL;
    }

    public function sendQueryString()
    {
        $query = sprintf(parent::sendQueryString());
        if(0 === $this->currentOperation)
        {
            $string = $this->connectionLink->prepare($query);
            $string->execute();
        }
        else
        {
            $result = array();
            $string = $this->connectionLink->query($query);
            $string->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $string->fetch()) 
            {
                array_push($result, $row);
            }
            return $result;
        }
        
    }
	
}
