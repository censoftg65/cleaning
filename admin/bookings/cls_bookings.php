<?php
/**
* 
*/
class Booking
{
    
    function __construct(){
        # code...
    }

    public function setCreateDetail($arr_create) {
        $this->txtUserId          = $arr_create['txtUserId'];
        $this->txtBedroom         = $arr_create['txtBedroom'];
        $this->txtBathroom        = $arr_create['txtBathroom'];
        $this->txtExtraService    = $arr_create['txtExtraService'];
        $this->txtServiceDate     = $arr_create['txtServiceDate'];
        $this->txtServiceTime     = $arr_create['txtServiceTime'];
        $this->txtServiceHours    = $arr_create['txtServiceHours'];
        $this->txtExtraServiceHrs = $arr_create['txtExtraServiceHrs'];
        $this->txtServiceTip      = $arr_create['txtServiceTip'];
        $this->txtRecurring       = $arr_create['txtRecurring'];
        $this->txtServiceAmt      = $arr_create['txtServiceAmt'];
        $this->txtExtraServiceAmt = $arr_create['txtExtraServiceAmt'];
        $this->txtTotalAmt        = $arr_create['txtTotalAmt'];
        $this->txtGrandTotal      = $arr_create['txtGrandTotal'];
    }

    public function setUpdateDetail($arr_update) {
        $this->txtBedroom         = $arr_update['txtBedroom'];
        $this->txtBathroom        = $arr_update['txtBathroom'];
        $this->txtExtraService    = $arr_update['txtExtraService'];
        $this->txtServiceDate     = $arr_update['txtServiceDate'];
        $this->txtServiceTime     = $arr_update['txtServiceTime'];
        $this->txtServiceHours    = $arr_update['txtServiceHours'];
        $this->txtExtraServiceHrs = $arr_update['txtExtraServiceHrs'];
        $this->txtServiceTip      = $arr_update['txtServiceTip'];
        $this->txtRecurring       = $arr_update['txtRecurring'];
        $this->txtServiceAmt      = $arr_update['txtServiceAmt'];
        $this->txtExtraServiceAmt = $arr_update['txtExtraServiceAmt'];
        $this->txtTotalAmt        = $arr_update['txtTotalAmt'];
        $this->txtGrandTotal      = $arr_update['txtGrandTotal'];       
    }

