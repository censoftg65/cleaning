<?php
/**
* IMPORTANT SERVER VARIABLES INCLUDE HERE
*/
$server_name = $_SERVER['SERVER_NAME'];
$ip_address = $_SERVER['REMOTE_ADDR'];

/**
* IMPORTANT GLOBAL FUNCTIONS INCLUDE HERE 
*/
function getLogin($uname,$pword,$ulevel) {
    $db = new Config();
    $sql_login = "SELECT * FROM "._DB_PREFIX."user WHERE txtUsername = '$uname' AND txtPassword = '$pword' AND txtUserLevel = '$ulevel' AND txtStatus = '1'";
    $execute = $db->query($sql_login);
    $execute = $db->numRows();
    if ($execute != 0) {
        while ($row = $db->fetchAssoc($execute)) {
            $_SESSION['ad_logged']   = true;
            $_SESSION["txtId"]        = $row["txtId"];
            $_SESSION["txtEmail"]     = $row["txtEmail"];
            $_SESSION["txtUsername"]  = $row["txtUsername"];
            $_SESSION["txtUserLevel"] = $row["txtUserLevel"];
            $_SESSION["txtStatus"]    = $row["txtStatus"];
            $error = "";
        }
    } else {
        $error = "<span class='error'>Invalid Username Or Password..! <br>Please Try Again..!</span>";
    }
    return $error;
}
function getMenus() {
    $db = new Config();
    $sql_query = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 1 AND txtIsHidden = 1";
    $execute = $db->query($sql_query);
    $execute = $db->numRows();
    $collection = array();
    while ($row = $db->fetchAssoc($execute)) {
        array_push($collection, $row);
    }
    return $collection;
}
function displayName($tableName,$columnName,$id,$columnIdName) {
    $db = new Config();
    $sql_query = "SELECT $columnName FROM $tableName WHERE $columnIdName = '$id' ";
    $execute = $db->query($sql_query);
    while ($row = $db->fetchAssoc($execute)) {
        return $row[$columnName];
    }
}
function checkUser($username,$email) {
    $sql_chk = "SELECT * FROM tbl_user WHERE txtusername = '$username' OR txtEmail = '$email'";
    $mysql_query = mysql_query($sql_chk);
    return mysql_num_rows($mysql_query);
}
function checkEmail($email) {
    $sql_chk = "SELECT * FROM tbl_user WHERE txtEmail = '$email'";
    $mysql_query = mysql_query($sql_chk);
    return mysql_num_rows($mysql_query);
}
function getOptions($collection,$id,$name,$selected) {
    echo "<option value='0'>-- Select --</option>";
    foreach($collection as $object) {
        if($object[$id] == $selected) {
            $option = "selected";
        }else {
            $option = "";
        }
        echo "<option data-property='".$object[$id]."' value='".$object[$id]."' ".$option.">".$object[$name]."</option>";
    }
}
function registerUser($username,$password,$email) {
    $insertQuery = "INSERT INTO tbl_user(txtUsername,txtPassword,txtEmail,txtStatus)
                                  VALUES('$username','$password','$email','0')";
    mysql_query($insertQuery);
}
function forgotPassword($uid,$password) {
    $updateQuery = "UPDATE tbl_user SET txtPassword = '$password' WHERE txtid = '$uid'";
    mysql_query($updateQuery);
}
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function getCurrentDateTime($mode) {
    $timezone = new DateTimeZone("Asia/Kolkata");
    $date = new DateTime();
    $date->setTimezone($timezone );
    if($mode == "all") {
        return $date->format("Y-m-d H:i:s");
    }
    if($mode == "date") {
        return $date->format("Y-m-d");
    }
    if($mode == "india") {
        return $date->format("d-m-Y");
    }
    if($mode == "time") {
        return $date->format("g:i:s A");
    }
}
function validate_email($email) {
 if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
    return false;
 } else {    
    return true;
    }
}
function randomNumber($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}
function getCustId() {
    $sqlQuery = "SELECT txtId FROM tbl_clients ORDER BY txtId DESC";
    $mysql_query = mysql_query($sqlQuery);
    mysql_num_rows($mysql_query);
    while ($row = mysql_fetch_assoc($mysql_query)) {
        return "100".$row["txtId"];
    }
}


?>