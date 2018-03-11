<?php

use application\libs\dbWork as db;

class PdoWorkTest extends PHPUnit_Framework_TestCase
{
	public function testSendQueryString()
	{
		$db = new db\PdoWork('Mysql');
		$result = $db->setSelectVal('books.title')->setFromVal('books')->sendQueryString();
 		$this->assertInternalType('array', $result);
 		unset($db);
	}

	public function testSendCustomQuery()
	{
		$db = new db\PdoWork('Mysql');
		$query = "SELECT books.title FROM books";
		$result = $db->sendCustomQuery($query,1);
 		$this->assertInternalType('array', $result);
 		unset($db);
	}

	public function testGetLastIdRecord()
	{
		$db = new db\PdoWork('Mysql');
		$result = $db->GetLastIdRecord();
 		$this->assertInternalType('string', $result);
 		unset($db);	
	}
}