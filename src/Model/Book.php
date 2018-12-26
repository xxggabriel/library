<?php 

namespace Model;

use Model\DB\Sql;
use Controller\Model;

class Book extends Model
{

    public function createBook($data = array())
    {
        $sql = new Sql();
        $this->setData($data);

        $sql->query('CALL create_book(:name ,:title ,:description , :id_publisher ,:id_author ,:cust_value ,:rent_value, :sale_cust,:ammount,:date_create,:status_book)', [
                ":name" => $this->getname(),
                ":title" => $this->gettitle(),
                ":description" => $this->getdescription(),
                ":id_publisher" => (int)$this->getid_publisher(),
                ":id_author" => (int)$this->getid_author(),	
                ":cust_value" => (float)$this->getcust_value(),
                ":rent_value" => (float)$this->getrent_value(),
                ":sale_cust" => (float)$this->getsale_cust(),
                ":ammount" => (int)$this->getammount(),
                ":date_create" => $this->getdate_create(),
                ":status_book" => (int)$this->getstatus_book(),
            ]);

    }

    public function updateBook($data)
    {

        $sql = new Sql();
        $this->setData($data);

        $sql->query('CALL update_book(:id_book, :name ,:title ,:description , :id_publisher ,:id_author ,:cust_value ,:rent_value, :sale_cust,:ammount,:date_create,:status_book)', [
            ":id_book" => (int)$this->getid_book(),
            ":name" => $this->getname(),
            ":title" => $this->gettitle(),
            ":description" => $this->getdescription(),
            ":id_publisher" => (int)$this->getid_publisher(),
            ":id_author" => (int)$this->getid_author(),	
            ":cust_value" => (float)$this->getcust_value(),
            ":rent_value" => (float)$this->getrent_value(),
            ":sale_cust" => (float)$this->getsale_cust(),
            ":ammount" => (int)$this->getammount(),
            ":date_create" => $this->getdate_create(),
            ":status_book" => (int)$this->getstatus_book(),
        ]);

    }

    public function deleteBook($id_book)
    {
        $sql = new Sql();

        $sql->query('CALL delete_book(:id_book)',[
            ":id_book" => (int)$id_book
        ]);
    }

    public function selectBook($id_book)
    {
        $sql = new Sql();
        $book  = $sql->select("SELECT * FROM books WHERE id_book = :id_book AND status_book > 0",[
            ":id_book" => (int)$id_book
        ]); 

        return $book;
    }

    public function selectAllBooks()
    {
        $sql = new Sql();
        $books  = $sql->select("SELECT * FROM books AND status_book > 0"); 

        return $books;
    }

}