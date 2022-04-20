<?php

use \bookSwap\Book;

session_start();
// Alert for invalid credentials
// Alert for a session message trying to connect to dashboard
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

// session message, such as succesful editing 
if (!empty($_SESSION["message"])) {
    echo '<script>';
    echo 'alert("' . $_SESSION["message"] . '");';
    unset($_SESSION["message"]);
    echo '</script>';
}

// get book information based off id
if (empty($_GET["book_id"])) {
    header('Location: ../dashboard.php');
}


require_once('./classes/Book.php');
$bookDs = new Book();
$owned_book = $bookDs->getBookById($_GET["book_id"]);
$book = $bookDs->getBookInfoById($owned_book["book_information_id_fk"]);
if (!$owned_book) { // false hence no book found under that id
    echo '<script>';
    echo 'alert("Book Id #' . $_GET["book_id"] . ' was not found in the database. Please check again.");';
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
}

// only the owner of the book is able to manage it.
if ($owned_book["owner_owa_fk"] != $_SESSION["username"]) {
    echo '<script>';
    echo 'alert("Book Information under Id #' . $_GET["book_id"] . ' is not associated with the account ' . $_SESSION["username"] . '. Please check again.");';
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
}



// all filters done, show book information
include '../html/manage_book.html';

// get Publisher info
$publisher = $bookDs->getPublisherById($book["publisher_fk"]);
if (!$publisher)
    die("Publisher of the Book not found. Please check with admin.");

$status = '';
$available = '';

if (empty($_POST["status"])) {
    switch ($owned_book["status"]) {
        case 'New':
            $status = 's1';
            break;
        case 'Damaged':
            $status = 's2';
            break;
        case 'Old':
            $status = 's3';
            break;
    }
} else
    $status = $_POST["status"];



if (empty($_POST["availability"])) {
    switch ($owned_book["availability"]) {
        case 'Available':
            $status = 's1';
            break;
        case 'Lost':
            $status = 's2';
            break;
        case 'Archived':
            $status = 's3';
            break;
    }
} else
    $available = $_POST["availability"];

echo '<script>';
echo 'document.getElementById("booktitle").value = "' . $book["title"] . '";';
echo 'document.getElementById("category").selectedIndex = ' . $book["category_fk"] - 1 . ';';
echo 'document.getElementById("author").value = "' . $book["authors"] . '";';
echo 'document.getElementById("publisher").innerHTML = "' . $publisher["name"] . ', ' . $publisher["hq_address"] . '";';
echo 'document.getElementById("year").value = "' . $book["copyright_year"] . '";';
echo 'document.getElementById("isbn").value = "' . $book["isbn_13"] . '";';
echo 'document.getElementById("' . $status . '").selected = true;';
echo 'document.getElementById("' . $available . '").selected = true;';
echo 'document.getElementById("book_id").value = "' . $_GET["book_id"] . '";';
echo 'document.getElementById("book_info_id").value = "' . $book["id_pk"] . '";';
echo 'document.getElementById("display_id").innerHTML = "' . $_GET["book_id"] . '";';
echo '</script>';
