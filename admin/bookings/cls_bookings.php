<?php
/**
* 
*/
class Booking
{
    
    function __construct(){
        # code...
    }

    public function getBookingDetails() {
        $db = new Config();
        $sql_query = $db->select("*");
        $sql_query .= $db->from(_DB_PREFIX."booking_profile");
        $sql_query .= $db->where("txtStatus = 1");
        $sql_query .= $db->orderby("txtId DESC");
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }
    
}

$objBooking = new Booking();

?>