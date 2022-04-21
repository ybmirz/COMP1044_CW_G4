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

    // returns number of copies 
    public function getCopiesByInfoId($book_info_Id)
    {
        $query = "SELECT Count(0) As Count FROM book WHERE book_information_id_fk = ?";
        $paramType = "i";
        $paramArray = array($book_info_Id);
        $count = $this->ds->Select($query, $paramType, $paramArray)[0];
        return $count["Count"];
    }

    // Book table
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

    // update record in book table
    public function updateBookRecord($book_id, $owa, $availability, $status) {
        $query = "UPDATE book SET `availability` = ?,`status`=? WHERE id_pk = ? AND owner_owa_fk = ?";
        $paramArray = array($availability, $status ,$book_id, $owa);
        $paramType = "ssis";
        $success = $this->ds->execute($query,$paramType,$paramArray);
        return $success;
    }

    // update book status
    public function updateBookStatus($book_id,$status){
        $query = "UPDATE book SET `status`= ? WHERE id_pk = ?";
        $paramArray = array($status ,$book_id);
        $paramType = "si";
        $success = $this->ds->execute($query,$paramType,$paramArray);
        return $success;
    }

    //----------------- Publisher -------------------

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

    
    // get category information
    public function getCategory($id) {
        $getQuery = "SELECT * FROM category WHERE id_pk = ?";
        $paramArray = array($id);
        $paramType = "s";
        $result = $this->ds->Select($getQuery, $paramType, $paramArray);
        if (empty($result))
            return False;
        else
            return $result[0];
    }

    // -------------- Borrowing Methods -------------
    // get alll current borrowing information that does not have a return
    public function getAllBorrowed() {
        $query = "SELECT B.id_pk, B.book_id_fk, B.borrower_owa_fk, B.due_date FROM borrow B 
        WHERE NOT EXISTS (SELECT * FROM returns R WHERE R.borrow_id_fk_pk = B.id_pk)";
        return $this->ds->Select($query);
    }

    public function isBooked($book_id) {
        // getting a specific borrowed book by its book id
        $currentBorrowed = $this->getAllBorrowed();
        $booked = False;
        foreach($currentBorrowed as $borrowed) {
            if ($borrowed["book_id_fk"] == $book_id) 
                $booked = True;
        }
        return $booked;
    }

    public function getBorrowInfoById ($borrow_id) {
        $query = "SELECT * FROM borrow WHERE id_pk=?";
        $paramType = "i";
        $paramArray = array($borrow_id);
        return $this->ds->Select($query, $paramType, $paramArray)[0];
    }

    // gets latest current borrow info by a book id
    public function getBorrowInfoByBookId ($borrow_id) {
        $query = "SELECT B.id_pk, B.book_id_fk, B.borrower_owa_fk, B.borrow_date, B.due_date FROM borrow B, returns R 
        WHERE B.id_pk != R.borrow_id_fk_pk AND B.book_id_fk=?
        ORDER BY B.borrow_date DESC;";
        $paramType = "i";
        $paramArray = array($borrow_id);
        return $this->ds->Select($query, $paramType, $paramArray)[0];
    }

    // get Returning information
    public function getReturnByBorrowId($borrow_id) {
        $query = "SELECT * FROM returns WHERE borrow_id_fk_pk=?";
        $paramType = "i";
        $paramArray = array($borrow_id);
        return $this->ds->Select($query, $paramType, $paramArray)[0];
    }
    
    // adds a borrow book record returns bool
    public function borrowBook($book_id, $owa) {
        date_default_timezone_set("UTC");
        $borrowDate =  date('Y-m-d H:i:s');
        $dueDate = date('Y-m-d H:i:s', strtotime($borrowDate. '+ 21 days'));

        $query = "INSERT INTO borrow (`id_pk`, `book_id_fk`, `borrower_owa_fk`, `borrow_date`, `due_date`) VALUES (NULL,?,?,?,?);";
        $paramArray = array($book_id, $owa, $borrowDate, $dueDate);
        $paramType = "isss";
        return $this->ds->execute($query,$paramType, $paramArray);
    }

    // adds a return record in returns and return operation bool
    public function returnBook($borrow_id) {
        date_default_timezone_set("UTC");
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO returns (`borrow_id_fk_pk`, `return_date`) VALUES (?,?)";
        $paramArray = array($borrow_id,$date);
        $paramType = "ss";
        return $this->ds->execute($query,$paramType, $paramArray);
    }
}
