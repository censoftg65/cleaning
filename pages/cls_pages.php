<?php
/**
* 
*/
class Pages
{
    
    function __construct(){
        # code...
    }

    public function getWelcomeDetails(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."pages";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getPageContent(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."pages";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getContactDetails(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."contact_details";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }
}

$objPage = new Pages();

?>