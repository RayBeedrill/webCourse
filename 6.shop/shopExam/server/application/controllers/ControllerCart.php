<?php
namespace application\controllers;
use application\core as core;
use application\api\cart as cart;
use application\models as model;

class ControllerCart extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelCart';
		$viewName = 'application\api\cart\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$data = $this->parseGetData($input);

 		if(strlen($data[0]) > 0)
 		{
 			$result = $this->model->getCartById($data[0]);	
 			$this->view->getCart($input,$result);
 		}
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		
		$this->model->addToCart($data['id_user'],$data['id_book'],$data['count']);
		
	}

	public function actionPut()
	{
		
	}

	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);
		$this->model->removeFromCart($data[0]);
    }


}
