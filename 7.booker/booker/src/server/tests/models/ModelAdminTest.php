<?php

use application\models;

/**
 * Testing of the class
 * Class: ModelAdmin
 */
class ModelAdminTest extends PHPUnit_Framework_TestCase
{
  /**
   * @dataProvider userInfo
   */
  public function testAddUser($arr)
  {
    $obj = new application\models\ModelAdmin;
    $this->assertInternalType('bool',$obj->AddUser($arr));
    unset($obj);
  }

  public function userInfo()
  {
    return array(
        array(      
          array(        
          'id' => '8',
          'name' => 'someTestName',
          'login' => 'someTestLogin',
          'pass' => 'testPass',
          'email' => 'someTestEmail@gmail.com'
          )
        )
     );
  }
  
  public function testGetAllUsers()
  {
    $obj = new application\models\ModelAdmin;
    $this->assertInternalType('array',$obj->getAllUsers());
    unset($obj);

  }

  /**
   * @dataProvider userInfo
   */
  public function testGetUserById($arr)
  {
    $obj = new application\models\ModelAdmin;
    $this->assertInternalType('array',$obj->getUserById($arr['id']));
    unset($obj);

  }
  
  
  /**
   * @dataProvider userInfo
   */
  public function testUpdateUser($arr)
  {
    $obj = new application\models\ModelAdmin;
    $this->assertTrue($obj->updateUser($arr['id'],$arr['name'],$arr['email'],$arr['login'],$arr['pass']));
    unset($obj);
  }
  
  /**
   * @dataProvider userInfo
   */
  public function testRemoveUser($arr)
  {
    $obj = new application\models\ModelAdmin;
    $this->assertTrue($obj->removeUser($arr['id']));
    unset($obj);
  }
}
