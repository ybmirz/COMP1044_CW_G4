<?php
set_include_path(dirname(__FILE__));
use \bookSwap\Book;
session_start();

echo '<script>';
if (!empty($_SESSION["alert"])) {
	echo 'alert("' . $_SESSION["alert"] . '");';
	unset($_SESSION["alert"]);
	echo 'window.location.href = "../../dashboard.php";';
} else if (!isset($_SESSION["login_success"]) || empty($_SESSION["username"])) {
	echo 'alert("No login detected. Please login first.");';
	echo 'window.location.href = "../../dashboard.php";';
} else {
	// If there is an invalid login (when login success gives back false)
	if (!$_SESSION["login_success"]) {
		echo 'alert("' . $_SESSION["message"] . '");';
		unset($_SESSION["login_success"]);
		unset($_SESSION["message"]);
		echo 'window.location.href = "../../dashboard.php";';
	} 
}
echo '</script>';

// empty params
if (!isset($_GET["book_id"])) {
    header('Location: ../../dashboard.php');   
    exit();
}

require_once ('../classes/Book.php');
$bookDs = new Book();

// check if the book is already booked.
if ($bookDs->isBooked($_GET["book_id"])) {
    $borrowInfo = $bookDs->getBorrowInfoByBookId($_GET["book_id"]);
    echo '<script>';
    echo 'alert("Book ID:'.$_GET["book_id"].' has already been booked from '.$borrowInfo["borrow_date"].' until the due date: '.$borrowInfo["due_date"].'");';
	echo 'window.location.href = "../../dashboard.php";';
    echo '</script>';
}

// else
// borrowing simply adds a new record in borrow table
$success = $bookDs->borrowBook($_GET["book_id"], $_SESSION["username"]);
$borrow = $bookDs->getBorrowInfoByBookId($_GET["book_id"]);
if ($success) { // succesful
    echo '<script>';
    echo 'alert("Book borrowing successful. Under Borrowing Id: '.$borrow["id_pk"].' to be due on the '.$borrow["due_date"].'");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
} else { // unsuccessful edit
    echo '<script>';
    echo 'alert("Book Borrowing Unsuccessful. Something went wrong. Please try again.");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
}
exit();
