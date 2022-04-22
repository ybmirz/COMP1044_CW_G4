<head>
	<title>BookSwap Semenyih Library</title>
	<link rel="icon" href="./img/logo.png" />
	<link rel="stylesheet" href="../css/Dashboard.css" media="screen and (min-width: 900px)">
	<link rel="stylesheet" href="../css/Dashboard3Mobile.css" media="screen and (max-width: 900px)">
    <base target="_parent">
</head>
<body>
    <div class="whiteborder">
        <br>
<?php
set_include_path(dirname(__FILE__));
use \bookSwap\Book;

session_start();
// getting all books in the library
require_once('/classes/Book.php');
$bookDs = new Book();
$books = $bookDs->getAllBooks();
$borrowed_books = $bookDs->getAllBorrowed();

foreach ($books as $book) {
    // if a book is lost, dont show in library
    if ($book["availability"] == 'Lost' || $book["availability"] == 'Archived')
        continue;

    // dont show book if it's being borrowed
    $borrowed=False;
    foreach($borrowed_books as $borrowed_book) {
        if ($borrowed_book["book_id_fk"] == $book["id_pk"]){
            $borrowed = True;
            break;
        }
    }
    if ($borrowed)
        continue;

    $book_info = $bookDs->getBookInfoById($book["book_information_id_fk"]);

    $div = <<<html
        <div class="cyanborder">
        <a class="nostyle" href="./book_info.php?book_info_id={$book_info["id_pk"]}"><h2 class="ctl"> [ID:{$book["id_pk"]}] {$book_info["title"]} <span class="gray"> by {$book_info["authors"]}</span></h2></a>
        <div class="header2">
            <div class="lp">
                <a href="./php-action/borrow_book.php?book_id={$book["id_pk"]}"><button type="button" class="button1">Book</button></a>
            </div>
            <!--lp-->
            <div class="f2">
                <div class="navlink">
                    <h2 class="cfr"> Status: {$book["status"]} <span class="green"> {$book["availability"]} </span></h2>
                </div>
                <!--navlink-->
            </div>
            <!--f2-->
        </div>
        <!--header-->
        <br>
    </div> <!-- Cyanborder -->
    <br>
    html;
    echo $div;
}

?>

</div>
</body>
