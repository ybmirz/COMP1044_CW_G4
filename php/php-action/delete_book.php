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

if (!isset($_GET["book_id"])) {
    header('Location: ../dashboard.php');   
    exit();
}

$book_id = $_GET["book_id"];
require_once ('../classes/Book.php');
$bookDs = new Book();
$success = $bookDs->deleteBook($book_id, $_SESSION["username"]);

if ($success) { // succesful
    echo '<script>';
    echo 'alert("Book deletion successful.");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
} else { // unsuccessful edit
    echo '<script>';
    echo 'alert("Book Deletion Unsuccessful. Something went wrong. Please try again.");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
}
exit();