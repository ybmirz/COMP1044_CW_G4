<?php

namespace bookSwap;
use \bookSwap\User;

if (isset($_POST["register"])) {
// Getting all the information from post and registers
$owa = filter_var($_POST["owa"], FILTER_SANITIZE_STRING);
$firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
$contact = filter_var($_POST["contact"], FILTER_SANITIZE_STRING);
// Getting account type and gender
$gender;
switch ($_POST["gender"]) {
    case "male":
        $gender = "M";
        break;
    case "female":
        $gender = "F";
        break;
}
$type;
$year;
switch ($_POST["account_type"]) {
    case "student": {
            $type = 22;
            switch ($_POST["year"]) {
                case "first":
                    $year = 'First Year';
                    break;
                case "second":
                    $year = 'Second Year';
                    break;
                case "third":
                    $year = 'Third Year';
                    break;
                case "fourth":
                    $year = "Fourth Year";
                    break;
            }
            break;
        }
    case "teacher":
        $type = 2;
        break;
}

// Registers
require_once("..\classes\User.php");
$user = new User();
$success = $user->processRegister(
    $owa,
    $firstname,
    $lastname,
    $password,
    $address,
    $contact,
    $gender,
    $type,
    $year
);

//echo $success ? "Success" : "Failuer";
session_start();
// Failure in registering the user
// This should set a session variable message that is alerted
// would be shown when trying to access dashboard.
/// Successful registering or not

if (!$success) {
    $_SESSION["alert"] = "User Registration Failed. The username might have already existed. Please check again.";
} else {
    // Logs the user in
    // Check if user logged in
    $_SESSION["username"] = $owa;
    $_SESSION["message"] = "You are now logged in!";
    $_SESSION["login_success"] = True;
}
header("Location: ../../dashboard.php");
exit();
}
    
?>