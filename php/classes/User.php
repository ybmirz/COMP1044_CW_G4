<?php
namespace bookSwap;

set_include_path(dirname(__FILE__));
use \bookSwap\Datasource;
use mysqli;
use mysqli_sql_exception;

class User
{
    private $dbconn;
    private $ds;

    function __construct() {
        require_once dirname(__FILE__). "/Datasource.php";
        $this->ds = new Datasource();
    }

    function getCredsByOWA($memberOWA) {
        $query = "SELECT * FROM account WHERE owa_fk_pk = ?";
        $paramType = "s";
        $paramArray = array($memberOWA);
        $member_result = $this->ds->Select($query, $paramType, $paramArray);
        return $member_result;
    }

    function getMemberByOWA($memberOWA) {
        $query = "SELECT * FROM member WHERE owa_pk = ?";
        $paramType = "s";
        $paramArray = array($memberOWA);
        $member_result = $this->ds->Select($query, $paramType, $paramArray);
        return $member_result;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM member";
        $members = $this->ds->Select($query);
        return $members;
    }

    public function isAdmin($memberOWA) {
        $query = "SELECT COUNT(1) AS Count FROM admin WHERE owa_fk_pk = ?";
        $paramType = "s";
        $paramArray = array($memberOWA);
        $result = $this->ds->Select($query, $paramType, $paramArray);
        return (number_format($result[0]["Count"]) > 0) ? True : False;
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

    public function updateMember($owa, $firstName, $lastName, $address, $contactNo, 
    $gender, $accounttype, $year) {
        // Updating to the parent information in member requires temp deletion from account
        $accountInfo = $this->getCredsByOWA($owa)[0];
        // delete creds
        $deletion = $this->deleteCreds($owa);
        // update member info
        $updateQuery = "UPDATE `member` SET `firstname`=?,`lastname`=?,`gender`=?,`city`=?,`contactnumber`=?,`type_fk`=?,`year_level`=?,`status`='Active' WHERE `owa_pk` = ?";
        $paramType = "ssssssss";
        $paramArray = array($firstName,   $lastName, $gender, $address, $contactNo, $accounttype, $year, $owa);
        $updateResult = False;
        try {
            $updateResult = $this->ds->execute($updateQuery, $paramType, $paramArray);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $updateResult = False;
        }

        // reinsert account creds
        $registerQuery = "INSERT INTO `account` (`owa_fk_pk`, `SHA1_hashedpassword`) VALUES (?, ?)";
        $paramType = "ss";
        $paramArray = array($accountInfo["owa_fk_pk"], $accountInfo["SHA1_hashedpassword"]);
        $registerResult = False;
        try {
            $registerResult = $this->ds->execute($registerQuery, $paramType, $paramArray);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $registerResult = False;
        }

        return $deletion && $updateResult && $registerResult;
    }

    public function deleteCreds($owa) {
        $deleteQuery = "DELETE FROM account WHERE owa_fk_pk = ?";
        $paramType = "s";
        $paramArray = array($owa);
        $deleteResult = False;
        try
        { $deleteResult = $this->ds->execute($deleteQuery, $paramType, $paramArray); }
         catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $deleteResult = False;
        }
        return $deleteResult;
    }

    public function banMember($owa) {
        // When a user is banned, their credentials is deleted and their
        // member record exists with the status being banned. Hence a banned user cannot register under the same owa.
        $this->deleteCreds($owa);
        // update member info
        $updateQuery = "UPDATE `member` SET `status`='Banned' WHERE `owa_pk` = ?";
        $paramType = "s";
        $paramArray = array($owa);
        $updateResult = False;
        try {
            $updateResult = $this->ds->execute($updateQuery, $paramType, $paramArray);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $updateResult = False;
        }
        return $updateResult;
    }

    public function deleteMember($owa) {
        // When a user is unbanned, their member record that states banned is deleted, hence they are able to
        // register once more.

        // Deletion checks for the user's creds first, if found, will delete
        if (!empty($this->getCredsByOWA($owa)[0])) {
            $this->deleteCreds($owa);
        }

        $deletionQuery = "DELETE FROM `member` WHERE `owa_pk` = ?";
        $paramType = "s";
        $paramArray = array($owa);
        $deletionResult = False;
        try {
            $deletionResult = $this->ds->execute($deletionQuery, $paramType, $paramArray);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            $deletionResult = False;
        }
        return $deletionResult;
    }

    public function isBanned($owa) {
        $query = "SELECT status FROM member WHERE owa_pk = ?";
        $paramArray = array($owa);
        $paramType = "s";
        $result = $this->ds->Select($query, $paramType, $paramArray)[0];
        if ($result["status"] == 'Banned') 
            return True;
        else
            return False;
    }
}

?>