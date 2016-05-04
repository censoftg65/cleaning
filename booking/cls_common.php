<?php
/*filename :  cls_common.php
* description :  for insertion in booking table
*/
?>
<?php
/*### To get Extra Booking Services ###*/
class extraBookingService{
	public function getExtraBookingServices(){
		$db = new Config();
	    $query = "SELECT `txtId`, `txtServiceName`, `txtServicePrice` FROM `"._DB_PREFIX."extra_services` ";
		$result = $db->query($query);
		$data = array();
		while($rows = $db->fetchAssoc($result)){
			array_push($data,$rows);
		}
		return $data;
	}


}
$extraBookingServiceObj = new extraBookingService();

/*###End To get Extra Booking Services ###*/


/*### To get States from US ###*/
class USStateListing{
	public function getUSStateListing(){
		$db = new Config();
	    $query = "SELECT `txtAbbreviation`, `txtState` FROM `"._DB_PREFIX."us_states` WHERE ";
		$result = $db->query($query);
		$data = array();
		while($rows = $db->fetchAssoc($result)){
			array_push($data,$rows);
		}
		return $data;
	}
}
$USStateListingObj = new USStateListing();


/*### To get City from State of US ###*//*
class USCityListing{
	public function getUSStateListing(){
		$db = new Config();
	    $query = "SELECT `txtAbbreviation`, `txtState` FROM `"._DB_PREFIX."us_states` ";
		$result = $db->query($query);
		$data = array();
		while($rows = $db->fetchAssoc($result)){
			array_push($data,$rows);
		}
		return $data;
	}
}
$USCityListingObj = new USCityListing();


/*### To get Zipcode from City->States from US ###*//*
class USStateListing{
	public function getUSStateListing(){
		$db = new Config();
	    $query = "SELECT `txtAbbreviation`, `txtState` FROM `"._DB_PREFIX."us_states` ";
		$result = $db->query($query);
		$data = array();
		while($rows = $db->fetchAssoc($result)){
			array_push($data,$rows);
		}
		return $data;
	}
}
$USStateListingObj = new USStateListing();


*/
?>

