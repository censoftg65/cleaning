<?php
/**
* 
*/
class Pages
{
    
    function __construct() {
        # code...
    }

    public function setDetails($arr_page) {
        $this->pageEntity   = $arr_page['txtPageEntity'];
        $this->pageTitle    = $arr_page['txtPageTitle'];
        $this->pageUrl      = $arr_page['txtPageUrl'];
        $this->sliderContent= $arr_page['txtSliderContent'];
        $this->textContent  = $arr_page['txtTextContent'];
        $this->updateTime   = $arr_page['txtUpdateTime'];
        $this->status       = $arr_page['txtStatus'];

        $this->txtTitle         = $arr_page['txtTitle'];
        $this->txtContactDetails= $arr_page['txtContactDetails'];        
    }

    public function insertPage() {
        $db = new Config();
        $sql_query = "INSERT INTO "._DB_PREFIX."pages(
                                                        txtPageEntity,
                                                        txtPageTitle,
                                                        txtPageUrl,
                                                        txtSliderContent,
                                                        txtTextContent,
                                                        txtStatus
                                            ) VALUES(
                                                        '$this->pageEntity',
                                                        '$this->pageTitle',
                                                        '$this->pageUrl',
                                                        '$this->sliderContent',
                                                        '$this->textContent',
                                                        '$this->status'
                                                    )";
        $db->query($sql_query);
    }

    public function updatePage($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."pages SET txtPageTitle    = '$this->pageTitle',
                                                     txtSliderContent= '$this->sliderContent',
                                                     txtTextContent  = '$this->textContent'
                                               WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function updateContactDetails($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."contact_details SET txtTitle         = '$this->txtTitle',
                                                               txtContactDetails= '$this->txtContactDetails'
                                                         WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function getPageDetails($mode,$param){
        $db = new Config();
        if ($mode == "all") {
            $sql_query = "SELECT * FROM "._DB_PREFIX."pages WHERE txtStatus = '1' ORDER BY txtId DESC";
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

    public function deletePage($param) {
        $db = new Config();
        $date_time = getCurrentDateTime("all");
        $sql_query = "UPDATE "._DB_PREFIX."pages SET txtStatus = '0',txtUpdateTime = '$date_time' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function getContactDetails($param){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."contact_details WHERE txtId = $param";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }
    
    public function getTrashPagesDetails(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."pages WHERE txtStatus = '0' ORDER BY txtId DESC";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function deletePagePermanent($param) {
        $db = new Config();
        $sql_query = "DELETE FROM "._DB_PREFIX."pages WHERE txtId = '$param'";
        $db->query($sql_query);
    }

}

$objPage = new Pages();

?>