<?php
set_include_path(dirname(__FILE__));
use \bookSwap\Book;

session_start();
// Logout clicked and wanting to log out
if (isset($_GET['logout'])) {
	session_destroy();
	header("location: ./html/Login.html");
} // if there is no logout get, success 

// Alert for invalid credentials
// Alert for a session message trying to connect to dashboard
echo '<script>';
if (!empty($_SESSION["alert"])) {
	echo 'alert("' . $_SESSION["alert"] . '");';
	unset($_SESSION["alert"]);
	echo 'window.location.href = "./index.html";';
} else if (!isset($_SESSION["login_success"])) {
	echo 'alert("No login detected. Please login first.");';
	echo 'window.location.href = "./html/Login.html";';
} else {
	// If there is an invalid login (when login success gives back false)
	if (!$_SESSION["login_success"]) {
		echo 'alert("' . $_SESSION["message"] . '");';
		unset($_SESSION["login_success"]);
		unset($_SESSION["message"]);
		echo 'window.location.href = "./html/Login.html";';
	} else { // When login sucess is true
		echo 'alert("Welcome back, ' . $_SESSION["username"] . '!");';
	}
}
echo '</script>';

// getting all books in the library
require_once(dirname(__FILE__) .'/php/classes/Book.php');
$bookDs = new Book();
$books = $bookDs->getAllBooks();
?>
<!DOCTYPE html>
<html>

<head>
	<title>BookSwap Semenyih Dashboard</title>
	<link rel="icon" href="./img/logo.png" />
	<link rel="stylesheet" href="./css/Dashboard.css" media="screen and (min-width: 900px)">
	<link rel="stylesheet" href="./css/Dashboard3Mobile.css" media="screen and (max-width: 900px)">
</head>

