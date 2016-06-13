<?php
/**
* 
*/
class Siteconfig
{
	function __construct() {
		# code...
	}

	public function setAdminProfile($arr_admin) {
		$this->txtFirstName		= $arr_admin['txtFirstName'];
		$this->txtLastName		= $arr_admin['txtLastName'];
		$this->txtPhone			= $arr_admin['txtPhone'];
		$this->txtAddressLine1	= $arr_admin['txtAddressLine1'];
		$this->txtAddressLine2	= $arr_admin['txtAddressLine2'];
		$this->txtCountry		= $arr_admin['txtCountry'];
		$this->txtState			= $arr_admin['txtState'];
		$this->txtCity			= $arr_admin['txtCity'];
		$this->txtZipcode		= $arr_admin['txtZipcode'];
		$this->txtStatus		= $arr_admin['txtStatus'];
	}

	public function setAdminConfig($arr_config) {
		$this->txtSiteName 			= $arr_config['txtSiteName'];
		$this->txtSiteLanguage 		= $arr_config['txtSiteLanguage'];
		$this->txtSMTPhost 			= $arr_config['txtSMTPhost'];
		$this->txtSMTPport 			= $arr_config['txtSMTPport'];
		$this->txtSMTPuname 		= $arr_config['txtSMTPuname'];
		$this->txtSMTPpword 		= $arr_config['txtSMTPpword'];
		$this->txtSMTPfromname 		= $arr_config['txtSMTPfromname'];
		$this->txtSMTPrplymail 		= $arr_config['txtSMTPrplymail'];
		$this->txtSMTPccmail 		= $arr_config['txtSMTPccmail'];
		$this->txtSMTPbccmail 		= $arr_config['txtSMTPbccmail'];
		$this->txtRegSub			= $arr_config['txtRegSub'];
		$this->txtRegMailFrom		= $arr_config['txtRegMailFrom'];
		$this->txtRegBody			= $arr_config['txtRegBody'];
		$this->txtRegAdminBody		= $arr_config['txtRegAdminBody'];
		$this->txtForgotSub			= $arr_config['txtForgotSub'];
		$this->txtForgotMailFrom	= $arr_config['txtForgotMailFrom'];
		$this->txtForgotBody		= $arr_config['txtForgotBody'];
		$this->txtOfferSub			= $arr_config['txtOfferSub'];
		$this->txtOfferMailFrom		= $arr_config['txtOfferMailFrom'];
		$this->txtOfferBody			= $arr_config['txtOfferBody'];
		$this->txtAccountSub		= $arr_config['txtAccountSub'];
		$this->txtAccountMailFrom	= $arr_config['txtAccountMailFrom'];
		$this->txtAccountBody		= $arr_config['txtAccountBody'];
		$this->txtAccountAdminBody	= $arr_config['txtAccountAdminBody'];
	}

	public function setAdminAccount($arr_admin) {
		$this->txtPassword	= $arr_admin['txtPassword'];
	}	

	public function updateAdminProfile($param) {
		$db = new Config();
		$date_time = getCurrentDateTime("all");
		$sql_query = "UPDATE "._DB_PREFIX."user SET txtFirstName	= '$this->txtFirstName',
													txtLastName		= '$this->txtLastName',
													txtPhone		= '$this->txtPhone',
													txtAddressLine1	= '$this->txtAddressLine1',
													txtAddressLine2	= '$this->txtAddressLine2',
													txtCountry		= '$this->txtCountry',
													txtState		= '$this->txtState',
													txtCity			= '$this->txtCity',
													txtZipcode		= '$this->txtZipcode',
													txtUpdateTime	= '$date_time',
													txtStatus		= '$this->txtStatus'
											  WHERE txtId = '$param'";
		$db->query($sql_query);
	}

	public function updateAdminAccount($param) {
		$db = new Config();
		$date_time = getCurrentDateTime("all");
		$sql_query = "UPDATE "._DB_PREFIX."user SET txtPassword	= '$this->txtPassword',
													txtUpdateTime	= '$date_time'
											  WHERE txtId = '$param'";
		$db->query($sql_query);
	}

