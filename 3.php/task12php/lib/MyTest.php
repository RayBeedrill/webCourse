<?php

class MyTest extends ActiveRecords
{

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
            $result = $this->getDescribeTable(); 
            $this->setColsArr($result);
            return 1;
        } 
    }

    public function __destruct()
    {
        mysql_close($this->connectionLink);
    }
    
    private function getDescribeTable()
    {
        $query = ' DESCRIBE ' . MYSQL_TABLE;
        $result = mysql_query($query,$this->connectionLink);
        if(!$result)
        {
            $message = "Wrong query: " . mysql_error() . "\n";
            $massage .= "Your query: " . $query;
            throw new Exception($message);
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
                
                $this->setColsArr($resultEnd);
                
            }
            else
            {
                throw new Exception($result);
            }
        }
    }

    private function setColsArr($arr)
    {
        if(is_array($arr))
        {
            foreach($arr as $value)
            {
                foreach($value as $key => $value)
                {
                    if('Field' === $key )
                    {
                        $this->colsArr[$value] = '';
                    }
                }    
            }
        }
    }

   public function save()
    {   
        $check_query = 'SELECT ' . '`key`,`data`' . ' FROM ' . MYSQL_TABLE . ' WHERE `key`=' .  $this->colsArr['key'] ; 
        $check = mysql_query($check_query , $this->connectionLink);
        if(!mysql_num_rows($check))
        {
            $cols = '`key`,`data`';
            $values =   $this->colsArr['key'] . "," . $this->colsArr['data'] ;
            $condition = '`key`=' . $this->colsArr['key'] ;
            $this->setInsertVal(MYSQL_TABLE, $cols)->setValuesVal($values); 
            $query = $this->sendQueryString();
         
      
        }
        else
        {
            $cols = '`key`,`data`';
            $values =  '`key`=' . $this->colsArr['key'] . "," . '`data`=' . $this->colsArr['data'] ;
            $condition = '`key`=' . $this->colsArr['key']  ;
            $this->setUpdateVal(MYSQL_TABLE)->setSetVal($values)->setWhereVal($condition); 
            $query = $this->sendQueryString();
            
            
            
        } 
    }

    public function find($var)
    {
        $this->setSelectVal($var)->setFromVal(MYSQL_TABLE);  
        $query = $this->sendQueryString();
        return $query;
    }

    public function delete($condition)
    {
        $this->setDeleteVal(MYSQL_TABLE)->setWhereVal($condition);
        $query = $this->sendQueryString();
        return $query;      
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
				return $resultEnd;
			}
            else
			{
				return $row = $result;
			}
        }
    }
}
