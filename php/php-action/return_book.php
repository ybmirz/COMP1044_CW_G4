<?php
set_include_path(dirname(__DIR__));
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
if (!(isset($_GET["borrow_id"]) && isset($_POST["status"]))) {
    header('Location: ../../dashboard.php');   
    exit();
}

require_once (dirname(__DIR__).'/classes/Book.php');
$bookDs = new Book();

$borrowInfo = $bookDs->getBorrowInfoById($_GET["borrow_id"]);
$success = $bookDs->returnBook($_GET["borrow_id"]); 
$returnInfo = $bookDs->getReturnByBorrowId($_GET["borrow_id"]);


// updates the book status
$res = $bookDs->updateBookStatus($borrowInfo["book_id_fk"], $_POST["status"]);
// get late information
$return_date = strtotime($returnInfo["return_date"]);
$due_date = strtotime($borrowInfo["due_date"]);
$late = False;
$datediff;
if ($return_date > $due_date ){
    $late = True;
    $datediff = $return_date - $due_date;
} else {
    $late = False;
    $datediff = $due_date - $return_date;
}


if ($success && $res) { // succesful
    echo '<script>';
    echo 'alert("Book [Id:'.$borrowInfo["book_id_fk"].'] returning successful. You returned the book '.round($datediff / (24*60*60) ) .' days ' . ($late?'late':'early').' from the due date.");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
} else { // unsuccessful edit
    echo '<script>';
    echo 'alert("Book Returning Unsuccessful. Something went wrong. Please try again.");';
    echo 'window.location.href = "../../dashboard.php"';
    echo '</script>';
}
exit();
