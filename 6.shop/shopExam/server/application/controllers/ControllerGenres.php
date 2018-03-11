<?php
namespace application\controllers;
use application\core as core;
use application\api\genres as genres;
use application\models as model;

class ControllerGenres extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelBooks';
		$viewName = 'application\api\genres\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$result = $this->model->getAllGenres();
 		$this->view->getGenres($input,$result);
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		$this->model->addGenre($data['genre']);
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->editGenre($data['id'],$data['genre']);	
	}

	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);
		$this->model->deleteGenre($data[0]);		
    }


}
