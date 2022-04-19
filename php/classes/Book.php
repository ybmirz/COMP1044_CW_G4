<?php
namespace bookSwap;

use \bookSwap\Datasource;

class Book {
    private $ds;
    
    function __construct() {
        require_once "Datasource.php";
        $this->ds =  new Datasource();
    }

    public function addPublisher($name, $address) {
        // Adds a new publisher into the table
        $query = "INSERT INTO publisher (`id_pk`,`name`, `parentcompany`, `hq_address`) VALUES (NULL,?,?,?)";
        $paramType = "sss";
        $paramArray = array($name, $name, $address);
        $this->ds->execute($query, $paramType, $paramArray);
    }

    // First occuring name record in the table
    public function getPublisher($name) {
        $query = "SELECT * FROM publisher WHERE `name` = ?";
        $paramArray = array($name);
        $paramType = "s";
        $result = $this->ds->Select($query, $paramType, $paramArray);
        if (empty($result)) 
            return False;
        else
            return $result[0];
    }

    public function getBookByTitle($title) {
        $getQuery = "SELECT * FROM book_information WHERE title = ?";
        $paramArray = array($title);
        $paramType = "s";
        $result = $this->ds->Select($getQuery, $paramType, $paramArray);
        if (empty($result)) 
            return False;
        else
            return $result[0];
    }

    public function addBook($title, $category, $publisher, $authors, 
    $isbn, $copyright_year) {
        $query = "INSERT INTO `book_information` (`id_pk`, `title`, `category_fk`, `publisher_fk`, `authors`, `isbn_13`, `copyright_year`) VALUES (NULL, ?, ?, ?, ?, ?, ?) ";
        $paramType = "ssssss";
        $paramArray = array($title, $category, $publisher, $authors, $isbn, $copyright_year);
        return $this->ds->execute($query, $paramType, $paramArray);
    }

    public function registerBook ($book_id, $owa, $status) {
        date_default_timezone_set("UTC");

        $timestamp = date('Y-m-d H:i:s'); // get local date and time
        $query = "INSERT INTO `book` (`id_pk`, `owner_owa_fk`, `book_information_id_fk`, `date_added`, `status`, `availability`) VALUES (NULL, ?, ?, ?, ?, 'Available')";
        $paramType = "siss";
        $paramArray = array($owa, $book_id, $timestamp, $status);
        return $this->ds->execute($query, $paramType, $paramArray);
    }
}