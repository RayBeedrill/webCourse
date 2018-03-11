<?php
namespace application\controllers;
use application\core as core;
use application\libs\auth as auth;
use application\models as model;

/**
 *  Controller registrate new events and return info about created
 */
class ControllerEvents extends core\Controller
{
	private $auth;

  /**
   * @param string
   *
   * Creates instance of class, and all secondary classes
   */
	public function __construct($class)
	{

		$modelName = 'application\models\\ModelCalendar';
		$viewName = 'application\api\events\\' . $class;
		

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

  /**
   * @param  string
   *  Get all ivents in month 
   *  or one event by id
   */
	public function actionGet($input)
  {
 		$data = $this->parseGetData($input);
 		if(strlen($data[0]) > 0 && strlen($data[1]) > 0)
 		{
      
 			$result = $this->model->getEvents($data[0],$data[1]);
 			$this->view->getEvents($input,$result); 			
    }
    elseif (strlen($data[0]) > 0)
 		{
 			$result = $this->model->getEventById($data[0]);
 			$this->view->getEvents($input,$result);
 		}

	}

  /**
   * create new event
   */
	public function actionPost()
	{
      $data = $this->getPostData();
      if($data['recurring'] == "false")
      {
        $result =	$this->model->addEvent($data['roomId'],$data['user'],$data['dayCreation'],$data['startEvent'],$data['endEvent'],$data['desc']);   
      	$this->view->postEvents('',$result);
      }
      else
      {
      	$result =  $this->model->addEvent($data['roomId'],$data['user'],$data['dayCreation'],$data['startEvent'],$data['endEvent'],$data['desc'],$data['recurring'],$data['recType'], $data['recDuration']);   
        $this->view->postEvents('',$result);
      }
      
	}

  /**
   *  update one event or group of recurring events
   */
	public function actionPut()
	{
		$data = $this->getPutData();
    
    if($data['recurring'] == "false")
    {
		  $result =  $this->model->editEvent($data['roomId'],$data['user'],$data['dayCreation'],$data['startEvent'],$data['endEvent'], $data['eventId']);   
      $this->view->putEvents('',$result);
    }
    else
    {
		  $result = $this->model->editEvent($data['roomId'],$data['user'],$data['dayCreation'],$data['startEvent'],$data['endEvent'],$data['eventId'], $data['recurring'], $data['recType'], $data['recDuration']);   
    
      $this->view->putEvents('',$result);
    }
	}

  /**
   * @param  input
   * delete one event or group of recurring events
   */
	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);

    if(strlen($data[0]) > 0 && strlen($data[1]) > 0)
    {
		  $res = $this->model->deleteEvent($data[0],$data[1]);
      $this->view->deleteEvents('',$res);
    }
    elseif (strlen($data[0]) > 0)
    {
		  $res = $this->model->deleteEvent($data[0]);
      $this->view->deleteEvents('',$res);
    }
  }
}
