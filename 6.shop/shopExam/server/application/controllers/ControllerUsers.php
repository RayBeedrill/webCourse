<?php
namespace application\controllers;
use application\core as core;
use application\api\users as users;
use application\models as model;

class ControllerUsers extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelAdmin';
		$viewName = 'application\api\users\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
    	$data = $this->parseGetData($input);

 		if(strlen($data[0]) > 0)
 		{
 			$result = $this->model->getUserById($data[0]);	
 			$this->view->getUsers($input,$result);
 		}
 		else
 		{
 			$result = $this->model->getAllUsers();
 			$this->view->getUsers($input,$result);
 		}
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		$this->model->addUser($data);
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->editUser($data['id_user'],$data['status']);	
	}

	public function actionDelete()
	{
		
    }


}
