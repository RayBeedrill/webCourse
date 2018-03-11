<?php
/*
*	Cookies class provide work with cookie data 
*/
class Cookies implements iWorkData
{
	
	/*
	*	this method set cookie and send variable in it
	*/
    public function saveData($key, $val)
    {
        setcookie($key, $val, time() + COOK_LIFETIME);
        $_COOKIE[$key] = $val;
    }

	
	/*
	*	get veriable from cookie
	*/
    public function getData($key)
    {
        if(isset($_COOKIE[$key]))
        {
            return $_COOKIE[$key];
        }
        else
        {
            return COOK_ERR;
        }
    }
	
	
	/*
	*	delete cookie
	*/
    public function deleteData($key)
    {
        unset($_COOKIE[$key]);
        return   setcookie($key, '', time() - 3600);
    }

}
