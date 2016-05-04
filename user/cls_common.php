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
        $this->txtTotal             = $arr_book['txtTotal'];
        $this->txtExtraServiceAmt   = $arr_book['txtExtraServiceAmt'];
        $this->txtGrandTotal        = $arr_book['txtGrandTotal'];
    }

    public function insertBooking() {
        $db = new Config();
        $sql = "INSERT INTO "._DB_PREFIX."booking (
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
                                                        txtTotal,
                                                        txtExtraServiceAmt,
                                                        txtGrandTotal,
                                                        txtStatus
                                                   )
                                            VALUES (
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
                                                        '$this->txtTotal',
                                                        '$this->txtExtraServiceAmt',
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
        $query  = "UPDATE "._DB_PREFIX."user SET txtFirstName = '$this->txtFirstName',
        										 txtLastName = '$this->txtLastName',
        										 txtPhone = '$this->txtPhone',
        										 txtAddressLine1 = '$this->txtAddressLine1',
        										 txtAddressLine2 = '$this->txtAddressLine2',
        										 txtCity = '$this->txtCity',
        										 txtZipcode = '$this->txtZipcode',
        										 txtUpdateTime = '$data_time'	
        									WHERE txtId = '$param' ";
        $db->query($query);
    }

    public function getExtraServices(){
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
	
}

$objCommon = new Common();

?>