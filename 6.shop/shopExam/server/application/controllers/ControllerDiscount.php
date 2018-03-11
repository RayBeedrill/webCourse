<?php
namespace application\controllers;
use application\core as core;
use application\api\discount as discount;
use application\models as model;

class ControllerDiscount extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelAdmin';
		$viewName = 'application\api\discount\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
    	$discount = $this->model->getDiscount();
 		$this->view->getDiscount($input,$discount);
    }

	public function actionPost()
	{
        $data = $this->getPostData();
        $this->model->addDiscount($data['value']);
	}

	public function actionPut()
	{
		$data = $this->getPutData();
        $this->model->editDiscount($data['id'],$data['value']);
	}

	public function actionDelete()
	{
		
    }


}
