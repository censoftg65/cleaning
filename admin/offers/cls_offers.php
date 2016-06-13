<?php
/**
* 
*/
class Offers
{
    
    function __construct() {
        # code...
    }

    public function setDetails($arr_offer) {
        $this->txtPromoCode  = $arr_offer['txtPromoCode'];
        $this->txtOffer      = $arr_offer['txtOffer'];
        $this->txtOfferTaken = $arr_offer['txtOfferTaken'];
    }

    public function createOffers() {
        $db = new Config();
        $sql_query = "INSERT INTO "._DB_PREFIX."promo_offers(
                                                                txtPromoCode,
                                                                txtOffer,
                                                                txtOfferTaken,
                                                                txtStatus
                                                    )VALUES(
                                                                '$this->txtPromoCode',
                                                                '$this->txtOffer',
                                                                '$this->txtOfferTaken',
                                                                '1'
                                                            )";
        $db->query($sql_query);
    }

    public function userOffer($param){
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."user SET txtOfferShare = '1' WHERE txtId = '$param'";
        $db->query($sql_query);
    }
        
    public function getOfferDetails(){
        $db = new Config();
        $sql_query = "SELECT "._DB_PREFIX."promo_offers.*,"._DB_PREFIX."user.txtEmail AS email,
                             "._DB_PREFIX."user.txtFirstName AS firstname,"._DB_PREFIX."user.txtLastName AS lastname
                      FROM "._DB_PREFIX."promo_offers
                      LEFT JOIN "._DB_PREFIX."user ON "._DB_PREFIX."user.txtId = "._DB_PREFIX."promo_offers.txtOfferTaken
                      ORDER BY "._DB_PREFIX."promo_offers.txtId DESC";
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
        $sql_query = "DELETE FROM "._DB_PREFIX."promo_offers WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function getOfferUser() {
        $db = new Config();
        $sql_query = $db->select('*');
        $sql_query .= $db->from(_DB_PREFIX.'user');
        $sql_query .= $db->where("txtStatus = '1' AND txtUserLevel != 'admin' AND txtOfferShare = 0");
        $db->query($sql_query);
        $collection = array();
        while ($row = $db->fetchAssoc()) {
            array_push($collection, $row);
        }
        return $collection;
    }

    public function clearOfferNotty() {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."promo_offers SET txtNotify = 0";
        $db->query($sql_query);
    }

}

$objOffers = new Offers();

?>