<?php
/**
* 
*/
class Common
{
	
	function __construct() {
		# code...
	}

	public function setDetails($arr_profile) {
		$this->txtFirstName 	= $arr_profile['txtFirstName'];
		$this->txtLastName 		= $arr_profile['txtLastName'];
		$this->txtPhone 		= $arr_profile['txtPhone'];
		$this->txtAddressLine1 	= $arr_profile['txtAddressLine1'];
		$this->txtAddressLine2 	= $arr_profile['txtAddressLine2'];
		$this->txtCity 			= $arr_profile['txtCity'];
		$this->txtZipcode 		= $arr_profile['txtZipcode'];
	}

    public function setBooking($arr_book) {
        $this->txtOrderId           = $arr_book['txtOrderId'];
        $this->txtUserId            = $arr_book['txtUserId'];
        $this->txtBedroom           = $arr_book['txtBedroom'];
        $this->txtBathroom          = $arr_book['txtBathroom'];
        $this->txtExtraService      = $arr_book['txtExtraService'];
        $this->txtServiceDate       = $arr_book['txtServiceDate'];
        $this->txtServiceTime       = $arr_book['txtServiceTime'];
        $this->txtServiceHours      = $arr_book['txtServiceHours'];
        $this->txtExtraServiceHrs   = $arr_book['txtExtraServiceHrs'];
        $this->txtServiceTip        = $arr_book['txtServiceTip'];
        $this->txtBathroom          = $arr_book['txtBathroom'];
        $this->txtRecurring         = $arr_book['txtRecurring'];
        $this->txtPromoCode         = $arr_book['txtPromoCode'];
        $this->txtPromoOffer        = $arr_book['txtPromoOffer'];
        $this->txtServiceAmt        = $arr_book['txtServiceAmt'];
        $this->txtExtraServiceAmt   = $arr_book['txtExtraServiceAmt'];
        $this->txtTotalAmt          = $arr_book['txtTotalAmt'];
        $this->txtGrandTotal        = $arr_book['txtGrandTotal'];
    }

