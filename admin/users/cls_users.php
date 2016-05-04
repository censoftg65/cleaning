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
        $this->addr2    = $arr_user['txtAddressLine2'];
        $this->country  = $arr_user['txtCountry'];
        $this->state    = $arr_user['txtState'];
        $this->city     = $arr_user['txtCity'];
        $this->zipcode  = $arr_user['txtZipcode'];
        $this->phone    = $arr_user['txtPhone'];
        $this->ulevel   = $arr_user['txtUserLevel'];
        $this->ipaddr   = $arr_user['txtIpAddress'];
        $this->status   = $arr_user['txtStatus'];
    }
    
    public function setOfferDetails($arr_user) {
        $this->promoCode  = $arr_user['txtPromoCode'];
        $this->offer      = $arr_user['txtOffer'];   
        $this->offerTaken = $arr_user['txtOfferTaken'];        
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
                                                        txtUserType,
                                                        txtStatus
                                            ) VALUES(
                                                        '$this->email',
                                                        '$this->uname',
                                                        '".base64_encode($this->pword )."',
                                                        '$this->fname',
                                                        '$this->lname',
                                                        '$this->addr1',
                                                        '$this->addr2',
                                                        '$this->country',
                                                        '$this->state',
                                                        '$this->city',
                                                        '$this->zipcode',
                                                        '$this->phone',
                                                        '$this->ulevel',
                                                        '$this->ipaddr',
                                                        'new',
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

    public function deactiveUser($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = '0',txtUpdateTime = '$date_time' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteUser($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        echo $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = 'delete',txtUpdateTime = '$date_time' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function activateUser($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = '1' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteUserPermanantly($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtStatus = 'delete' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteTrashUser($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "DELETE  FROM "._DB_PREFIX."user WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function offerUserTaken($param) {
        $db = new Config();
        $db->query("UPDATE "._DB_PREFIX."user SET txtOfferShare = 1 WHERE txtId = '$param'");
        $db->query("INSERT INTO "._DB_PREFIX."promo_offers(
                                                            txtPromoCode,
                                                            txtOffer,
                                                            txtOfferTaken,
                                                            txtStatus
                                                          )
                                                    VALUES(
                                                            '$this->promoCode',
                                                            '$this->offer',
                                                            '$this->offerTaken',
                                                            '1'
                                                          )");
    }

    public function getUserDetails() {
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtStatus = 1 ORDER BY txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getDeactiveUserDetails() {
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtStatus = '0' ORDER BY txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getTrashUserDetails() {
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."user WHERE txtStatus = 'delete' ORDER BY txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getCities() {
        $db = new Config();
        $query  = $db->select('txtCity');
        $query .= $db->from(_DB_PREFIX.'zipcity');
        $query .= $db->where('txtState = '."'NY'");
        $query .= $db->orderby('txtCity');
        $db->query($query);
        $collection = array();
        while($row = $db->fetchAssoc()) {
            array_push($collection,$row);
        }
        return $collection;
    }

    public function getZipCodes() {
        $db = new Config();
        $query  = $db->select('txtZip');
        $query .= $db->from(_DB_PREFIX.'zipcity');
        $query .= $db->where('txtState = '."'NY'");
        $db->query($query);
        $collection = array();
        while($row = $db->fetchAssoc()) {
            array_push($collection,$row);
        }
        return $collection;
    }

    public function getExactZipCode($param) {
        $db = new Config();
        $query  = $db->select('txtZip');
        $query .= $db->from(_DB_PREFIX.'zipcity');
        $query .= $db->where('txtCity = '."'$param' AND txtState = 'NY'");
        $db->query($query);
        $collection = array();
        while($row = $db->fetchAssoc()) {
            array_push($collection,$row);
        }
        return $collection;
    }

}

$objUser = new Users();

?>