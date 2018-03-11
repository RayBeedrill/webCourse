<?php

namespace application\libs\auth;
use application\libs\dbWork as db;
use application\libs\cookiesWork as cookie;
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

	public function registration($name, $secondName, $login, $pass,$phone,$email,$id_discount=1,$id_role=2,$status=1)
	{
		$query = "SELECT COUNT(id_user) as count FROM users WHERE login='". $login ."'";
		$result = $this->db->sendCustomQuery($query,1);
		$count = (int)$result[0]['count'];
		
		if($count > 0)
		{
			return false;
		}

		if($count === 0)
		{
			$password = md5(md5(trim($pass)));
			$query = "INSERT INTO users (login, password,id_role,status) VALUES ('$login', '$password','$id_role','$status')";  
			$this->db->sendCustomQuery($query,0);			
			$query = "SELECT id_user FROM users WHERE login='$login'";  
			$result = $this->db->sendCustomQuery($query,1);			
			$id = (int)$result[0]['id_user'];
			
			$query = "INSERT INTO customers (id_user, name,secondName,phone,email, id_discount) VALUES ('$id', '$name', '$secondName','$phone','$email','$id_discount')";
			
			

			$this->db->sendCustomQuery($query,0);			
			return true;
		}
		
	}

	public function logout()
	{
		$this->cookie->deleteCookies('id', 60*60*24*30*2);
		$this->cookie->deleteCookies('hash', 60*60*24*30*2);
		$this->login = '';
		$this->pass ='';
		$this->id ='';
	}

	public function check()
	{
		$id = $this->cookie->getCookiesData('id');
		$hash = $this->cookie->getCookiesData('hash');
		if($id && $hash)
		{
			$query = "SELECT userHash,id_role FROM users WHERE id_user='". $id ."'";
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

	public function login($login,$pass)
	{
		if($this->authorization($login))
		{
			$this->authentication($this->id,$pass);
			return true;
		}
		else
		{
			return false;
		}
	}

	private function authorization($login)
	{
		$query = "SELECT id_user,  password, userHash FROM users WHERE login='". $login ."'";
		$result = $this->db->sendCustomQuery($query,1);

		if(count($result) === 1)
		{
			$this->login = $login;
			$this->pass = $result[0]['password'];
			$this->id = $result[0]['id_user'];
			return true;
		}
		else
		{
			return false;
		}
	}

	private function authentication($id,$pass,$test=TEST_MODE)
	{
		if($this->pass === md5(md5($pass)))
		{

			$hash = md5($this->createToken(10));
			$query = "UPDATE users SET userHash='" . $hash . "' WHERE id_user='". $id . "'";

			$this->db->sendCustomQuery($query,0);
			if(!$test)
			{
				$this->setCookieToken($id,$hash);
			}
			return 1;
		}
		else
		{
			return 0;
		}	
	}

	private function setCookieToken($id, $token)
	{
    	$id = $this->cookie->createCookies('id', $id, 60*60*24*30);
    	$hash = $this->cookie->createCookies('hash', $token, 60*60*24*30);
	}

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