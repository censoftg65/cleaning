<?php
/**
* 
*/
class Users
{
    
    function __construct(){
        # code...
    }

    public function setDetails($arr_user) {
        $this->email    = $arr_user['txtEmail'];
        $this->uname    = $arr_user['txtUsername'];
        $this->pword    = $arr_user['txtPassword'];
        $this->fname    = $arr_user['txtFirstName'];
        $this->lname    = $arr_user['txtLastName'];
        $this->addr1    = $arr_user['txtAddressLine1'];
        $this->addr1    = $arr_user['txtAddressLine2'];
        $this->country  = $arr_user['txtCountry'];
        $this->state    = $arr_user['txtState'];
        $this->city     = $arr_user['txtCity'];
        $this->zipcode  = $arr_user['txtZipcode'];
        $this->phone    = $arr_user['txtPhone'];
        $this->ulevel   = $arr_user['txtUserLevel'];
        $this->ipaddr   = $arr_user['txtIpAddress'];
        $this->status   = $arr_user['txtStatus'];
    }

    public function insertUser() {
        $db = new Config();
        $sql_query = "INSERT INTO "._DB_PREFIX."user(
                                                        txtEmail,
                                                        txtUsername,
                                                        txtPassword,
                                                        txtFirstName,
                                                        txtLastName,
                                                        txtAddressLine1,
                                                        txtAddressLine2,
                                                        txtCountry,
                                                        txtState,
                                                        txtCity,
                                                        txtZipcode,
                                                        txtPhone,
                                                        txtUserLevel,
                                                        txtIpAddress,
                                                        txtStatus
                                            ) VALUES(
                                                        '$this->email',
                                                        '$this->uname',
                                                        '$this->pword',
                                                        '$this->fname',
                                                        '$this->lname',
                                                        '$this->addr1',
                                                        '$this->addr1',
                                                        '$this->country',
                                                        '$this->state',
                                                        '$this->city',
                                                        '$this->zipcode',
                                                        '$this->phone',
                                                        '$this->ulevel',
                                                        '$this->ipaddr',
                                                        '$this->status'
                                                    ) ";
        $db->query($sql_query);
    }

    public function updateUser($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtFirstName    = '$this->fname',
                                                    txtLastName     = '$this->lname',
                                                    txtAddressLine1 = '$this->addr1',
                                                    txtAddressLine2 = '$this->addr2',
                                                    txtCountry      = '$this->country',
                                                    txtState        = '$this->state',
                                                    txtCity         = '$this->city',
                                                    txtZipcode      = '$this->zipcode',
                                                    txtPhone        = '$this->phone',
                                                    txtUserLevel    = '$this->ulevel',
                                                    txtStatus       = '$this->status'
                                              WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteUser($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = '0',txtUpdateTime = '$date_time' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteUserPermanantly($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "DELETE FROM "._DB_PREFIX."user WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function changeUserStatus($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = '1' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function getUserDetails($mode,$param) {
        $db = new Config();
        if ($mode == "all") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtStatus = 1 ORDER BY txtId DESC";
        } elseif ($mode == "edit") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtId = $param";
        }
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getDeactiveUserDetails($mode,$param) {
        $db = new Config();
        if ($mode == "all") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtStatus = 0 ORDER BY txtId DESC";
        } elseif ($mode == "edit") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtId = $param";
        }
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

}

$objUser = new Users();

?>