    public function getPendingBooking() {
        $db = new Config();
        $sql_query = "SELECT "._DB_PREFIX."booking.*,"._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName,
                             "._DB_PREFIX."rating.txtId AS rateId,"._DB_PREFIX."rating.txtStatus AS rateStatus
                      FROM "._DB_PREFIX."booking 
                      LEFT JOIN "._DB_PREFIX."user
                        ON "._DB_PREFIX."user.txtId = "._DB_PREFIX."booking.txtUserId
                      LEFT JOIN "._DB_PREFIX."rating
                        ON "._DB_PREFIX."rating.txtBookingId = "._DB_PREFIX."booking.txtId
                      WHERE "._DB_PREFIX."booking.txtStatus = '1'
                      ORDER BY "._DB_PREFIX."booking.txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getCompleteBooking() {
        $db = new Config();
        $sql_query = "SELECT "._DB_PREFIX."booking.*,"._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName,
                             "._DB_PREFIX."rating.txtId AS rateId,"._DB_PREFIX."rating.txtStatus AS rateStatus
                      FROM "._DB_PREFIX."booking 
                      LEFT JOIN "._DB_PREFIX."user
                        ON "._DB_PREFIX."user.txtId = "._DB_PREFIX."booking.txtUserId
                      LEFT JOIN "._DB_PREFIX."rating
                        ON "._DB_PREFIX."rating.txtBookingId = "._DB_PREFIX."booking.txtId
                      WHERE "._DB_PREFIX."booking.txtStatus = '0'
                      ORDER BY "._DB_PREFIX."booking.txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getTrashBookingDetails() {
        $db = new Config();
        $sql_query = "SELECT "._DB_PREFIX."booking.*,"._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName,
                             "._DB_PREFIX."rating.txtId AS rateId,"._DB_PREFIX."rating.txtStatus AS rateStatus
                      FROM "._DB_PREFIX."booking 
                      LEFT JOIN "._DB_PREFIX."user
                        ON "._DB_PREFIX."user.txtId = "._DB_PREFIX."booking.txtUserId
                      LEFT JOIN "._DB_PREFIX."rating
                        ON "._DB_PREFIX."rating.txtBookingId = "._DB_PREFIX."booking.txtId
                      WHERE "._DB_PREFIX."booking.txtStatus = 'delete'
                      ORDER BY "._DB_PREFIX."booking.txtId DESC";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getBookingPreview($param) {
        $db = new Config();
        $sql_query = $db->select("*");
        $sql_query .= $db->from(_DB_PREFIX."booking");
        $sql_query .= $db->where("txtId = "."'$param'");
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getBookRating($param) {
        $db = new Config();
        $sql_query = $db->select("*");
        $sql_query .= $db->from(_DB_PREFIX."rating");
        $sql_query .= $db->where("txtId = "."'$param'");
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function trashBooking($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."booking SET txtStatus = 'delete' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function trashRating($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."rating SET txtStatus = '0' WHERE txtBookingId = '$param'";
        $db->query($sql_query);
    }

    public function deleteBooking($param) {
        $db = new Config();
        $sql_query = "DELETE FROM "._DB_PREFIX."booking WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function deleteRating($param) {
        $db = new Config();
        $sql_query = "DELETE FROM "._DB_PREFIX."rating WHERE txtBookingId = '$param'";
        $db->query($sql_query);
    }

    public function clearNewBookNotty() {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."booking SET txtNotify = 0";
        $db->query($sql_query);
    }

    public function getExtraServices() {
        $db = new Config();
        $query = $db->select("txtId,txtServiceName,txtServicePrice,txtServiceHours");
        $query .= $db->from(_DB_PREFIX."extra_services");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function cancelServices($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."booking SET txtAction = 'cancel',txtStatus = '0' WHERE txtId = '$param'";
        $db->query($query);
    }

    public function completeServices($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."booking SET txtStatus = '0' WHERE txtId = '$param'";
        $db->query($query);
    }

    public function getServieUpdate($param) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."booking");
        $query .= $db->where("txtId = '$param'");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function getBathOnBed($param) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."booking_hrs_price");
        $query .= $db->where("txtBedRoom = '$param'");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function createBooking() {
        $db = new Config();
        $query = "INSERT INTO "._DB_PREFIX."booking(
                                                        txtUserId,
                                                        txtBedroom,
                                                        txtBathroom,
                                                        txtExtraService,
                                                        txtServiceDate,
                                                        txtServiceTime,
                                                        txtServiceHours,
                                                        txtExtraServiceHrs,
                                                        txtServiceTip,
                                                        txtRecurring,
                                                        txtServiceAmt,
                                                        txtExtraServiceAmt,
                                                        txtTotalAmt,
                                                        txtGrandTotal,
                                                        txtStatus
                                                    )
                                              VALUES(
                                                        '$this->txtUserId',
                                                        '$this->txtBedroom',
                                                        '$this->txtBathroom',
                                                        '$this->txtExtraService',
                                                        '$this->txtServiceDate',
                                                        '$this->txtServiceTime',
                                                        '$this->txtServiceHours',
                                                        '$this->txtExtraServiceHrs',
                                                        '$this->txtServiceTip',
                                                        '$this->txtRecurring',
                                                        '$this->txtServiceAmt',
                                                        '$this->txtExtraServiceAmt',
                                                        '$this->txtTotalAmt',
                                                        '$this->txtGrandTotal',
                                                        '1'
                                                    )";
        $result = $db->query($query);
    }

    public function updateBooking($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."booking SET  txtBedroom          = '$this->txtBedroom',
                                                    txtBathroom         = '$this->txtBathroom',
                                                    txtExtraService     = '$this->txtExtraService',
                                                    txtServiceDate      = '$this->txtServiceDate',
                                                    txtServiceTime      = '$this->txtServiceTime',
                                                    txtServiceHours     = '$this->txtServiceHours',
                                                    txtExtraServiceHrs  = '$this->txtExtraServiceHrs',
                                                    txtServiceTip       = '$this->txtServiceTip',
                                                    txtRecurring        = '$this->txtRecurring',
                                                    txtServiceAmt       = '$this->txtServiceAmt',
                                                    txtExtraServiceAmt  = '$this->txtExtraServiceAmt',
                                                    txtTotalAmt         = '$this->txtTotalAmt',
                                                    txtGrandTotal       = '$this->txtGrandTotal'
                                              WHERE txtId = '$param'";
        $result = $db->query($query);
    }

    public function getUserList() {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."user");
        $query .= $db->where("txtUserLevel != 'admin' AND txtStatus = 1");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;    
    }   
    
}

$objBooking = new Booking();

?>