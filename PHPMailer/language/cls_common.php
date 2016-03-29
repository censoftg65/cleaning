<?php
/**
* 
*/
class Common
{
	
	public function setDetails($arr_setdetail) {
		$this->txtProPic   	  = $arr_setdetail["txtProPic"];
		$this->txtFirstName   = $arr_setdetail["txtFirstName"];
        // $this->txtMiddleName  = $arr_setdetail["txtMiddleName"];
        $this->txtLastName    = $arr_setdetail["txtLastName"];
        $this->txtEmail       = $arr_setdetail["txtEmail"];
        $this->txtPhoneNum    = $arr_setdetail["txtPhoneNum"];
        $this->txtLocation    = $arr_setdetail["txtLocation"];
        $this->txtGender      = $arr_setdetail["txtGender"];
        $this->txtDOB         = $arr_setdetail["txtDOB"];
        $this->txtStreetNo    = $arr_setdetail["txtStreetNo"];
        $this->txtCity        = $arr_setdetail["txtCity"];
        $this->txtState       = $arr_setdetail["txtState"];
        $this->txtLand        = $arr_setdetail["txtLand"];
        $this->txtPostalCode  = $arr_setdetail["txtPostalCode"];
        $this->txtOtherNum    = $arr_setdetail["txtOtherNum"];
        $this->txtUsername    = $arr_setdetail["txtUsername"];
        $this->txtUserType    = $arr_setdetail["txtUserType"];
        $this->txtUserLevel   = $arr_setdetail["txtUserLevel"];
	}

	public function setClietDetails($arr_client) {
		$this->txtCustId			= $arr_client["txtCustId"];
		$this->txtProPic			= $arr_client["txtProPic"];
		$this->txtFirstName			= $arr_client["txtFirstName"];
		$this->txtMiddleName		= $arr_client["txtMiddleName"];
		$this->txtLastName			= $arr_client["txtLastName"];
		$this->txtGender			= $arr_client["txtGender"];
		$this->txtDOB				= $arr_client["txtDOB"];
		$this->txtEmail				= $arr_client["txtEmail"];
		$this->txtStreetNo			= $arr_client["txtStreetNo"];
		$this->txtCity				= $arr_client["txtCity"];
		$this->txtState				= $arr_client["txtState"];
		$this->txtLand				= $arr_client["txtLand"];
		$this->txtPostalCode		= $arr_client["txtPostalCode"];
		$this->txtPhoneType			= $arr_client["txtPhoneType"];
		$this->txtPhone				= $arr_client["txtPhone"];
		$this->txtOtherNumType		= $arr_client["txtOtherNumType"];
		$this->txtOtherNum			= $arr_client["txtOtherNum"];
		$this->txtInfoMail			= $arr_client["txtInfoMail"];
		$this->txtSubcribeMail		= $arr_client["txtSubcribeMail"];
		$this->txtSubcribeNewLetter	= $arr_client["txtSubcribeNewLetter"];
		$this->txtBillingStreet		= $arr_client["txtBillingStreet"];
		$this->txtBillingCity		= $arr_client["txtBillingCity"];
		$this->txtBillingState		= $arr_client["txtBillingState"];
		$this->txtBillingLand		= $arr_client["txtBillingLand"];
		$this->txtBillingPostalCode	= $arr_client["txtBillingPostalCode"];
		$this->txtBillingAddSame	= $arr_client["txtBillingAddSame"];
		$this->txtComment			= $arr_client["txtComment"];
		$this->txtClientWith		= $arr_client["txtClientWith"];
		$this->txtRelation			= $arr_client["txtRelation"];
		$this->txtReferal			= $arr_client["txtReferal"];
	}

	public function updateAdminDetail($param) {
		$sqlUpdate = "UPDATE tbl_admin SET txtProPic	= '$this->txtProPic',
										   txtFirstName	= '$this->txtFirstName',
										   txtLastName 	= '$this->txtLastName',
										   txtPhoneNum 	= '$this->txtPhoneNum',
										   txtGender 	= '$this->txtGender',
										   txtDOB 		= '$this->txtDOB',
										   txtLocation	= '$this->txtLocation',
										   txtStreetNo 	= '$this->txtStreetNo',
										   txtCity 		= '$this->txtCity',
										   txtState 	= '$this->txtState',
										   txtLand 		= '$this->txtLand',
										   txtPostalCode= '$this->txtPostalCode',
										   txtOtherNum 	= '$this->txtOtherNum' 
										WHERE txtId = '$param' ";
		mysql_query($sqlUpdate);
	}
	public function updateTrainerDetail($param) {
		$sqlUpdate = "UPDATE tbl_trainer SET txtProPic	= '$this->txtProPic',
											 txtFirstName 	= '$this->txtFirstName',
										  	 txtLastName 	= '$this->txtLastName',
											 txtPhoneNum 	= '$this->txtPhoneNum',
											 txtGender 		= '$this->txtGender',
											 txtDOB 		= '$this->txtDOB',
											 txtLocation	= '$this->txtLocation',
											 txtStreetNo 	= '$this->txtStreetNo',
											 txtCity 		= '$this->txtCity',
											 txtState 		= '$this->txtState',
											 txtLand 		= '$this->txtLand',
											 txtPostalCode 	= '$this->txtPostalCode',
											 txtOtherNum 	= '$this->txtOtherNum' 
										WHERE txtId = '$param' ";
		mysql_query($sqlUpdate);
	}

