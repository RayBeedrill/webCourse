<?php
namespace application\models;
use application\core as core;
use application\libs\dbWork as db;


class ModelBooks extends core\Model
{
	   protected $db;

   	public function __construct()
   	{
        $this->db = new db\PdoWork('Mysql');
   	}

   	public function getAllBooks()
   	{
         $query = "select 
books.id_book,
GROUP_CONCAT(DISTINCT authors.name ORDER BY authors.name ASC SEPARATOR ', ') as authors,
books.title, 
GROUP_CONCAT(DISTINCT genres.name ORDER BY genres.name ASC SEPARATOR ', ') as genres,
books.shortDesc, 
books.description,
books.price, 
discount.amount 
FROM books 
LEFT JOIN booksAuthor ON books.id_book=booksAuthor.id_book  
LEFT JOIN booksGenre ON books.id_book=booksGenre.id_book  
LEFT JOIN authors ON authors.id_author=booksAuthor.id_author 
LEFT JOIN genres ON genres.id_genre=booksGenre.id_genre 
LEFT JOIN discount ON books.id_discount=discount.id_discount
GROUP BY books.id_book";
         return $this->db->sendCustomQuery($query,1);
         
   	}

   	public function getAllAuthors()
   	{
   		$query = "SELECT id_author, name FROM authors";
         return $this->db->sendCustomQuery($query,1);
   	}

   	public function getAllGenres()
   	{
   	  $query = "SELECT id_genre, name FROM genres";
         return $this->db->sendCustomQuery($query,1);	
   	}

   	public function getBookById($id)
   	{
   	   $query = "select 
books.id_book,
GROUP_CONCAT(DISTINCT authors.name ORDER BY authors.name ASC SEPARATOR ', ') as authors,
books.title, 
GROUP_CONCAT(DISTINCT genres.name ORDER BY genres.name ASC SEPARATOR ', ') as genres,
books.shortDesc, 
books.description,
books.price, 
discount.amount 
FROM books 
LEFT JOIN booksAuthor ON books.id_book=booksAuthor.id_book  
LEFT JOIN authors ON authors.id_author=booksAuthor.id_author 
LEFT JOIN booksGenre ON books.id_book=booksGenre.id_book  
LEFT JOIN genres ON genres.id_genre=booksGenre.id_genre 
LEFT JOIN discount ON books.id_discount=discount.id_discount WHERE books.id_book = '$id';";
         return $this->db->sendCustomQuery($query,1); 	
   	}

   	public function addBook($dataArr, $discount = '1')
   	{
         
         $query = "SELECT COUNT(id_book) as count FROM books WHERE title='". $dataArr['title'] ."'";
         $result = $this->db->sendCustomQuery($query,1);
         $count = (int)$result[0]['count'];
         var_dump($dataArr);
         if($count === 0)
         {
             $query = "insert into
         books (title, price, shortDesc, description, id_discount)  
         VALUES (
         '".$dataArr["title"]."',
         '".$dataArr["price"]."',
         '".$dataArr["shortDesc"]."',
         '".$dataArr["desc"]."',
         '".$discount."')";           
            $this->db->sendCustomQuery($query,0); 
            $query = "SELECT id_book FROM books WHERE title='".$dataArr['title']."'";
            $result = $this->db->sendCustomQuery($query,1); 
            $id = $result[0]['id_book'];

            $dataArr['authors'] = explode(',',$dataArr['authors']);
            if(is_array($dataArr['authors']))
            {
               foreach ($dataArr['authors'] as $value) 
               {
                  $query = "insert into booksAuthor (id_book,id_author) VALUES ($id,$value)";               
                  $this->db->sendCustomQuery($query,0); 
               }
            }
            else
            {
               $query = "insert into booksAuthor (id_book,id_author) VALUES ($id,".$dataArr['authors'].")";               
               $this->db->sendCustomQuery($query,0); 
            }
            
            $dataArr['genres'] = explode(',',$dataArr['genres']);
            if(is_array($dataArr['genres']))
            {
               foreach ($dataArr['genres'] as $value) 
               {
                  $query = "insert into booksGenre (id_book,id_genre) VALUES ($id,$value)";               
                  $this->db->sendCustomQuery($query,0); 
               }
            }
            else
            {
               $query = "insert into booksGenre (id_book,id_genre) VALUES ($id,".$dataArr['genres'].")";               
               $this->db->sendCustomQuery($query,0); 
            }

         }

         return true;
   	}

   	public function editBook($dataArr, $discount = 1)
   	{ 
         $query = "UPDATE books
         SET title = '". $dataArr['title'] ."'
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0); 

