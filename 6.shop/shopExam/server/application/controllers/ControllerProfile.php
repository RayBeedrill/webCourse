<?php
namespace application\controllers;
use application\core as core;
use application\api\profile as profile;
use application\models as model;

class ControllerProfile extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelAdmin';
		$viewName = 'application\api\profile\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
	}

	public function actionPost()
	{
		
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->editProfile($data);
	}

	public function actionDelete()
	{
		
    }


}
