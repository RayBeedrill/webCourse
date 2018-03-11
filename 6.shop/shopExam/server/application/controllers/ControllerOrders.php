<?php
namespace application\controllers;
use application\core as core;
use application\api\orders as orders;
use application\models as model;

class ControllerOrders extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelCart';
		$viewName = 'application\api\orders\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$data = $this->parseGetData($input);
 		if(strlen($data[0]) > 0)
 		{
 			$result = $this->model->getAllUserOrders($data[0]);
 		}
 		else
 		{
 			$result = $this->model->getAllOrders();
 		}
 		$this->view->getOrders($input,$result);
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		$this->model->makeOrder($data['id_user'],$data['id_payment'],$data['id_book'],$data['count'],$data['discount']);
		
	}

	public function actionPut()
	{
		
	}

	public function actionDelete()
	{
		
    }


}