    public function insertBooking() {
        $db = new Config();
        $sql = "INSERT INTO "._DB_PREFIX."booking (
                                                        txtOrderId,
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
                                                        txtPromoCode,
                                                        txtPromoOffer,
                                                        txtServiceAmt,
                                                        txtExtraServiceAmt,
                                                        txtTotalAmt,
                                                        txtGrandTotal,
                                                        txtStatus
                                                   )
                                            VALUES (
                                                        '$this->txtOrderId',
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
                                                        '$this->txtPromoCode',
                                                        '$this->txtPromoOffer',
                                                        '$this->txtServiceAmt',
                                                        '$this->txtExtraServiceAmt',
                                                        '$this->txtTotalAmt',
                                                        '$this->txtGrandTotal',
                                                        '1'
                                                   )";
        $db->query($sql);                                           
    }

	public function getUserProfile($param) {
		$db = new Config();
		$query  = $db->select('*');
		$query .= $db->from(_DB_PREFIX.'user');
		$query .= $db->where('txtId = '."'$param'");
		$db->query($query);
		$collection = array();
		while($row = $db->fetchAssoc()) {
		    array_push($collection,$row);
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

    public function updateProfile($param) {
        $db = new Config();
        $data_time = getCurrentDateTime('all');
        $query  = "UPDATE "._DB_PREFIX."user SET txtFirstName    = '$this->txtFirstName',
        										 txtLastName     = '$this->txtLastName',
        										 txtPhone        = '$this->txtPhone',
        										 txtAddressLine1 = '$this->txtAddressLine1',
        										 txtAddressLine2 = '$this->txtAddressLine2',
        										 txtCity         = '$this->txtCity',
        										 txtZipcode      = '$this->txtZipcode',
        										 txtUpdateTime   = '$data_time'	
        								   WHERE txtId = '$param' ";
        $db->query($query);
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

    public function getPendingServices($uid) {
        $db = new Config();
        $query = "SELECT "._DB_PREFIX."booking.*,"._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName
                  FROM "._DB_PREFIX."booking
                  LEFT JOIN "._DB_PREFIX."user
                    ON "._DB_PREFIX."booking.txtUserId = "._DB_PREFIX."user.txtId  
                  WHERE "._DB_PREFIX."booking.txtUserId = '$uid' AND "._DB_PREFIX."booking.txtStatus = '1'";
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function getCompleteServices($uid) {
        $db = new Config();
        $query = "SELECT "._DB_PREFIX."booking.*,"._DB_PREFIX."rating.txtStatus AS rateStatus,"._DB_PREFIX."rating.txtId AS rateId,
                         "._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName
                  FROM "._DB_PREFIX."booking
                  LEFT JOIN "._DB_PREFIX."rating
                    ON "._DB_PREFIX."booking.txtId = "._DB_PREFIX."rating.txtBookingId
                  LEFT JOIN "._DB_PREFIX."user
                    ON "._DB_PREFIX."booking.txtUserId = "._DB_PREFIX."user.txtId  
                  WHERE "._DB_PREFIX."booking.txtUserId = '$uid' AND "._DB_PREFIX."booking.txtStatus = '0'";
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function getUser($param) {
        $db = new Config();
        $query = "SELECT "._DB_PREFIX."user.txtEmail FROM "._DB_PREFIX."booking
                                                     LEFT JOIN "._DB_PREFIX."user
                                                        ON "._DB_PREFIX."user.txtId = "._DB_PREFIX."booking.txtUserId
                                                     WHERE "._DB_PREFIX."booking.txtId = '$param'";
        $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc()){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function cancelServices($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."booking SET txtAction = 'cancel',txtStatus = '0' WHERE txtId = '$param'";
        $db->query($query);
    }

    public function getPendingPreviewServices($param) {
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

    public function setRating($arr_rating) {
        $this->txtUserId            = $arr_rating['txtUserId'];
        $this->txtBookingId         = $arr_rating['txtBookingId'];
        $this->txtServiceProvider   = $arr_rating['txtServiceProvider'];
        $this->txtRatingComment     = $arr_rating['txtRatingComment'];
        $this->txtRating            = $arr_rating['txtRating'];
        $this->txtPreRating         = $arr_rating['txtPreRating'];
    }

    public function insertRating() {
        $db = new Config();
        $sql = "INSERT INTO "._DB_PREFIX."rating( 
                                                   txtUserId,
                                                   txtBookingId,
                                                   txtServiceProvider,
                                                   txtRatingComment,
                                                   txtRating,
                                                   txtStatus
                                                )
                                         VALUES (
                                                   '$this->txtUserId',
                                                   '$this->txtBookingId', 
                                                   '$this->txtServiceProvider', 
                                                   '$this->txtRatingComment', 
                                                   '$this->txtRating', 
                                                   '1' 
                                                )";
        $db->query($sql);
    }

    public function updateRating($param) {
        $db = new Config();
        $sql = "UPDATE "._DB_PREFIX."rating SET txtServiceProvider = '$this->txtServiceProvider', 
                                                txtRatingComment   = '$this->txtRatingComment', 
                                                txtRating          = '$this->txtPreRating',
                                                txtNotify          = '2'
                                          WHERE txtId = '$param' ";
        $db->query($sql);
    }

    public function getServiceRat($param) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."rating");
        $query .= $db->where("txtId = '$param'");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function getAllRatings($uid) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."rating");
        $query .= $db->where("txtUserId = '$uid'");
        $result = $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc($result)){
            array_push($collection,$rows);
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

    public function getServiceData($param,$uid) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."booking");
        $query .= $db->where("txtId = '$param' AND txtUserId = '$uid'");
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

    public function getUpdateBooking($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."booking SET  txtBedroom         = '$this->txtBedroom',
                                                    txtBathroom        = '$this->txtBathroom',
                                                    txtExtraService    = '$this->txtExtraService',
                                                    txtServiceDate     = '$this->txtServiceDate',
                                                    txtServiceTime     = '$this->txtServiceTime',
                                                    txtServiceHours    = '$this->txtServiceHours',
                                                    txtExtraServiceHrs = '$this->txtExtraServiceHrs',
                                                    txtServiceTip      = '$this->txtServiceTip',
                                                    txtBathroom        = '$this->txtBathroom',
                                                    txtRecurring       = '$this->txtRecurring',
                                                    txtServiceAmt      = '$this->txtServiceAmt',
                                                    txtExtraServiceAmt = '$this->txtExtraServiceAmt',
                                                    txtTotalAmt        = '$this->txtTotalAmt',
                                                    txtGrandTotal      = '$this->txtGrandTotal',
                                                    txtNotify          = '2'
                                              WHERE txtId = '$param'";
        $db->query($query);
    }

    public function getDiscountOfferNotify($uid) {
        $db = new Config();
        $query = "SELECT txtId FROM "._DB_PREFIX."promo_offers WHERE txtOfferTaken = '$uid' AND txtUserNotify = 1  AND txtStatus = 1";
        $db->query($query);
        return $db->numRows();
    }

    public function getNotifications($uid) {
        $db = new Config();
        $query = "SELECT "._DB_PREFIX."user.txtFirstName,"._DB_PREFIX."user.txtLastName,
                 "._DB_PREFIX."promo_offers.txtPromoCode,"._DB_PREFIX."promo_offers.txtOffer,
                 "._DB_PREFIX."promo_offers.txtStatus
                 FROM "._DB_PREFIX."user
                 INNER JOIN "._DB_PREFIX."promo_offers
                    ON "._DB_PREFIX."promo_offers.txtOfferTaken = "._DB_PREFIX."user.txtId
                 WHERE "._DB_PREFIX."user.txtId = '$uid'
                 ORDER BY "._DB_PREFIX."promo_offers.txtId DESC";
        $db->query($query);
        $collection = array();
        while($rows = $db->fetchAssoc()){
            array_push($collection,$rows);
        }
        return $collection;
    }

    public function clearUserNotification($uid) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."promo_offers SET txtUserNotify = 0 WHERE txtOfferTaken = '$uid'";
        $db->query($query);
    }
	
}

$objCommon = new Common();

?>