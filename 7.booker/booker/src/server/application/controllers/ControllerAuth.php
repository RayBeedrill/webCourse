<?php
namespace application\controllers;
use application\core as core;
use application\libs\auth as auth;
use application\models as model;
use application\libs\validator as valid;

/**
 *  Auth controller get user info validates data and send to Admin model
 *  or returns data for user request
 */
class ControllerAuth extends core\Controller
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
		$viewName = 'application\api\auth\\' . $class;
    $this->auth = new auth\Auth;
    $this->validator = new valid\Validator;

		$this->model = new $modelName;
		$this->view = new $viewName;
	}

  /**
   * @param  string
   *
   * Checks authorizated user or not
   */
	public function actionGet($input)
    {
 		$response = $this->auth->check();
    $this->view->getAuth($input,$response);
	}

  /**
   *  send request for registrating user in db
   */
	public function actionPost()
	{
    $data = $this->getPostData();
    $valid = $this->validator
          ->registRule('name',array('rule' => 'isText', 'args' => 20))
          ->registRule('login',array('rule' => 'isNumText', 'args' => 20))
          ->registRule('pass','checkPass')
          ->registRule('email','isEmail')
          ->validate($data);

      
    if($valid['name'] && $valid['login'] && $valid['pass'] && $valid['email'])
    {
      $res = $this->model->addUser($data);
      $this->view->postAuth('',$res);
    }
    else
    {
      $this->view->postAuth('',$valid);
    }
  }

  /**
   *  logins user into app
   */
	public function actionPut()
	{
    $data = $this->getPutData();
    
    $valid = $this->validator
          ->registRule('login',array('rule' => 'isNumText', 'args' => 20))
          ->registRule('pass','checkPass')
          ->validate($data);

    if($valid['login'] && $valid['pass'])
    {
      $var = $this->auth->login($data['login'],$data['pass']);
      $this->view->putAuth('',$var);
    }
    else
    {
      $this->view->putAuth('',$valid);
    }
	}

  /**
   *  Logouts user from app
   */
	public function actionDelete()
	{
	  $res =	$this->auth->logout();
    $this->view->deleteAuth('',$res);
  }
}
