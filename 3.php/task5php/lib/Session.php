<?php
/*
*
*	Class Session created to work with session data
*
*/
class Session implements iWorkData
{

	/*
	*	constructor starts session
	*/
    public function __construct()
    {
        session_start();
    }

	/*
	*	Saves session variable 
	*/
    public function saveData($key, $val)
    {
        if(!isset($_SESSION[$key]))
        {
            $_SESSION[$key] = $val;
        }
        else
        {
            return SES_ERR;
        }
    }
	

	/*
	*	reads session variable
	*/	
    public function getData($key)
    {
        if(isset($_SESSION[$key]))
        {
           return  $val = $_SESSION[$key];
        }
        else
        {
           return SES_VAL;
        } 
    }

	
	/*
	*	deletes session variable
	*/
    public function deleteData($key)
    {
        if(isset($_SESSION[$key]))
        {
          unset($_SESSION[$key]);
        }
        else
        {
           return SES_VAL;
        }
    }
	
	
	/*
	*	destructor ends session
	*/
    public function __destruct()
    {
        session_write_close();
    }
}

