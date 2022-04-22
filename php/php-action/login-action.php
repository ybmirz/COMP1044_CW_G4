<?php
namespace bookSwap;
set_include_path(dirname(__FILE__));
use \bookSwap\User;

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    session_start();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    require_once ("..\classes\User.php");

    $user = new User();
    // check if user is banned.
    if ($user->isBanned($username)) {
        $_SESSION["message"] = "Accounts under that username has been banned. Please contact admin if this is false.";
        $_SESSION["login_success"] = False;
        header("Location: ../../dashboard.php");
        exit();
    }

    unset($_POST["username"]);
    unset($_POST["password"]);
    // Check if user logged in
    $isLoggedIn = $user->processLogin($username, $password);
    if (!$isLoggedIn) {
        $_SESSION["message"] = "Invalid Credentials. Please check again.";
        $_SESSION["login_success"] = False;
        header("Location: ../../dashboard.php");
        exit();
    }
    $_SESSION["username"] = $username;
    $_SESSION["login_success"] = True;
    
    // Getting user's firstname
    $memberInfo = $user->getMemberByOWA($username)[0];
    $_SESSION["firstName"] = $memberInfo["firstname"];

    // Check if user is an admin
    $_SESSION["admin"] = $user->isAdmin($username);

    header("Location: ../../dashboard.php");
    exit();
}
?>