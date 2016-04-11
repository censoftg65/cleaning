<?php
/*filename :  process.php
 *description : for insertion in booking table
 */
?>
<?php require_once(dirname(dirname(__DIR__)) . '/inc/config.inc.php');?>
<?php
$db = new Config();

/*#######Login Start Here#########*/

$booking_data_arr          = $_POST;
$txtExtraCleaningServiceId = $booking_data_arr['txtExtraCleaningServiceId'];
$booking_data_arr['txtServiceDateTime'] = date("Y-m-d H:i:s", strtotime($booking_data_arr['txtServiceDateTime']));/*Covert time to 24 Format*/

foreach ($txtExtraCleaningServiceId as $key => $value) {
    $extra_cleaning_ids .= strtok($value, '@') . ',';
    /*remove string after @*/
}
$extra_cleaning_ids = substr($extra_cleaning_ids, 0, -1);
/*remove last ,*/

$booking_data_arr['txtExtraCleaningServiceId'] = $extra_cleaning_ids;
$profile_data                                  = "";
$profile_data_arr                              = array();
$booking_data                                  = "";
$seperator                                     = ",";
$result                                        = "Unexpected error occured, please contact admin";
foreach ($booking_data_arr as $key => $value) {
    if ($key == "is_step_2") {
        break;
    }
    $profile_data .= "'" . $value . "'" . $seperator;
    $profile_data_arr[] .= $value;
}
$profile_data = substr($profile_data, 0, -1);
/*remove last ,*/

$booking_data_arr = array_values($booking_data_arr);
/*change keys to number for complete booking form*/
$profile_data_arr = array_values($profile_data_arr);
/*change keys to number for profile data*/

$booking_prof_arr = array_diff_key($booking_data_arr, $profile_data_arr);

/*Remove all dummy values such XXX*/
$xxxkeys = array_keys($booking_prof_arr, "XXX");
foreach ($xxxkeys as $value) {
	unset($booking_prof_arr[$value]);
}
/*End Remove all dummy values such XXX*/

foreach ($booking_prof_arr as $value) {
    $booking_data .= "'" . $value . "'" . $seperator;
}
$booking_data = substr($booking_data, 0, -1);
/*remove last comma,*/

/*Insert in Booking Profile*/
$query_profile = "INSERT INTO 
 		`" . _DB_PREFIX . "user_profile`(
				`txtFirstname`, `txtLastname`, `txtAddressLine1`, `txtAddressLine2`, `txtCountry`,
					`txtCity`, `txtState`, `txtZipcode`, `txtEmailId`, `txtPhone`)
						VALUES(" . $profile_data . ")";
$result_profile = $db->query($query_profile);
if ($result_profile) {
    	$profile_id   = mysql_insert_id();
   		$booking_data = $profile_id . ',' . $booking_data;
    /*add profile id*/
    
    /*Insert in Booking Form*/
        $query_booking_prof = "INSERT INTO 
     	`" . _DB_PREFIX . "booking_profile`(
				`txtBookingUserId`, `txtBedroom`, `txtBathroom`,  `txtExtraCleaningServiceId`,
					`txtServiceDateTime`, `txtServiceHours`, `txtServiceTip`, `txtTotal`)
						VALUES(" . $booking_data . ")";
    $result_booking_prof = $db->query($query_booking_prof);
    if ($result_booking_prof) {
        $result = "Booking Details Insert successfully";
    }
}

echo "<h2>" . $result . "</h2>";

close();/*close mysql connection*/