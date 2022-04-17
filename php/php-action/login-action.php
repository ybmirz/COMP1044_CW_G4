<?php
namespace bookSwap;
use \bookSwap\User;

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    session_start();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    require_once ("..\classes\User.php");

    $user = new User();
    unset($_POST["username"]);
    unset($_POST["password"]);
    // Check if user logged in
    $isLoggedIn = $user->processLogin($username, $password);
    if (!$isLoggedIn) {
        $_SESSION["message"] = "Invalid Credentials. Please check again.";
        $_SESSION["login_success"] = False;
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["message"] = "You are now logged in!";
        $_SESSION["login_success"] = True;
    }
    header("Location: ../../dashboard.php");
    exit();
}
?>