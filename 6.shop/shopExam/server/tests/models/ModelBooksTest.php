<?php
use application\models;

class ModelBooksTest extends PHPUnit_Framework_TestCase
{
	   public function testGetAllBooks()
   	{
         $obj = new application\models\ModelBooks;
         $this->assertInternalType('array', $obj->getAllBooks());  
         unset($obj);
   	}

   	public function testGetAllAuthors()
   	{
   	   $obj = new application\models\ModelBooks;
         $this->assertInternalType('array', $obj->getAllAuthors());  
         unset($obj);	
   	}

   	public function testGetAllGenres()
   	{
   	   $obj = new application\models\ModelBooks;
         $this->assertInternalType('array', $obj->getAllGenres());  
         unset($obj);	
   	}

   	public function testGetBookById()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertInternalType('array', $obj->getBookById('1'));  
         unset($obj);
   	}

   	public function testAddBook()
   	{
   	  $data = array(
            'title' => 'bookTest',
            'price' => '100',
            'shortDesc' => 'descTest',
            'desc' => 'descTest',
            'authors'=>['1','2'],
            'genres'=>['1','2']
         );
      	$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->addBook($data));  
         unset($obj);
   	}

   	public function testEditBook()
   	{
         $data = array(
            'id' => 3,
            'title' => 'bookUpdate',
            'price' => '2',
            'shortDesc' => 'descUp',
            'desc' => 'descUp',
            'authors'=>['3','4'],
            'genres'=>['4','3']
         );
   	   $obj = new application\models\ModelBooks;
         $this->assertTrue($obj->editBook($data));  
         unset($obj);	
   	}

   	public function testAddAuthor()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->addAuthor("sqlAuthor"));  
         unset($obj);
   	}

   	public function testAddGenre()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->addGenre("sqlGenre"));  
         unset($obj);
   	}

   	public function testEditAuthor()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->editAuthor('1','updtAuthor'));  
         unset($obj);
   	}

   	public function testEditGenre()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->editGenre('1','updtGenre'));  
         unset($obj);
   	}

   	public function testDeleteBook()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->deleteBook('1'));  
         unset($obj);
   	}

   	public function testDeleteAuthor()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->deleteAuthor('1'));  
         unset($obj);
   	}

   	public function testDeleteGenre()
   	{
   		$obj = new application\models\ModelBooks;
         $this->assertTrue($obj->deleteGenre('1'));  
         unset($obj);
   	}
}
