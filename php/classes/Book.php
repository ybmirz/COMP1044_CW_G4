<?php
namespace bookSwap;
use \bookSwap\Datasource;

class Book
{
    private $ds;

    function __construct()
    {
        require_once "Datasource.php";
        $this->ds =  new Datasource();
    }

    public function getAllBookInformation()
    {
        // Gets all the book in the book_information list
        $query = "SELECT * FROM book_information";
        return $this->ds->Select($query);
    }

    public function getAllBooks()
    {
        $query = "SELECT * FROM book";
        return $this->ds->Select($query);
    }

    public function getCopiesByInfoId($book_info_Id)
    {
        $query = "SELECT Count(0) As Count FROM book WHERE book_information_id_fk = ?";
        $paramType = "i";
        $paramArray = array($book_info_Id);
        $count = $this->ds->Select($query, $paramType, $paramArray)[0];
        return $count["Count"];
    }

    public function getBookById($book_id)
    {
        $getQuery = "SELECT * FROM book WHERE id_pk = ?";
        $paramArray = array($book_id);
        $paramType = "s";
        $result = $this->ds->Select($getQuery, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }

    public function addPublisher($name, $address)
    {
        // Adds a new publisher into the table
        $query = "INSERT INTO publisher (`id_pk`,`name`, `parentcompany`, `hq_address`) VALUES (NULL,?,?,?)";
        $paramType = "sss";
        $paramArray = array($name, $name, $address);
        $this->ds->execute($query, $paramType, $paramArray);
    }

    // First occuring name record in the table publisher
    public function getPublisherbyName($name)
    {
        $query = "SELECT * FROM publisher WHERE `name` = ?";
        $paramArray = array($name);
        $paramType = "s";
        $result = $this->ds->Select($query, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }
    // Function for id publisher
    public function getPublisherById($publisher_id)
    {
        $query = "SELECT * FROM publisher WHERE `id_pk` = ?";
        $paramArray = array($publisher_id);
        $paramType = "s";
        $result = $this->ds->Select($query, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }

    // Book information getting functions
    public function getBookInfoById($book_id)
    {
        $getQuery = "SELECT * FROM book_information WHERE id_pk = ?";
        $paramArray = array($book_id);
        $paramType = "s";
        $result = $this->ds->Select($getQuery, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }

    public function getBookInfoByTitle($title)
    {
        $getQuery = "SELECT * FROM book_information WHERE title = ?";
        $paramArray = array($title);
        $paramType = "s";
        $result = $this->ds->Select($getQuery, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }

    public function addBook(
        $title,
        $category,
        $publisher,
        $authors,
        $isbn,
        $copyright_year
    ) {
        $query = "INSERT INTO `book_information` (`id_pk`, `title`, `category_fk`, `publisher_fk`, `authors`, `isbn_13`, `copyright_year`) VALUES (NULL, ?, ?, ?, ?, ?, ?) ";
        $paramType = "ssssss";
        $paramArray = array($title, $category, $publisher, $authors, $isbn, $copyright_year);
        return $this->ds->execute($query, $paramType, $paramArray);
    }

    public function registerBook($book_info_id, $owa, $status)
    {
        date_default_timezone_set("UTC");

        $timestamp = date('Y-m-d H:i:s'); // get local date and time
        $query = "INSERT INTO `book` (`id_pk`, `owner_owa_fk`, `book_information_id_fk`, `date_added`, `status`, `availability`) VALUES (NULL, ?, ?, ?, ?, 'Available')";
        $paramType = "siss";
        $paramArray = array($owa, $book_info_id, $timestamp, $status);
        return $this->ds->execute($query, $paramType, $paramArray);
    }

    // Function to check if the owa is associated with book id
    public function isBookOwner($book_id, $owa)
    {
        $checkQuery = "SELECT Count(0) as Count FROM `book` WHERE owner_owa_fk = ? AND book_information_id_fk = ?";
        $paramType = "ss";
        $paramArray = array($owa, $book_id);
        $count = $this->ds->execute($checkQuery, $paramType, $paramArray);
        if ($count["Count"] > 0)
            return True;
        else
            return False;
    }

    // directly updates a specific info id
    public function updateBookInformation(
        $book_info_id,
        $title,
        $category,
        $author,
        $publisher,
        $isbn,
        $copyright_year
    ) {
        $query = "UPDATE book_information SET `title` = ?, `category_fk` = ?, `publisher_fk` = ?, authors = ?, isbn_13 = ?, copyright_year = ? WHERE id_pk = ?";
        $paramType = "ssssssi";
        $paramArray = array($title, $category, $publisher, $author, $isbn, $copyright_year, $book_info_id);
        $success = $this->ds->execute($query,$paramType,$paramArray);
        return $success;
    }

    // deletes book ownership 
    public function deleteBook($book_id, $owa) {
        $query = "DELETE FROM book WHERE id_pk=? AND owner_owa_fk =?";
        $paramArray = array($book_id, $owa);
        $paramType = "is";
        $success = $this->ds->execute($query,$paramType,$paramArray);
        return $success;
    }

    // update availability in book table
    public function updateBookAvailabilty($book_id, $owa, $availability) {
        $query = "UPDATE book SET `availability` = ? WHERE id_pk = ? AND owner_owa_fk = ?";
        $paramArray = array($availability ,$book_id, $owa);
        $paramType = "sis";
        $success = $this->ds->execute($query,$paramType,$paramArray);
        return $success;
    }
}