         $query = "UPDATE books
         SET price = '". $dataArr['price'] ."'
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0); 

         $query = "UPDATE books
         SET shortDesc = '". $dataArr['shortDesc'] ."'
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0);

         $query = "UPDATE books
         SET description = '". $dataArr['desc'] ."'
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0);

         $query = "UPDATE books
         SET id_discount = '". $discount ."'
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0);

         $query = "DELETE FROM booksAuthor
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0);

         $query = "DELETE FROM booksGenre
         WHERE id_book='". $dataArr['id'] ."'";               
         $this->db->sendCustomQuery($query,0);

         $id = $dataArr['id'];

         $dataArr['authors'] = explode(',',$dataArr['authors']);
         if(is_array($dataArr['authors']))
         {

            foreach ($dataArr['authors'] as $value) 
            {
               $query = "insert into booksAuthor (id_book,id_author) VALUES ($id,$value)";               
               $this->db->sendCustomQuery($query,0); 
            }
         }
         else
         {
            $query = "insert into booksAuthor (id_book,id_author) VALUES ($id,".$dataArr['authors'].")";               
            $this->db->sendCustomQuery($query,0); 
         }
         
         $dataArr['genres'] = explode(',',$dataArr['genres']);
         if(is_array($dataArr['genres']))
         {
            foreach ($dataArr['genres'] as $value) 
            {
               $query = "insert into booksGenre (id_book,id_genre) VALUES ($id,$value)";               
               $this->db->sendCustomQuery($query,0); 
            }
         }
         else
         {
            $query = "insert into booksGenre (id_book,id_genre) VALUES ($id,".$dataArr['genres'].")";               
            $this->db->sendCustomQuery($query,0); 
         }
         return true;

   	}

   	public function addAuthor($name)
   	{
   	   $query = "SELECT COUNT(id_author) as count FROM authors WHERE name='". $name ."'";
         $result = $this->db->sendCustomQuery($query,1);
         $count = (int)$result[0]['count'];
         if($count === 0 )
         {
            $query = "insert into authors (name) VALUES ('$name')";
            $result = $this->db->sendCustomQuery($query,0);
         }	
         return true;
   	}

   	public function addGenre($genre)
   	{
   	   $query = "SELECT COUNT(id_genre) as count FROM genres WHERE name='". $genre ."'";
         $result = $this->db->sendCustomQuery($query,1);
         $count = (int)$result[0]['count'];
         if($count === 0 )
         {
            $query = "insert into genres (name) VALUES ('$genre')";
            $result = $this->db->sendCustomQuery($query,0);
         }  
         return true;	
   	}

   	public function editAuthor($id,$value)
   	{
   		$query = "UPDATE authors
SET name = '$value'
WHERE id_author='$id'";
         $result = $this->db->sendCustomQuery($query,0);
         return true;
   	}

   	public function editGenre($id,$value)
   	{
         $query = "UPDATE genres
SET name = '$value'
WHERE id_genre='$id'";
         $result = $this->db->sendCustomQuery($query,0);   		
         return true;
   	}

   	public function deleteBook($id)
   	{
   	   $query = "DELETE FROM booksAuthor
WHERE id_book=$id";
         $result = $this->db->sendCustomQuery($query,0);       
         
         $query = "DELETE FROM booksGenre
WHERE id_book=$id;";
         
         $result = $this->db->sendCustomQuery($query,0);       
$query = "DELETE FROM cart
WHERE id_book=$id";
         
         $result = $this->db->sendCustomQuery($query,0);

$query = "DELETE FROM order_full_info
WHERE id_book=$id";
         
         $result = $this->db->sendCustomQuery($query,0);

         $query = "DELETE FROM books
WHERE id_book=$id";
         $result = $this->db->sendCustomQuery($query,0);       

         
         return true;

   	}

   	public function deleteAuthor($id)
   	{
         $query = "DELETE FROM booksAuthor
WHERE id_author=$id";
         $result = $this->db->sendCustomQuery($query,0);       
         
         $query = "DELETE FROM authors
WHERE id_author=$id";
         $result = $this->db->sendCustomQuery($query,0);                  		
         return true;
   	}

   	public function deleteGenre($id)
   	{
         $query = "DELETE FROM booksGenre
WHERE id_genre=$id";
         
         $result = $this->db->sendCustomQuery($query,0);       
   	  $query = "DELETE FROM genres
WHERE id_genre=$id";
         $result = $this->db->sendCustomQuery($query,0);                      
         return true;	
   	}
}