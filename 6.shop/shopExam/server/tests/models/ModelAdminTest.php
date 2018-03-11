<?php
use application\models;

class ModelAdminTest extends PHPUnit_Framework_TestCase
{
	public function testAddUser()
	{
		$data = array(
			'name' => 'testName1',
			'secondName' => 'testSecondName1',
			'login' => 'testLoginName1',
			'password' => 'testPassName1',
			'email' => 'testEmailName1',
			'phone' => 'testPhoneName1',
		);
		$obj = new application\models\ModelAdmin;
		$this->assertInternalType('bool',$obj->addUser($data));	
		unset($obj);
	}

	public function testAddDiscount()
	{
		$obj = new application\models\ModelAdmin;
		$this->assertTrue($obj->addDiscount('0'));	
		unset($obj);	
	}

	public function testEditUser()
	{
		$obj = new application\models\ModelAdmin;
		$this->assertTrue($obj->editUser('1','2'));	
		unset($obj);
	}

	public function testEditDiscount()
	{
		$obj = new application\models\ModelAdmin;
		$this->assertTrue($obj->editDiscount('0','1'));	
		unset($obj);
	}
}
