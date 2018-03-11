<?php
use application\models;



class ModelCartTest extends PHPUnit_Framework_TestCase
{
   	public function testAddToCart()
   	{
         $obj = new application\models\ModelCart;
         $this->assertTrue($obj->addToCart('3','3','30'));  
         unset($obj);   
   	}

   	public function testRemoveFromCart()
   	{
   	   $obj = new application\models\ModelCart;
         $this->assertTrue($obj->removeFromCart('1'));  
         unset($obj);   	
   	}

   	public function testMakeOrder()
   	{
   	   $obj = new application\models\ModelCart;
         $this->assertTrue($obj->makeOrder('2','1','1','3','30','30'));  
         unset($obj);   	
   	}

   	public function testGetCartById()
      {
         $obj = new application\models\ModelCart;
         $this->assertInternalType('array',$obj->getCartById('2'));  
         unset($obj);   
      }

      public function testGetAllOrders()
      {
         $obj = new application\models\ModelCart;
         $this->assertInternalType('array',$obj->getAllOrders());  
         unset($obj);   
      }

      public function testGetAllUserOrders()
   	{
   	   $obj = new application\models\ModelCart;
         $this->assertInternalType('array',$obj->getAllUserOrders('3'));  
         unset($obj);   	
   	}

   	public function testGetPaymentMethods()
   	{
   		$obj = new application\models\ModelCart;
         $this->assertInternalType('array',$obj->getPaymentMethods());  
         unset($obj);   
   	}

   	public function testGetStatusList()
   	{
   	   $obj = new application\models\ModelCart;
         $this->assertInternalType('array',$obj->getStatusList());  
         unset($obj);   	
   	}

   	public function testChangeStatus()
   	{
   	   $obj = new application\models\ModelCart;
         $this->assertTrue($obj->changeStatus('1','0'));  
         unset($obj);      	
   	}

   	
}