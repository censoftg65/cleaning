<?php
/**
* 
*/
class User
{
	
	function __construct() {
		# code...
	}

	public function setDetails($arr_user) {
		$this->txtEmail        	= $arr_user['txtEmail'];
		$this->txtUsername    	= $arr_user['txtUsername'];
		$this->txtPassword    	= $arr_user['txtPassword'];
		$this->txtFirstName    	= $arr_user['txtFirstName'];
		$this->txtLastName    	= $arr_user['txtLastName'];
		$this->txtAddressLine1 	= $arr_user['txtAddressLine1'];
		$this->txtAddressLine2 	= $arr_user['txtAddressLine2'];
		$this->txtCountry      	= $arr_user['txtCountry'];
		$this->txtState        	= $arr_user['txtState'];
		$this->txtCity        	= $arr_user['txtCity'];
		$this->txtZipcode      	= $arr_user['txtZipcode'];
		$this->txtPhone        	= $arr_user['txtPhone'];
		$this->txtIpAddress     = $arr_user['txtIpAddress'];
	}

	public function insertDetails() {
		$db = new Config();
		$sql_query = "INSERT INTO "._DB_PREFIX."user (
														txtEmail,
														txtUsername,
														txtPassword,
														txtFirstName,
														txtLastName,
														txtAddressLine1,
														txtAddressLine2,
														txtCountry,
														txtState,
														txtCity,
														txtZipcode,
														txtPhone,
														txtUserLevel,
														txtIpAddress,
														txtUserType,
														txtCreatedBy,
														txtStatus
											  )VALUES(
											  			'$this->txtEmail',
														'$this->txtUsername',
														'$this->txtPassword',
														'$this->txtFirstName',
														'$this->txtLastName',
														'$this->txtAddressLine1',
														'$this->txtAddressLine2',
														'$this->txtCountry',
														'$this->txtState',
														'$this->txtCity',
														'$this->txtZipcode',
														'$this->txtPhone',
														'user',
											  			'$this->txtIpAddress',
											  			'new',
											  			'user',
											  			'1'
													)";
		$db->query($sql_query);											
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

	public function checkEmail($param) {
		$db = new Config();
		$query  = $db->select('txtEmail');
		$query .= $db->from(_DB_PREFIX.'user');
		$query .= $db->where('txtEmail = '."'$param'");
		$db->query($query);
		return $db->numRows();
	}

	public function checkResetEmail($param) {
		$db = new Config();
		$query  = $db->select('txtEmail');
		$query .= $db->from(_DB_PREFIX.'user');
		$query .= $db->where('txtEmail = '."'$param'");
		$db->query($query);
		return $db->numRows();
	}

	public function setResetDetails($arr_user) {
		$this->txtUserId  	= $arr_user['txtUserId'];
		$this->txtResetKey  = $arr_user['txtResetKey'];
	}	

	public function insertResetPass() {
		$db = new Config();
		$query  = "INSERT INTO "._DB_PREFIX."reset_pass (
															txtUserId,
															txtResetKey,
															txtStatus
														) 
												 VALUES (
												 			'$this->txtUserId',
												 			'$this->txtResetKey',
												 			'1'
														)";
		$db->query($query);
	}

	public function checkUserKey($key) {
		$db = new Config();
		$query  = $db->select('txtUserId, txtStatus');
		$query .= $db->from(_DB_PREFIX.'reset_pass');
		$query .= $db->where('txtResetKey = '."'$key'");
		$db->query($query);
		$collection = array();
		while($row = $db->fetchAssoc()) {
		    array_push($collection,$row);
		}
		return $collection;
	}

	public function getResetkey($key,$id) {
		$db = new Config();
		$query  = $db->select('txtStatus');
		$query .= $db->from(_DB_PREFIX.'reset_pass');
		$query .= $db->where('txtResetKey = '."'$key'".' AND txtUserId = '."'$id'");
		$db->query($query);
		$collection = array();
		while($row = $db->fetchAssoc()) {
		    array_push($collection,$row);
		}
		return $collection;
	}

	public function updateResetPass($key,$param) {
		$db = new Config();
		$date_time = getCurrentDateTime("all");
		$query  = "UPDATE "._DB_PREFIX."reset_pass SET txtStatus = 0,
													  txtUpdated = '$date_time'
												WHERE txtResetKey = '$key' AND txtUserId = '$param'";
		$db->query($query);
	}

	public function updateUserPass($pass,$param) {
		$db = new Config();
		$date_time = getCurrentDateTime("all");
		$query = "UPDATE "._DB_PREFIX."user SET txtPassword = '$pass',txtUpdateTime = '$date_time' WHERE txtId = '$param'";
		$db->query($query);
	}	
}

$objUser = new User();

?>