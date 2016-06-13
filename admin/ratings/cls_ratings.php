<?php
/**
* 
*/
class Rating
{
    
    function __construct(){
        # code...
    }

    public function getRatingDetails() {
        $db = new Config();
        $sql_query = $db->select("*");
        $sql_query .= $db->from(_DB_PREFIX."rating");
        $sql_query .= $db->orderby("txtId ");
        $sql_query .= $db->sortorder("DESC");
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getCommnets($param) {
        $db = new Config();
        $query = $db->select("txtRatingComment");
        $query .= $db->from(_DB_PREFIX."rating");
        $query .= $db->where("txtId = '$param'");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function deleteRatings($param) {
        $db = new Config();
        $query = "DELETE FROM "._DB_PREFIX."rating WHERE txtId = '$param'";
        $db->query($query);
    }

    public function clearRateNotty() {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."rating SET txtNotify = 0";
        $db->query($query);
    }
    
}

$objRating = new Rating();

?>