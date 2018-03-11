<?php
namespace application\controllers;
use application\core as core;
use application\api\authors as authors;
use application\models as model;

class ControllerAuthors extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelBooks';
		$viewName = 'application\api\authors\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$authors = $this->model->getAllAuthors();
 		$this->view->getAuthors($input,$authors);
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		$this->model->addAuthor($data['name']);
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->editAuthor($data['id'],$data['name']);	
	}

	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);
		$this->model->deleteAuthor($data[0]);
    }


}
