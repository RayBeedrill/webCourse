<?php
use application\models;

/**
 *  Testing of the class
 *  Class: ModelCalendar
 */
class ModelCalendarTest extends PHPUnit_Framework_TestCase
{
  public function eventDataProvider()
  {
    return array(
      array(
        array(
          'id'=>'1',
          'room'=>'1',
          'user'=>'1',
          'dayCreation'=>'1525802430',
          'start' =>'1525881630',
          'end' =>'1525888830',
          'desc' => 'someDescriptTest',
          'recurring' => 'false',
          'year' => '2017',
          'month' => '11'
           
        )
      )
    );
  }
  
  public function testGetRooms()
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->getRooms());
    unset($obj);
  }
  
   /**
   * @dataProvider eventDataProvider
   */
  public function testGetEvents($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->getEvents($arr['year'],$arr['month']));
    unset($obj);
  }

  /**
   * @dataProvider eventDataProvider
   */
  public function testGetEventById($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->getEventById($arr['id']));
    unset($obj);

  }
  
  /**
   * @dataProvider eventDataProvider
   */
  public function testAddEvent($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->addEvent($arr['room'],$arr['user'],$arr['dayCreation'],$arr['start'],$arr['end'],$arr['desc']));
    unset($obj);
  }
  
  /**
   * @dataProvider eventDataProvider
   */
  public function testEditEvent($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->editEvent($arr['room'],$arr['user'],$arr['dayCreation'],$arr['start'],$arr['end'],$arr['id']));
    unset($obj);
  }
  
  /**
   * @dataProvider eventDataProvider
   */
  public function testDeleteEvent($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('array', $obj->deleteEvent($arr['id']));
    unset($obj);
  }
  
  /**
   * @dataProvider eventDataProvider
   */
  public function testCheckEvent($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('bool', $obj->checkEvent($arr['start'],$arr['end'],$arr['room']));
    unset($obj);
  }
  
  /**
   * @dataProvider eventDataProvider
   */
  public function testCheckHolydays($arr)
  {
    $obj = new application\models\ModelCalendar;
    $this->assertInternalType('bool', $obj->checkHolydays($arr['start']));
    unset($obj);
  }
}

