<?php
use \bookSwap\Book;
session_start();

echo '<script>';
/*
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
*/
echo '</script>';

// opening the page without form
if (!isset($_POST["updateBookInfo"])) {
    echo '<script>';
    echo 'alert("No Form detected, please submit with form.");';
	echo 'window.location.href = "../../dashboard.php";';
    echo '</script>';
}

// code to update info is similar to adding a new book 
// just without touching the book table, just the book information
$owa = $_SESSION["username"];
$book_id = $_POST["book_id"];
$book_info_id = filter_var($_POST["book_info_id"], FILTER_VALIDATE_INT);
$title = filter_var($_POST["booktitle"], FILTER_SANITIZE_STRING);
$category = filter_var($_POST["category"], FILTER_VALIDATE_INT);
$author = filter_var($_POST["author"], FILTER_SANITIZE_STRING);
$publisher = explode(",", filter_var($_POST["publisher"], FILTER_SANITIZE_STRING), 2);
$publisherName = $publisher[0];
$publisherAddress = $publisher[1];
$ISBN = filter_var($_POST["ISBN"], FILTER_VALIDATE_INT);
$year = filter_var($_POST["copyrightyear"], FILTER_VALIDATE_INT);
$available;
switch ($_POST["status"]) {
    case 's1':
        $available = 'Available';
        break;
    case 's2':
        $available = 'Lost';
        break;
    case 's3':
        $available = 'Archived';
        break;
}

require_once ('../classes/Book.php');
$bookDs = new Book();

if (!($title && $category && $author && $publisherName && $publisherAddress && $ISBN && $year && $available)) {
    echo '<script>';
    echo 'alert("Server side validation failed. Please check information again.");';
    echo 'window.location.href = "manage_book.php?book_id='.$book_id.'";';
    echo '</script>';
}

// checks publisher information first
$publisherData = $bookDs->getPublisherbyName($publisherName);
if (!$publisherData) { // if no prev publisher info,, add publisher
    $bookDs->addPublisher($publisherName, $publisherAddress);
    $publisherData = $bookDs->getPublisherbyName($publisherName);
}


 // update information in book_information
$bookInfoResult = $bookDs->updateBookInformation($book_info_id, $title, $category, $author, $publisherData["id_pk"], $ISBN, $year);

// update availability in book table
$bookStatusUpdateResult = $bookDs->updateBookAvailabilty($book_id, $owa, $available);

// once done 
if (!($bookInfoResult && $bookStatusUpdateResult)) { // failed editing
    $_SESSION["message"] = 'Oops! Something went wrong when trying to update Book #' . $book_id;
} else
    $_SESSION["message"] = 'Book #'.$book_id.'has succesfully been edited.';

header ('Location: ../manage_book.php?book_id=' . $book_id);
exit();