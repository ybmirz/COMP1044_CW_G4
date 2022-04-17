<?php
// A php file that loads depending on what the GET query wants
// mainly used for login and signup htmls.
session_start();
// If a session already exists, send directly to dashboard
if (isset($_SESSION["login_success"])) {
    header("Location: ../dashboard.php");
} else {
    // What query is needed
    switch ($_GET['q']) {
        case 'login':
            header('Location: ../html/Login.html');
            break;
        case 'register':
            header('Location: ../html/Signup.html');
            break;
        default:
            header('Location ../index.html');
            break;
    }
}
