<?php

namespace application\libs\auth;
use application\libs\dbWork as db;
use application\libs\cookiesWork as cookie;

/**
 *  Class for working with login, authorithation, and authentication
 */
class Auth
{
	private $token;
	private $login;
	private $pass;
	private $id;

	private $db;
	private $cookie;

	public function __construct()
	{
		$this->db = new db\PdoWork('Mysql');
		$this->cookie = new cookie\CookiesWork;
	}

	/**
	 * @param  string
	 * @param  string
	 * @param  string
	 * @param  string
	 * @param  integer
	 * @return boolean
	 *
	 * Registrate new user in db
	 */
	public function registration($name, $login, $pass,$email, $id_role=2)
	{
		$query = "SELECT COUNT(id_user) as count FROM bk_users WHERE login='". $login ."'";
		$result = $this->db->sendCustomQuery($query,1);
		$count = (int)$result[0]['count'];
		
		if($count > 0)
		{
			return false;
		}

		if($count === 0)
		{
			$password = md5(md5(trim($pass)));
			$query = "INSERT INTO bk_users (login, pass,id_role, name, email) VALUES ('$login', '$password','$id_role','$name','$email')";  
			$this->db->sendCustomQuery($query,0);			
			return true;
		}
		
	}

	/**
	 *  Deletes cookie from user
	 */
	public function logout()
	{
		$this->cookie->deleteCookies('id', 60*60*24*30*2);
		$this->cookie->deleteCookies('hash', 60*60*24*30*2);
		$this->login = '';
		$this->pass ='';
		$this->id ='';
	}

	/**
	 * @return boolean
	 * Check current user on succsess login
	 */
	public function check()
	{
		$id = $this->cookie->getCookiesData('id');
		$hash = $this->cookie->getCookiesData('hash');
		if($id && $hash)
		{
			$query = "SELECT userHash,id_role FROM bk_users WHERE id_user='". $id ."'";
			$result = $this->db->sendCustomQuery($query,1);
			
			if($hash === $result[0]['userHash'])
			{
				return $result[0];
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
	}

	/**
	 * @param  string
	 * @param  string
	 * @return boolean
	 *
	 * Logins user and set cookie token
	 */
	public function login($login,$pass)
	{
		if($this->authorization($login))
		{
			
			return $this->authentication($this->id,$pass);
			
			
		}
		else
		{
			return false;
		}
	}

	/**
	 * @param  string
	 * @return boolean
	 * Checks availability of acount in db
	 */
	private function authorization($login)
	{
		$query = "SELECT id_user,  pass, userHash FROM bk_users WHERE login='". $login ."'";
		$result = $this->db->sendCustomQuery($query,1);

		if(count($result) === 1)
		{

			$this->login = $login;
			$this->pass = $result[0]['pass'];
			$this->id = $result[0]['id_user'];
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return boolean
	 *
	 * check user acount and logins him
	 */
	private function authentication($id,$pass,$test=TEST_MODE)
	{

		if($this->pass === md5(md5($pass)))
		{
			$hash = md5($this->createToken(10));
			$query = "UPDATE bk_users SET userHash='" . $hash . "' WHERE id_user='". $id . "'";

			$this->db->sendCustomQuery($query,0);
			if(!$test)
			{
				$this->setCookieToken($id,$hash);
			}
			return true;
		}
		else
		{
			return false;
		}	
	}

	/**
	 * @param string
	 * @param string
	 *
	 * Sets cookie token for user
	 */
	private function setCookieToken($id, $token)
	{
    	$id = $this->cookie->createCookies('id', $id, 60*60*24*30);
    	$hash = $this->cookie->createCookies('hash', $token, 60*60*24*30);
	}

	/**
	 * @param  integer
	 * @return string
	 *
	 * creates user hash
	 */
	private function createToken($amount = 6)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789';
 		$string = '';
 		$length = strlen($chars) - 1;
 		while (strlen($string) < $amount)
 		{
 			$string .= $chars[mt_rand(0,$length)];
 		}
 		return md5($string);
	}
}
