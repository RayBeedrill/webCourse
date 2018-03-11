<?php
namespace application\controllers;
use application\core as core;
use application\api\books as books;
use application\models as model;

class ControllerBooks extends core\Controller
{

	public function __construct($class)
	{
		$modelName = 'application\models\\ModelBooks';
		$viewName = 'application\api\books\\' . $class;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
 		$data = $this->parseGetData($input);

 		if(strlen($data[0]) > 0)
 		{
 			$result = $this->model->getBookById($data[0]);	
 			$this->view->getBooks($input,$result);
 		}
 		else
 		{
 			$result = $this->model->getAllBooks();
 			$this->view->getBooks($input,$result);	
 		}
	}

	public function actionPost()
	{
		$data = $this->getPostData();
		$result = $this->model->addBook($data, $data['discount']);
		var_dump($result);
		
	}

	public function actionPut()
	{
		$data = $this->getPutData();
		$this->model->editBook($data);	
		
	}

	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);
		$this->model->deleteBook($data[0]);
    }


}
