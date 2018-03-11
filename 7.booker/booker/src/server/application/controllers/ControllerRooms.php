<?php
namespace application\controllers;
use application\core as core;
use application\libs\auth as auth;
use application\models as model;

class ControllerRooms extends core\Controller
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
		$viewName = 'application\api\rooms\\' . $class;
		$this->auth = new auth\Auth;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	/**
	 * @param  string
	 * Recives all rooms from db
	 */
	public function actionGet($input)
    {
 		$data = $this->parseGetData($input);
 		$result = $this->model->getRooms();
 		$this->view->getRooms($input,$result);	
	}

	public function actionPost()
	{
        
	}

	public function actionPut()
	{
			
	}

	public function actionDelete($input)
	{
	
  }
}
