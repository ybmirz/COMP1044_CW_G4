<?php
namespace bookSwap;
set_include_path(dirname(__DIR__));
use \bookSwap\User;

session_start();

// Code to check for a login session and an admin session, if none return to dashboard.
if (!empty($_SESSION["alert"])) {
    echo '<script>';
    echo 'alert("' . $_SESSION["alert"] . '");';
    unset($_SESSION["alert"]);
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
} else if (!isset($_SESSION["login_success"]) || !$_SESSION["admin"]) { // not admin session
    echo '<script>';
    echo 'alert("No admin login detected. Please login as an admin.");';
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
}

// if there's no get var
if (empty($_GET["username"])) {
    echo '<script>';
    echo 'alert("No username detected. Please check again.");';
    echo 'window.location.href = "../dashboard.php";';
    echo '</script>';
    exit();
}

require_once (dirname(__DIR__).'/classes/User.php');
$user = new User();
$success = $user->banMember($_GET["username"]);

if ($success) { // succesful
    $_SESSION["message"] = "User has succesfully been banned!";
} else { // unsuccessful edit
    $_SESSION["message"] = "Oops! Unsuccessful Update; Something went wrong.";
}
header ('Location: ../manage_users.php');
exit();