	public function updateClientDetail($param) {
		$sqlUpdate = "UPDATE tbl_clients SET txtProPic 			= '$this->txtProPic', 
											 txtFirstName 			= '$this->txtFirstName',
											 txtMiddleName 			= '$this->txtMiddleName',
											 txtLastName 			= '$this->txtLastName',
											 txtGender 				= '$this->txtGender',
											 txtDOB 				= '$this->txtDOB',
											 txtStreetNo 			= '$this->txtStreetNo',
											 txtCity 				= '$this->txtCity',
											 txtState 				= '$this->txtState',
											 txtLand 				= '$this->txtLand',
											 txtPostalCode 			= '$this->txtPostalCode',
											 txtPhone 				= '$this->txtPhone',
											 txtOtherNum 			= '$this->txtOtherNum',
											 txtBillingStreet 		= '$this->txtBillingStreet',
											 txtBillingCity 		= '$this->txtBillingCity',
											 txtBillingState 		= '$this->txtBillingState',
											 txtBillingLand 		= '$this->txtBillingLand',
											 txtBillingPostalCode 	= '$this->txtBillingPostalCode'
										WHERE txtId = '$param' ";
		mysql_query($sqlUpdate);
	}

	public function getAdminDetails() {
		$selQuery = "SELECT * FROM tbl_admin WHERE txtStatus = '1' ORDER BY txtId DESC";
		$mysql_query = mysql_query($selQuery);
		$collection = array();
		while ($row = mysql_fetch_assoc($mysql_query)) {
	        array_push($collection, $row);
	    }
	    return $collection;
	}

	public function getTrainerDetails() {
		$selQuery = "SELECT * FROM tbl_trainer WHERE txtStatus = '1' ORDER BY txtId DESC";
		$mysql_query = mysql_query($selQuery);
		$collection = array();
		while ($row = mysql_fetch_assoc($mysql_query)) {
	        array_push($collection, $row);
	    }
	    return $collection;
	}

	public function getClientDetails() {
		$selQuery = "SELECT * FROM tbl_clients WHERE txtStatus = '1' ORDER BY txtId DESC";
		$mysql_query = mysql_query($selQuery);
		$collection = array();
		while ($row = mysql_fetch_assoc($mysql_query)) {
	        array_push($collection, $row);
	    }
	    return $collection;
	}

	public function getEditDetails($mode,$param) {
		if ($mode == "edit_admin") {
			$selQuery = "SELECT tbl_admin.txtUserId,tbl_admin.txtProPic,tbl_admin.txtFirstName,tbl_admin.txtMiddleName,
								tbl_admin.txtLastName,tbl_admin.txtEmail,tbl_admin.txtPhoneNum,tbl_admin.txtLocation,
								tbl_admin.txtGender,tbl_admin.txtDOB,tbl_admin.txtStreetNo,tbl_admin.txtCity,
								tbl_admin.txtState,tbl_admin.txtLand,tbl_admin.txtPostalCode,tbl_admin.txtOtherNum,
								tbl_admin.txtDate,tbl_user.txtUsername,tbl_user.txtEmail,tbl_user.txtUserType,
								tbl_user.txtUserLevel
						 FROM tbl_admin 
						 LEFT JOIN tbl_user
						 	ON tbl_user.txtId = tbl_admin.txtUserId
						 WHERE tbl_admin.txtId = '$param'";
		}
		if ($mode == "edit_trainer") {
			$selQuery = "SELECT tbl_trainer.txtUserId,tbl_trainer.txtProPic,tbl_trainer.txtFirstName,
								tbl_trainer.txtMiddleName,tbl_trainer.txtLastName,tbl_trainer.txtEmail,
								tbl_trainer.txtPhoneNum,tbl_trainer.txtLocation,tbl_trainer.txtGender,tbl_trainer.txtDOB,
								tbl_trainer.txtStreetNo,tbl_trainer.txtCity,tbl_trainer.txtState,tbl_trainer.txtLand,
								tbl_trainer.txtPostalCode,tbl_trainer.txtOtherNum,tbl_trainer.txtDate,
								tbl_user.txtUsername,tbl_user.txtEmail,tbl_user.txtUserType,tbl_user.txtUserLevel
						 FROM tbl_trainer
						 LEFT JOIN tbl_user
						 	ON tbl_user.txtId = tbl_trainer.txtUserId
						 WHERE tbl_trainer.txtId = '$param'";
		}
		if ($mode == "edit_client") {
			$selQuery = "SELECT * FROM tbl_clients WHERE txtId = '$param'";
		}
		$mysql_query = mysql_query($selQuery);
		$collection = array();
		while ($row = mysql_fetch_assoc($mysql_query)) {
	        array_push($collection, $row);
	    }
	    return $collection;
	}
}

?>