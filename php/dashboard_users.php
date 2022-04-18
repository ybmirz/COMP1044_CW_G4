<html>
<head>
	<title>Manage Users - Admin</title>
	<link rel="icon" href="../img/logo.png" />
	<link rel="stylesheet" href="../css/Dashboard.css" media="screen and (min-width: 900px)">
	<link rel="stylesheet" href="../css/DashboardMobile.css" media="screen and (max-width: 900px)">
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
</head>
<body>

<header>
        <nav class="nav">
            <div class="container">
                <div class="logo">
                    <ul>
                        <li><a href="../index.html"><img src="../img/logo.png" alt="title" class="logostyle"></a></li>
                        <li class="title"><a href="../index.html">BookSwap</a></li>
                    </ul>
                </div>
                <div id="mainListDiv" class="main_list">
                    <ul class="navlinks">
                        <li><a href="">Add User</a></li>
                        <li><a href="../dashboard.php?logout=1">Logout</a></li>
                    </ul>
                </div>
				<a href="javascript:void(0);" class="icon" onclick="myFunction()">
					<i class="fa fa-bars"></i>
				</a>
            </div>
        </nav>
</header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(window).scroll(function () {
            if ($(document).scrollTop() > 50) {
                $('.nav').addClass('affix');
                console.log("OK");
            } else {
                $('.nav').removeClass('affix');
            }
        });
		function myFunction() {
			var x = document.getElementById("mainListDiv");
			if (x.style.display === "block") {
			x.style.display = "none";
			} else {
			x.style.display = "block";
			}
		}
	</script>

	<div class="border">
	<h1 class="subheader"> Good Morning<?php echo (isset($_SESSION["firstName"])) ? ", " . $_SESSION["firstName"] : "";?>! </h1>
		<br><br><br><br>
		<div class="whiteborder">
			<div class="header2">
			<br>
			<h3 class="ctl"> Manage Users </h3>
				<div class="f2">
					<ul class="navlink">
						<li>
							<form class="example" action="manage_users.php" style="margin:auto;max-width:200px" method="get">
								<input type="text" placeholder="Enter OWA" name="username">
								<button type='submit'>
									<i class="fa fa-search"></i>
								</button>
							</form>
						</li>
					</ul>
				</div>
			</div><!--header-->
			<br><br><br>
		
			<div class="cyanborder" style="height:150px;">
			<br><br>
				<div class="header3">
				<h2> Soh Kar Seng </h2>
					<div class="f2">
						<div class="fr">
							<ul>
								<div class="navlink">
									<li><button type="button" class="button1">Delete</button>
										<button type="button" class="button2">Ban</button>
									<br>
										<button type="button" class="button3">Manage User Details</button>
									</li>
								</div>
							</ul>
						</div>
					</div>
				</div><!--header-->
			<br>
			</div> <!-- Cyanborder -->
			
			<br>
			
			<div class="cyanborder" style="height:150px;">
			<br><br>
				<div class="header3">
				<h2> Soh Kar Seng </h2>
					<div class="f2">
						<div class="fr">
							<ul>
								<div class="navlink">
									<li><button type="button" class="button1">Delete</button>
										<button type="button" class="button2">Ban</button>
									<br>
										<button type="button" class="button3">Manage User Details</button>
									</li>
								</div>
							</ul>
						</div>
					</div>
					<br>
				</div><!--header-->
				<br>
			</div> <!-- Cyanborder -->
			
			<br>
			
			<div class="cyanborder" style="height:150px;">
			<br><br>
				<div class="header3">
				<h2> Soh Kar Seng </h2>
					<div class="f2">
						<div class="fr">
							<ul>
								<div class="navlink">
									<li><button type="button" class="button1">Delete</button>
									<button type="button" class="button2">Ban</button>
									<br>
									<button type="button" class="button3">Manage User Details</button>
									</li>
								</div>
							</ul>
						</div>
					</div>
				</div><!--header-->
			</div> <!-- Cyanborder -->
			
			<br>
			
			<div class="cyanborder" style="height:150px;">
			<br><br>
				<div class="header3">
				<h2> Soh Kar Seng </h2>
					<div class="f2">
						<div class="fr">
							<ul>
								<div class="navlink">
									<li><button type="button" class="button1">Delete</button>
										<button type="button" class="button2">Ban</button>
									<br>
										<button type="button" class="button3">Manage User Details</button>
									</li>
								</div>
							</ul>
						</div>
					</div>
				</div><!--header-->
			</div> <!-- Cyanborder -->
			
			<br>
			
		</div> <!-- whiteborder -->
	</div> <!-- border -->


</body>
</html>