	public function updateConfigWthOutPass($param) {
		$db = new Config();
		echo $sql_query = "UPDATE "._DB_PREFIX."settings SET txtSiteName 		= '$this->txtSiteName',
														txtSiteLanguage 	= '$this->txtSiteLanguage',
														txtSMTPhost 		= '$this->txtSMTPhost',
														txtSMTPport 		= '$this->txtSMTPport',
														txtSMTPuname 		= '$this->txtSMTPuname',
														txtSMTPfromname 	= '$this->txtSMTPfromname',
														txtSMTPrplymail 	= '$this->txtSMTPrplymail',
														txtSMTPccmail 		= '$this->txtSMTPccmail',
														txtSMTPbccmail 		= '$this->txtSMTPbccmail',
														txtRegSub 			= '$this->txtRegSub',
														txtRegMailFrom 		= '$this->txtRegMailFrom',
														txtRegBody 			= '$this->txtRegBody',
														txtRegAdminBody 	= '$this->txtRegAdminBody',
														txtForgotSub 		= '$this->txtForgotSub',
														txtForgotMailFrom 	= '$this->txtForgotMailFrom',
														txtForgotBody 		= '$this->txtForgotBody',
														txtOfferSub 		= '$this->txtOfferSub',
														txtOfferMailFrom 	= '$this->txtOfferMailFrom',
														txtOfferBody 		= '$this->txtOfferBody',
														txtAccountSub 		= '$this->txtAccountSub',
														txtAccountMailFrom 	= '$this->txtAccountMailFrom',
														txtAccountBody 		= '$this->txtAccountBody',
														txtAccountAdminBody = '$this->txtAccountAdminBody'
											  	  WHERE txtId = '$param'";
		$db->query($sql_query);
	}

	public function updateConfigWthPass($param) {
		$db = new Config();
		echo $sql_query = "UPDATE "._DB_PREFIX."settings SET txtSiteName 		= '$this->txtSiteName',
														txtSiteLanguage 	= '$this->txtSiteLanguage',
														txtSMTPhost 		= '$this->txtSMTPhost',
														txtSMTPport 		= '$this->txtSMTPport',
														txtSMTPuname 		= '$this->txtSMTPuname',
														txtSMTPpword 		= '$this->txtSMTPpword',
														txtSMTPfromname 	= '$this->txtSMTPfromname',
														txtSMTPrplymail 	= '$this->txtSMTPrplymail',
														txtSMTPccmail 		= '$this->txtSMTPccmail',
														txtSMTPbccmail 		= '$this->txtSMTPbccmail',
														txtRegSub 			= '$this->txtRegSub',
														txtRegMailFrom 		= '$this->txtRegMailFrom',
														txtRegBody 			= '$this->txtRegBody',
														txtRegAdminBody 	= '$this->txtRegAdminBody',
														txtForgotSub 		= '$this->txtForgotSub',
														txtForgotMailFrom 	= '$this->txtForgotMailFrom',
														txtForgotBody 		= '$this->txtForgotBody',
														txtForgotAdminBody 	= '$this->txtForgotAdminBody',
														txtOfferSub 		= '$this->txtOfferSub',
														txtOfferMailFrom 	= '$this->txtOfferMailFrom',
														txtOfferBody 		= '$this->txtOfferBody',
														txtOfferAdminBody 	= '$this->txtOfferAdminBody',
														txtAccountSub 		= '$this->txtAccountSub',
														txtAccountMailFrom 	= '$this->txtAccountMailFrom',
														txtAccountBody 		= '$this->txtAccountBody',
														txtAccountAdminBody = '$this->txtAccountAdminBody'
											  	  WHERE txtId = '$param'";
		$db->query($sql_query);
	}

	public function getBookingNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."booking WHERE txtNotify = 1";
		$db->query($query);
		return $db->numRows();
	}

	public function getUpdateNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."booking WHERE txtNotify = 2";
		$db->query($query);
		return $db->numRows();
	}

	public function getDiscountNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."promo_offers WHERE txtNotify = 1 AND txtStatus = 0";
		$db->query($query);
		return $db->numRows();
	}

	public function getRateNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."rating WHERE txtNotify = 1";
		$db->query($query);
		return $db->numRows();
	}

	public function getUpdateRateNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."rating WHERE txtNotify = 2";
		$db->query($query);
		return $db->numRows();
	}

	public function getUserNotify() {
		$db = new Config();
		$query = "SELECT txtId FROM "._DB_PREFIX."user WHERE txtCreatedBy = 'user' AND txtNotify = 1";
		$db->query($query);
		return $db->numRows();
	}

}

$objSite = new Siteconfig();