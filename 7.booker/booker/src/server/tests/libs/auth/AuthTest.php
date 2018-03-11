<?php
require_once('tests/index.php');
use application\libs\auth as auth;
use application\libs\dbWork as db;
use application\libs\cookiesWork as cookie;

/**
 * Testing of the class
 * Class: Auth
 */
class AuthTest extends PHPUnit_Framework_TestCase
{
	public function testRegistration()
	{
		$auth = new auth\Auth;
		$result = $auth->registration('testName', 'testSecondName', 'testLogin','testPass');
		$this->assertInternalType('bool', $result);
		unset($auth);
	}

	public function testLogin()
	{
		$auth = new auth\Auth;
		$result = $auth->login('testLogin','testPass');
		$this->assertInternalType('bool',$result);
		unset($auth);	
	}


	public function testCheck()
	{
		$auth = new auth\Auth;
		$result = $auth->check();
		$this->assertInternalType('bool', $result);
		unset($auth);
	}

}
