<?php
session_start();

use \bookSwap\User;

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

// if there's no GET for the php script, then load dashboard_users.php
if (!isset($_GET["username"])) {
    include './dashboard_users.php';
    exit();
} // else it will edit the users per page

// Getting member info
require_once('./classes/User.php');
$owa = $_GET["username"];
$user = new User();
$memberInfo = $user->getMemberByOWA($owa);

if (empty($memberInfo)) {
    include '../html/user_not_found.html';
    exit();
} else
    $memberInfo = $memberInfo[0];

include "../html/manage_user.html";
echo '<script>';
echo 'document.getElementById("firstName").value = "' . $memberInfo["firstname"] . '";';
echo 'document.getElementById("lastName").value = "' . $memberInfo["lastname"] . '";';
echo 'document.getElementById("' . (($memberInfo["gender"] == 'F') ? "female" : "male") . '").checked = true;';
echo 'document.getElementById("address").value = "' . $memberInfo["city"] . '";';
echo 'document.getElementById("contact").value = "' . $memberInfo["contactnumber"] . '";';
echo 'document.getElementById("type").selectedIndex = ' . (($memberInfo["type_fk"] == '22') ? 0 : 1) . ';';
if ($memberInfo["type_fk"] == '22') {
    $year;
    switch ($memberInfo["year_level"]) {
        case 'First Year':
            $year = 0;
            break;
        case 'Second Year':
            $year = 1;
            break;
        case 'Third Year':
            $year = 2;
            break;
        case 'Fourth Year':
            $year = 3;
            break;
    }
    echo 'document.getElementById("year").disabled = false;';
    echo 'document.getElementById("year").selectedIndex = ' . $year . ';';
} else
    echo 'document.getElementById("year").disabled = true';
echo '</script>';
