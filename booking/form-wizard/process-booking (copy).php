<?php
/*filename :  process.php
*description : for insertion in booking table
*/
?>
<?php
echo '<pre>';

$booking_data_arr = $_POST;
$booking_data_arr = array_values($booking_data_arr);
$profile_data = "";
$profile_data_arr = array();
$booking_data = "";
$seperator = ", ";
$last_prof_key = 10;
foreach ($booking_data_arr as $key => $value) {
	if ($key == $last_prof_key) {
		break;
	}
	if ($key == ($last_prof_key-1)) {
		$seperator = "";
	}
	$profile_data .=  "'".$value."'" .$seperator;
	$profile_data_arr[] .= $value;
}
echo "profile : ".$profile_data;

$booking_prof_arr = array_diff_key($booking_data_arr, $profile_data_arr);
$booking_prof_arr = array_values($booking_prof_arr);
$booking_last_el = count($booking_prof_arr);
foreach ($booking_prof_arr as $key => $value) {
	$seperator = ", ";
	if ($key == ($booking_last_el-1)) {
		$seperator = "";
	}
	$booking_data .=  "'".$value."'" .$seperator;
}
echo "<br>Booking Data : ".$booking_data;

/*
echo $query = "INSERT INTO `wc_booking_user_details`(
	`firstname`, `lastname`, `addressLine1`, `addressLine2`, `country`,
	`city`, `state`, `zipcode_id`, `email`, `phone`)
VALUES(


	)	";*/