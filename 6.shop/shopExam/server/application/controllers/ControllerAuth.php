<?php
namespace application\controllers;
use application\core as core;
use application\libs\auth as auth;
use application\models as model;

class ControllerAuth extends core\Controller
{
	private $auth;

	public function __construct($class)
	{

		$modelName = 'application\models\\ModelAdmin';
		$viewName = 'application\api\auth\\' . $class;
		$this->auth = new auth\Auth;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$response = $this->auth->check();
       	$this->view->getAuth($input,$response);
	}

	public function actionPost()
	{

	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$var = $this->auth->login($data['login'],$data['pass']);
		echo json_encode($var) ;
	}

	public function actionDelete()
	{
		$this->auth->logout();
    }
}
