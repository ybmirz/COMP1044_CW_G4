<?php
use \bookSwap\Book;
session_start();

echo '<script>';
if (!empty($_SESSION["alert"])) {
	echo 'alert("' . $_SESSION["alert"] . '");';
	unset($_SESSION["alert"]);
	echo 'window.location.href = "../dashboard.php";';
} else if (!isset($_SESSION["login_success"]) || empty($_SESSION["username"])) {
	echo 'alert("No login detected. Please login first.");';
	echo 'window.location.href = "../dashboard.php";';
} else {
	// If there is an invalid login (when login success gives back false)
	if (!$_SESSION["login_success"]) {
		echo 'alert("' . $_SESSION["message"] . '");';
		unset($_SESSION["login_success"]);
		unset($_SESSION["message"]);
		echo 'window.location.href = "../dashboard.php";';
	} 
}
echo '</script>';

if (!isset($_GET["book_info_id"])) {
    header('Location: ../dashboard.php');   
    exit();
}

$book_info_id = $_GET["book_info_id"];
// gets the book information
require_once ('./classes/Book.php');
$bookDs = new Book();
$book = $bookDs->getBookInfoById($book_info_id);
if (!$book){
    echo '<script>';
    echo 'alert("Book Information under ID #'.$book_info_id.' was not found. Please check again.");';
	echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
}

//get publisher and get category
$publisher = $bookDs->getPublisherbyId($book["publisher_fk"]);
$category = $bookDs->getCategory($book["category_fk"]);

// get number of copies for this book
$copies = $bookDs->getCopiesByInfoId($book_info_id);

include '../html/book_information.html';

// display
echo '<script>';
echo 'document.getElementById("bookTitle").innerHTML = "' . $book["title"] . '";';
echo 'document.getElementById("category").value = "' . $category["name"] . '";';
echo 'document.getElementById("author").value = "' . $book["authors"] . '";';
echo 'document.getElementById("publisher").innerHTML = "' . $publisher["name"] . ', ' . $publisher["hq_address"] . '";';
echo 'document.getElementById("year").value = "' . $book["copyright_year"] . '";';
echo 'document.getElementById("isbn").value = "' . $book["isbn_13"] . '";';
echo 'document.getElementById("copies").value = "' .$copies . '";';
echo '</script>';