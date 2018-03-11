<?php
namespace application\controllers;
use application\core as core;
use application\api\filters as filters;
use application\models as model;

class ControllerFilters extends core\Controller
{

    private $modelCart;
    private $modelBooks;

	public function __construct($class)
	{
		$modelNameBook = 'application\models\\ModelBooks';
		$modelNameCart = 'application\models\\ModelCart';
		$viewName = 'application\api\filters\\' . $class;

		$this->modelCart = new $modelNameCart;
		$this->modelBooks = new $modelNameBook;
		$this->view = new $viewName;
	}

	public function actionGet($input)
    {
        $data = $this->parseGetData($input);
        switch($data[0])
        {
            case 'payment':
                $result = $this->modelCart->getPaymentMethods();
                break;
            case 'status':
                $result = $this->modelCart->getStatusList();
                break;
            case 'authors':
                $result = $this->modelBooks->getAllAuthors();
                break;
            case 'genres':
                $result = $this->modelBooks->getAllGenres();
                break;
        }
        $this->view->getFilters($input,$result);
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
