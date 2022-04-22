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

$owa = filter_var($_SESSION["user_owa"], FILTER_SANITIZE_STRING);
$firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
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
$year = 'Faculty';
switch ($_POST["type"]) {
    case "student": {
            $type = 22;
            switch ($_POST["year"]) {
                case "y1":
                    $year = 'First Year';
                    break;
                case "y2":
                    $year = 'Second Year';
                    break;
                case "y3":
                    $year = 'Third Year';
                    break;
                case "y4":
                    $year = "Fourth Year";
                    break;
            }
            break;
        }
    case "teacher":
        $type = 2;
        break;
}

require_once('/classes/User.php');
$user = new User();
$result = $user->updateMember(
    $owa,
    $firstname,
    $lastname,
    $address,
    $contact,
    $gender,
    $type,
    $year
);

unset($_SESSION["user_owa"]);

if ($result) { // succesful
    $_SESSION["message"] = "User information updated succesfully. Nice one!";
} else { // unsuccessful edit
    $_SESSION["message"] = "Oops! Unsuccessful Update; Something went wrong.";
}
header ('Location: ../manage_users.php?username=' . $owa);
exit();