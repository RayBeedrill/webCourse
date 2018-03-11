<?php

use application\libs\dbWork as db;

/**
 *  Testing of the class
 *  Class: PdoWork
 */
class PdoWorkTest extends PHPUnit_Framework_TestCase
{
	public function testSendQueryString()
	{
		$db = new db\PdoWork('Mysql');
		$result = $db->setSelectVal('bk_events.id_event')->setFromVal('bk_events')->sendQueryString();
 		$this->assertInternalType('array', $result);
 		unset($db);
	}

	public function testSendCustomQuery()
	{
		$db = new db\PdoWork('Mysql');
		$query = "SELECT bk_events.id_event FROM bk_events";
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