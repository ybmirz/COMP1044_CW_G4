<?php

use \bookSwap\Book;

session_start();
// Alert for invalid credentials
// Alert for a session message trying to connect to dashboard
echo '<script>';
if (!empty($_SESSION["alert"])) {
    echo 'alert("' . $_SESSION["alert"] . '");';
    unset($_SESSION["alert"]);
    echo 'window.location.href = "../index.html";';
} else if (!isset($_SESSION["login_success"])) {
    echo 'alert("No login detected. Please login first.");';
    echo 'window.location.href = "../html/Login.html";';
} else {
    // If there is an invalid login (when login success gives back false)
    if (!$_SESSION["login_success"]) {
        echo 'alert("' . $_SESSION["message"] . '");';
        unset($_SESSION["login_success"]);
        unset($_SESSION["message"]);
        echo 'window.location.href = "../html/Login.html";';
    }
}
echo '</script>';

// if a post method was called
if (isset($_POST["bookAddition"])) {
    // To add a book into the table, we'd need to check for the publisher said or not, 
    // then add the information

    // parse info
    $title = filter_var($_POST["booktitle"], FILTER_SANITIZE_STRING);
    $category = filter_var($_POST["category"], FILTER_VALIDATE_INT);
    $author = filter_var($_POST["author"], FILTER_SANITIZE_STRING);
    $publisher = explode(",", filter_var($_POST["publisher"], FILTER_SANITIZE_STRING), 2);
    $publisherName = $publisher[0];
    $publisherAddress = $publisher[1];
    $ISBN = filter_var($_POST["ISBN"], FILTER_VALIDATE_INT);
    $year = filter_var($_POST["copyrightyear"], FILTER_VALIDATE_INT);
    $status;
    switch ($_POST["status"]) {
        case 's1':
            $status = 'New';
            break;
        case 's2':
            $status = 'Old';
            break;
        case  's3':
            $status = 'Damaged';
            break;
    }

    // in the case any of the server side validation is false
    if (!($title && $category && $author && $publisherName && $publisherAddress && $ISBN && $year && $status)) {
        echo '<script>';
        echo 'alert("Server side validation failed. Please check information again.");';
        echo 'window.location.href = "add_book.php";';
        echo '</script>';
    }

    require_once('./classes/Book.php');
    $bookDs = new Book();
    $publisherData = $bookDs->getPublisherbyName($publisherName);
    if (!$publisherData) { // if no prev publisher info,, add publisher
        $bookDs->addPublisher($publisherName, $publisherAddress);
        $publisherData = $bookDs->getPublisherbyName($publisherName);
    }

    // Add the book information
    $bookDs->addBook($title, $category, $publisherData["id_pk"], $author, $ISBN, $year);
    // get book data after adding for the new id
    $addedBook = $bookDs->getBookInfoByTitle($title);
    if (!$addedBook) { // false; error adding
        echo '<script>';
        echo 'alert("Book addition error. Something went wrong.");';
        echo 'window.location.href = "add_book.php";';
        echo '</script>';
    }

    // Register book under the user's information
    $result = $bookDs->registerBook($addedBook["id_pk"], $_SESSION["username"], $status);
    if (!$result) { // false; error registering
        echo '<script>';
        echo 'alert("Book registration error. Something went wrong.");';
        echo 'window.location.href = "add_book.php";';
        echo '</script>';
    }

    echo '<script>';
    echo 'alert("Book adding and registration successful! Redirecting back to library...");';
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
}

// else just load the html
include '../html/add_book.html';
