<?php
/**
* 
*/
class Pages
{
    
    function __construct(){
        # code...
    }

    public function getPageDetails($mode,$param){
        $db = new Config();
        if ($mode == "all") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."pages ORDER BY txtId ASC";
        } elseif ($mode == "edit") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."pages WHERE txtId = $param";
        }
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }
}


?>