<?php
namespace application\controllers;
use application\core as core;
use application\api\status as status;
use application\models as model;

class ControllerStatus extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelCart';
		$viewName = 'application\api\status\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
    	$result = $this->model->getStatusList();
    	$this->view->getStatus($input,$result);
 
	}

	public function actionPost()
	{
		
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->changeStatus($data['id'],$data['status']);
	}

	public function actionDelete()
	{
		
    }


}