<body>
	<header>
		<nav class="nav">
			<div class="container">
				<div class="logo">
					<ul>
						<li><a href="index.html"><img src="./img/logo.png" alt="title" class="logostyle"></a></li>
					</ul>
				</div>
				<div id="mainListDiv" class="main_list">
					<ul class="navlinks">
						<li><a href="./php/add_book.php">Add Book</a></li>
						<li style="display: <?php /*When the user is an admin*/ echo $_SESSION["admin"] ? "block list-item;" : "none;" ?>">
							<a href="./php/manage_users.php">Manage Users</a>
						</li>
						<li><a href="dashboard.php?logout=1">Logout</a></li>
					</ul>
				</div>
				<a href="javascript:void(0);" class="icon" onclick="myFunction()">
					<i class="fa fa-bars"></i>
				</a>
			</div>
		</nav>
	</header>
	<script>
		function myFunction() {
			var x = document.getElementById("mainListDiv");
			if (x.style.display === "block") {
				x.style.display = "none";
			} else {
				x.style.display = "block";
			}
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
		$(window).scroll(function() {
			if ($(document).scrollTop() > 50) {
				$('.nav').addClass('affix');
				console.log("OK");
			} else {
				$('.nav').removeClass('affix');
			}
		});

		<?php

		?>
	</script>

	<div class="border">
		<h1 class="subheader"> Good Morning<?php echo (isset($_SESSION["firstName"])) ? ", " . $_SESSION["firstName"] : ""; ?>! </h1>
		<br><br><br><br>
		<div class="whiteborder">
			<br>
			<h2 class="wtl"> My books </h2>
			<?php
			$none = True;
			foreach ($books as $book) {
				if ($book["owner_owa_fk"] == $_SESSION["username"]) {
					// getting book information
					$book_info = $bookDs->getBookInfoById($book["book_information_id_fk"]);

					$status = array("New" => "", "Damaged" => "", "Old" => "");
					$available = array("Available" => "", "Lost" => "", "Archived" => "");

					$status[$book["status"]] = 'selected';
					$available[$book["availability"]] = 'selected';

					$div = <<<html
						<div class="cyanborder"">
					<a class="nostyle" href="./php/book_info.php?book_info_id={$book_info["id_pk"]}"><h2 class="ctl"> [ID:{$book["id_pk"]}] {$book_info["title"]} <span class="gray"> by {$book_info["authors"]}</span></h2></a>
					<div class="header2">
						<form action="./php/manage_book.php?book_id={$book["id_pk"]}" class="option" id="statusForm" method="post">
							<select name="status" id="status" class="option">
								<option value="s1"{$status["New"]}>New</option>
								<option value="s2"{$status["Damaged"]}>Damaged</option>
								<option value="s3"{$status["Old"]}>Old</option>
							</select>
							<select name="availability" id="availability" class="option">
								<option value="a1"{$available["Available"]}>Available</option>
								<option value="a2"{$available["Lost"]}>Lost</option>
								<option value="a3"{$available["Archived"]}>Archived</option>
							</select>
						</form>
						<div class="f2">
							<div class="fr">
								<ul>
									<div class="navlink">
										<li>
											<button type="submit" class="button4" form="statusForm">Update Book</button>
											<br>
											<a href="./php/php-action/delete_book.php?book_id={$book["id_pk"]}"><button type="button" class="button4">Delete Book</button></a>
										</li>
									</div>
								</ul>
							</div>
						</div>
					</div>
					<br><br>
				</div> 
				html;

					echo $div;
					$none = False;
				}
			}
			if ($none)
				echo '<h2 class="wtll" style="color:gray;">(None. <a href="./php/add_book.php" style="color:purple;"> Donate some books</a>  now)</h2>';
			?>

			<?php
			// getting currently borrowed; a book is under borrowing when there is
			// no subsequent return data
			$borrow = $bookDs->getAllBorrowed();
			$hasBorrow = False;
			foreach ($borrow as $borrowed_book) {
				if ($borrowed_book["borrower_owa_fk"] == $_SESSION["username"]) {
					$hasBorrow = True;
					break;
				}
			}
			if ($hasBorrow)
				echo '<h2 class="wtl"> Borrowed books </h2>';
			foreach ($borrow as $borrowed_book) {
				if ($borrowed_book["borrower_owa_fk"] == $_SESSION["username"]) {
					// get Book and book info
					$book = $bookDs->getBookById($borrowed_book["book_id_fk"]);
					$book_info = $bookDs->getBookInfoById($book["book_information_id_fk"]);

					$status = array("New" => "", "Damaged" => "", "Old" => "");
					$available = array("Available" => "", "Lost" => "", "Archived" => "");

					$status[$book["status"]] = 'selected';
					$available[$book["availability"]] = 'selected';

					$div = <<<html
						<div class="cyanborder">
						<a class="nostyle" href="./php/book_info.php?book_info_id={$book_info["id_pk"]}"><h2 class="ctl"> [ID:{$book["id_pk"]}] {$book_info["title"]} <span class="gray"> by {$book_info["authors"]}</span> [Due Date:{$borrowed_book["due_date"]}]</h2></a>
				<div class="header2">
					<div class="f2">
						<ul>
							<div class="navlink">
							<li>
								<form id="returnForm" action="./php/php-action/return_book.php?borrow_id={$borrowed_book["id_pk"]}" style="padding-right: 50px;" method="post">
									<select name="status" id="status">
									<option value="New"{$status["New"]}>New</option>
									<option value="Damaged"{$status["Damaged"]}>Damaged</option>
									<option value="Old"{$status["Old"]}>Old</option>
									</select>
								</form>
							</li>
							<li>
								<button type="submit" class="button4" form="returnForm">Return Book</button>
							</li>
							</div>
						</ul>
					</div><!--f2-->
				</div><!--header-->
				<br>
				</div> <!-- Cyanborder -->
				html;
					echo $div;
				}
			}

			echo '<h2 class="wtl">Library</h2>';

			// loop through every book and display ones that you do not own
			$noBooks = false;
			if (empty($books))
				$noBooks = true;
			if ($noBooks) {
				echo '<h2 class="wtll" style="color:gray;">(No Books in the Library. <a href="./php/add_book.php" style="color:purple;"> Donate some books</a> now)</h2><br><br>';
			} else
				echo '<iframe src="./php/library.php"></iframe><br>';
			?>

		</div> <!-- whiteborder -->
	</div> <!-- border -->
	<script>
	</script>
</body>

</html>