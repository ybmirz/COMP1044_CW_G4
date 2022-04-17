<?php
namespace bookSwap;

use \bookSwap\Datasource;
use mysqli;
use mysqli_sql_exception;

class User
{
    private $dbconn;
    private $ds;

    function __construct() {
        require_once "Datasource.php";
        $this->ds = new Datasource();
    }

    function getMemberByOWA($memberOWA) {
        $query = "SELECT * FROM member WHERE owa_pk = ?";
        $paramType = "s";
        $paramArray = array($memberOWA);
        $member_result = $this->ds->Select($query, $paramType, $paramArray);
        return $member_result;
    }

    public function processLogin($username, $password) {
        $passwordHash = sha1($password);
        $query = "SELECT * FROM account WHERE owa_fk_pk = ? AND SHA1_hashedpassword = ?";
        $paramType = "ss";
        $paramArray = array($username, $passwordHash);
        $member_result = $this->ds->Select($query, $paramType, $paramArray);
        if (!empty($member_result)) {
            $SESSION["user_owa"] = $member_result[0]["owa_fk_pk"];
            return true;
        }
    }

    public function processRegister($owa, $firstName, $lastName, 
    $password, $address, $contactNo, $gender, $accounttype, $year) {
        $passwordHash = sha1($password);
        // Adding into the member table
        $insertQuery = "INSERT INTO `member` (`owa_pk`, `firstname`, `lastname`, `gender`, `city`, `contactnumber`, `type_fk`, `year_level`, `status`) VALUES (?,?,?,?,?,?,?,?, 'Active')";
        $paramType = "ssssssss";
        $paramArray = array($owa, $firstName, $lastName, $gender, $address, $contactNo, $accounttype, $year);
        $insertResult = False;
        try {
            $insertResult = $this->ds->execute($insertQuery, $paramType, $paramArray);
        }
        catch (mysqli_sql_exception $e ) {
            echo $e->getMessage();
            $insertResult = False;
        }

        // Adding into the account table
        $registerQuery = "INSERT INTO `account` (`owa_fk_pk`, `SHA1_hashedpassword`) VALUES (?, ?)";
        $paramType = "ss";
        $paramArray = array($owa, $passwordHash);
        $registerResult = False;
        try {
            $registerResult = $this->ds->execute($registerQuery, $paramType, $paramArray);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $registerResult = False;
        }

        // return bool on operation success (insert to member and account has to be succesful)
        return $insertResult && $registerResult; 
    }
}

?>