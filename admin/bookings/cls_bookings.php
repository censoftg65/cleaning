<?php
/**
* 
*/
class Booking
{
    
    function __construct(){
        # code...
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
    
}

$objBooking = new Booking();

?>