<?php
namespace application\controllers;
use application\core as core;
use application\api\payment as payment;
use application\models as model;

class ControllerPayment extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelCart';
		$viewName = 'application\api\payment\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$result = $this->model->getPaymentMethods();
 		$this->view->getPayment($input,$result);
	}

	public function actionPost()
	{
		
	}

	public function actionPut()
	{
		
	}

	public function actionDelete()
	{
		
    }


}
