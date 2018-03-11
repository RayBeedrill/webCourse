<?php
namespace application\libs\cookiesWork;

class CookiesWork
{
	public function createCookies($name,$data,$time, $path = '/')
	{
		setcookie($name, $data, time()+$time, $path);
	}

	public function getCookiesData($name)
	{
		if (isset($_COOKIE[$name]))
		{
			return $_COOKIE[$name];
		}
		else
		{
			return false;
		}
	}
	
	public function deleteCookies($name, $time)
	{
		unset($_COOKIE[$name]);
        return   setcookie($name, '', time() - $time, '/');
	}
}