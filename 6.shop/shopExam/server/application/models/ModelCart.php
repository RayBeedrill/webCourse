<?php
namespace application\models;
use application\core as core;
use application\libs\dbWork as db;


class ModelCart extends core\Model
{
   	protected $db;

   	public function __construct()
   	{
        $this->db = new db\PdoWork('Mysql');
   	}

   	public function addToCart($id_user, $id_book, $count)
   	{
   		$query = "SELECT COUNT(id_cart) as count FROM cart WHERE id_book='". $id_book ."' AND id_user='".$id_user."'";
        $result = $this->db->sendCustomQuery($query,1);
        $countBook = (int)$result[0]['count'];
        
        if($countBook === 0)
        {
  	   		$query = "INSERT INTO cart (id_user,id_book, count) VALUES ('". $id_user ."','". $id_book ."','". $count ."')";
          $this->db->sendCustomQuery($query,0);

   		  }
   		return true;
   	}

    public function getCartById($id)
    {
        $query = "SELECT 
cart.id_cart,
cart.id_book,
books.title, 
cart.count ,
discount.amount,
books.price
FROM cart
LEFT JOIN books ON cart.id_book=books.id_book 
LEFT JOIN discount ON books.id_discount=discount.id_discount 
WHERE cart.id_user='".$id."'";
  return  $this->db->sendCustomQuery($query,1);  
    }

   	public function removeFromCart($id)
   	{
	   	$query = "DELETE FROM cart WHERE id_cart='".$id."'";
	   	$this->db->sendCustomQuery($query,0);
   		return true;	
   	}

   	public function makeOrder($id_user,$id_payment,$id_book,$count,$discount,$id_status = 1)
   	{
		$query = "INSERT INTO orders (id_user, id_status, id_payment,data) VALUES ('".$id_user."','".$id_status."','".$id_payment."',NOW())";
		$this->db->sendCustomQuery($query,0);
	   	$id = $this->db->getLastIdRecord();
	   	$query = "INSERT INTO order_full_info(id_order,id_book,quantity,discount) VALUES ('".$id."','".$id_book."','".$count."','".$discount."')";
		$this->db->sendCustomQuery($query,0);
		return true;
   	}

   	public function getAllOrders()
    {
         $query = "SELECT 
			orders.id_order,
			orders.id_user,
			customers.name,
			customers.secondName,
			customers.phone,
			customers.email,
			order_full_info.id_book,
			books.title,
			authors.name as author,
			order_full_info.quantity,
			books.price,
			order_full_info.discount,
			payment.name as payment_method,
			status.name as status
			FROM orders
			LEFT JOIN order_full_info ON orders.id_order=order_full_info.id_order
			LEFT JOIN customers ON orders.id_user=customers.id_user
			LEFT JOIN books ON order_full_info.id_book=books.id_book
			LEFT JOIN booksAuthor ON order_full_info.id_book=booksAuthor.id_book  
			LEFT JOIN authors ON authors.id_author=booksAuthor.id_author
			LEFT JOIN payment ON orders.id_payment=payment.id_payment
			LEFT JOIN status ON orders.id_status=status.id_status
			";
	return	$this->db->sendCustomQuery($query,1);
    }

      public function getAllUserOrders($id)
   	{
   		$query = "SELECT 
orders.id_order,
orders.id_user,
customers.name,
customers.secondName,
customers.phone,
customers.email,
order_full_info.id_book,
books.title,
authors.name as author,
order_full_info.quantity,
books.price,
order_full_info.discount,
payment.name as payment_method,
status.name as status
FROM orders
LEFT JOIN order_full_info ON orders.id_order=order_full_info.id_order
LEFT JOIN customers ON orders.id_user=customers.id_user
LEFT JOIN books ON order_full_info.id_book=books.id_book
LEFT JOIN booksAuthor ON order_full_info.id_book=booksAuthor.id_book  
LEFT JOIN authors ON authors.id_author=booksAuthor.id_author
LEFT JOIN payment ON orders.id_payment=payment.id_payment
LEFT JOIN status ON orders.id_status=status.id_status
WHERE orders.id_user='".$id."'
";
	return	$this->db->sendCustomQuery($query,1);	
   	}

   	public function getPaymentMethods()
   	{
   		$query = "SELECT id_payment, name FROM payment";
	return	$this->db->sendCustomQuery($query,1);		
   	}

   	public function getStatusList()
   	{
   		$query = "SELECT id_status, name FROM status";
	return	$this->db->sendCustomQuery($query,1);			
   	}

   	public function changeStatus($id,$status)
   	{
   		$query = "UPDATE orders SET id_status='".$status."' WHERE id_order='".$id."'";
		$this->db->sendCustomQuery($query,0);		
		return true;	
   	}

}
