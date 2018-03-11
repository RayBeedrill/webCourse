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
		return $this->auth->registration($dataArr['name'], $dataArr['secondName'], $dataArr['login'], $dataArr['password'], $dataArr['phone'],$dataArr['email'],$dataArr['discount']);

	}

	public function addDiscount($val)
	{
		$query = "insert into discount (amount) VALUES ('$val')";
		$this->db->sendCustomQuery($query,0);
		return true;
	}

	public function editUser($id_user,$status)
	{
		$query = "UPDATE users SET status='$status' WHERE id_user='$id_user'";
		$this->db->sendCustomQuery($query,0);
		return true;
	}

	public function editDiscount($amount,$id)
	{
		$query = "UPDATE discount SET amount = '$amount' WHERE id_discount='$id'";
		$this->db->sendCustomQuery($query,0);
		return true;
	}

	public function editProfile($data){
		
		$query = "UPDATE customers SET
		 name='".$data['name']."',
		 secondName='".$data['secondName']."',
		 phone='".$data['phone']."'
		 WHERE id_user='".$data['id']."'";
		$this->db->sendCustomQuery($query,0);
		return true;
	}

	public function getDiscount()
	{
		$query = "SELECT * FROM discount";
         return $this->db->sendCustomQuery($query,1);
	}

	public function getAllUsers()
	{
		$query = "SELECT
		customers.id_user,
		customers.name,
		customers.secondName,
		customers.phone,
		customers.email,
		discount.amount as discount,
		users.status,
		roles.name as role
		FROM customers
		LEFT JOIN discount ON customers.id_discount=discount.id_discount
		LEFT JOIN users ON customers.id_user=users.id_user
		LEFT JOIN roles ON users.id_role=roles.id_role";
         return $this->db->sendCustomQuery($query,1);
	}

	public function getUserById($id)
	{
		$query = "SELECT
		customers.id_user,
		customers.name,
		customers.secondName,
		customers.phone,
		customers.email,
		discount.amount as discount,
		users.status,
		roles.name as role
		FROM customers
		LEFT JOIN discount ON customers.id_discount=discount.id_discount
		LEFT JOIN users ON customers.id_user=users.id_user
		LEFT JOIN roles ON users.id_role=roles.id_role  WHERE users.id_user='" . $id ."'";
         return $this->db->sendCustomQuery($query,1);
	}

	public function getAllUserStatus()
	{
		$query = "SELECT
		customers.id_user,
		customers.name,
		customers.secondName,
		customers.phone,
		customers.email,
		discount.amount as discount,
		users.status,
		roles.name as role
		FROM customers
		LEFT JOIN discount ON customers.id_discount=discount.id_discount
		LEFT JOIN users ON customers.id_user=users.id_user
		LEFT JOIN roles ON users.id_role=roles.id_role";
         return $this->db->sendCustomQuery($query,1);
	}
}
