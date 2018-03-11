<?php
namespace application\models;
use application\core as core;
use application\libs\auth as auth;
use application\libs\dbWork as db;


class ModelAdmin extends core\Model
{
	protected $auth;
	protected $db;

	public function __construct()
	{
		$this->auth = new auth\Auth;
		$this->db = new db\PdoWork('Mysql');
	}

	public function addUser($dataArr)
    {       
        
		return $this->auth->registration($dataArr['name'], $dataArr['login'], $dataArr['pass'],$dataArr['email']);

	}

	public function getAllUsers()
	{
        return   $this->db
        ->setSelectVal('id_user, name, email, login')
        ->setFromVal('bk_users')
        ->sendQueryString();
	}

	public function getUserById($id)
	{

		return   $this->db
		->setSelectVal('id_user, name, email, login')
		->setFromVal('bk_users')
		->setWhereVal('id_user="' . $id .'"')
		->sendQueryString();
	}

	public function updateUser($id,$name, $email){

		$password = md5(md5(trim($pass)));
		$this->db
		->setUpdateVal('bk_users')
		->setSetVal('name="' . $name . '", email="' . $email . '"')
		->setWhereVal('id_user="' . $id . '"')
    ->sendQueryString();
    return true;
	}

	public function removeUser($id){
		$this->db->setDeleteVal('bk_events')->setWhereVal('id_user="'.$id.'"')->sendQueryString();
		$this->db->setDeleteVal('bk_users')->setWhereVal('id_user="'.$id.'"')->sendQueryString(); 
    return true;
	}
}
