<?php
namespace application\libs\cookiesWork;

/**
 *  Class for working with cookie
 */
class CookiesWork
{
	/**
	 * @param  string
	 * @param  string
	 * @param  string
	 * @param  string
	 * 
	 * 	sets cookie for user
	 */
	public function createCookies($name,$data,$time, $path = '/')
	{
		setcookie($name, $data, time()+$time, $path);
	}

	/**
	 * @param  string
	 * @return string
	 *
	 * Get info about user cookie
	 */
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
	
	/**
	 * @param  string
	 * @param  string
	 * @return string
	 *
	 * deletes cookie for user
	 */
	public function deleteCookies($name, $time)
	{
		unset($_COOKIE[$name]);
        return   setcookie($name, '', time() - $time, '/');
	}
}