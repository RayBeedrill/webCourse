<?php
namespace application\controllers;
use application\core as core;
use application\libs\auth as auth;
use application\libs\validator as valid;
use application\models as model;

class ControllerUsers extends core\Controller
{
	private $auth;
  	private $validator;

  	/**
   	* @param string
   	*
   	* Creates instance of class, and all secondary classes
   	*/
	public function __construct($class)
	{

		$modelName = 'application\models\\ModelAdmin';
		$viewName = 'application\api\users\\' . $class;
    	$this->auth = new auth\Auth;
    	$this->validator = new valid\Validator;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

	/**
	 * @param  string
	 * Get all users or one by id
	 */
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
        
	}

	/**
	 *  Update one user
	 */
	public function actionPut()
	{
	    $data = $this->getPutData();
	    $valid = $this->validator
	          ->registRule('name',array('rule' => 'isText', 'args' => 20))
	          ->registRule('email','isEmail')
	          ->validate($data);


	    if($valid['name'] && $valid['email'])
	    {
			  $res = $this->model->updateUser($data['id'],$data['name'], $data['email']);
	      $this->view->putUsers($input,$res);
	    }
	    else
	    {
	      $this->view->putUsers($input,$valid);
	    }
	}

	/**
	 * @param  string
	 *  Deletes user from db
	 */
	public function actionDelete($input)
	{
		$data = $this->getDeleteParams($input);
		$res = $this->model->removeUser($data[0]);
		$this->view->deleteUsers($input,$res);
  	}
}

