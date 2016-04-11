<?php
/**
* 
*/
class Menus
{
    
    function __construct(){
        # code...
    }

    public function getMenuDetails($mode,$param){
        $db = new Config();
        if ($mode == "all") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."menus ORDER BY txtId ASC";
        } elseif ($mode == "edit") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."menus WHERE txtId = $param";
        }
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getMenuParents(){
        $db = new Config();
        $sql_query = "SELECT txtId,txtParentId,txtMenu FROM "._DB_PREFIX."menus WHERE txtParentId = 0";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getParentId($param){
        $db = new Config();
        $sql_query = "SELECT txtParentId FROM "._DB_PREFIX."menus WHERE txtParentId = '$param'";
        $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

}

$objPage = new Menus();

?>