<?php
session_start();
// Logout clicked and wanting to log out
if (isset($_GET['logout'])) {
	session_destroy();
	header("location: ./html/Login.html");
}		// if there is no success at all
?>
<!DOCTYPE html>
<html>

<head>
	<title>BookSwap Semenyih Dashboard</title>
	<link rel="icon" href="./img/logo.png"/>
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
						<li><a href="">Add Book</a></li>
						<li style="display: <?php /*When the user is an admin*/ echo $_SESSION["admin"] ? "block;" : "none;"?>">
							<a href="./php/manage_users.php">Manage User</a>
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
		// Alert for invalid credentials
		<?php
		// Alert for a session message trying to connect to dashboard
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
				echo 'alert("Welcome back, '. $_SESSION["username"].'!");';
			}
		}
		?>
	</script>

	<div class="border">
		<h1 class="subheader"> Good Morning<?php echo (isset($_SESSION["firstName"])) ? ", " . $_SESSION["firstName"] : "";?>! </h1>
		<br><br><br><br>
		<div class="whiteborder">
			<h2 class="wtl"> My books </h2>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<form action="/action_page.php" class="option">
						<select name="" id="">
							<option value="">New</option>
							<option value="">?</option>
						</select>
					</form>
					<form action="/action_page.php" class="option">
						<select name="" id="">
							<option value="">Avaliable</option>
							<option value="">?</option>
						</select>
					</form>
					<div class="f2">
						<div class="fr">
							<ul>
								<div class="navlink">
									<li>
										<button type="button" class="button4">Update Book</button>
										<br>
										<button type="button" class="button4">Delete Book</button>
									</li>
								</div>
							</ul>
						</div>
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br><br>
			</div> <!-- Cyanborder -->

			<h2 class="wtl"> Borrowed books </h2>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="f2">
						<ul>
							<div class="navlink">
								<li>
									<form action="/action_page.php" style="padding-right: 50px;">
										<select name="" id="">
											<option value="">Damaged</option>
											<option value="">?</option>
										</select>
									</form>
								</li>
								<li>
									<button type="button" class="button4">Return Book</button>
								</li>
							</div>
						</ul>
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<h2 class="wtl"> Library </h2>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="lp">
						<button type="button" class="button1">Book</button>
					</div>
					<!--lp-->
					<div class="f2">
						<div class="navlink">
							<h2 class="cfr"> Status: New <span class="green"> Avaliable </span></h2>
						</div>
						<!--navlink-->
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<br>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="f2">
						<div class="navlink">
							<h2 class="cfr"> Status: New <span class="red"> Booked </span></h2>
						</div>
						<!--navlink-->
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<br>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="lp">
						<button type="button" class="button1">Book</button>
					</div>
					<!--lp-->
					<div class="f2">
						<div class="navlink">
							<h2 class="cfr"> Status: New <span class="green"> Avaliable </span></h2>
						</div>
						<!--navlink-->
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<br>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="lp">
						<button type="button" class="button1">Book</button>
					</div>
					<!--lp-->
					<div class="f2">
						<div class="navlink">
							<h2 class="cfr"> Status: New <span class="green"> Avaliable </span></h2>
						</div>
						<!--navlink-->
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<br>

			<div class="cyanborder">
				<h2 class="ctl"> Natural Resources <span class="gray"> by Robin Kerrod </span></h2>
				<div class="header2">
					<div class="lp">
						<button type="button" class="button1">Book</button>
					</div>
					<!--lp-->
					<div class="f2">
						<div class="navlink">
							<h2 class="cfr"> Status: New <span class="green"> Avaliable </span></h2>
						</div>
						<!--navlink-->
					</div>
					<!--f2-->
				</div>
				<!--header-->
				<br>
			</div> <!-- Cyanborder -->

			<br>

		</div> <!-- whiteborder -->
	</div> <!-- border -->

</body>

</html>