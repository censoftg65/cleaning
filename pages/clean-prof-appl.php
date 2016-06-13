<?php
session_start();

//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
include 'cls_pages.php';
$db = new Config(); 
$coolection = $objPage->getPageContent();

$page_entity = "Employee Application Form";
$_SESSION['page_title'] = ucfirst($page_entity)." | "._SITE_NAME;

$paid_cleaning = array("0-5"=>"0-5","5-10"=>"5-10","10-20"=>"10-20","20-40"=>"20-40");
$know_about = array("Job Portal"=>"Job Portal","Family"=>"Family","Friend"=>"Friend");
$men_size = array("32"=>"34","36"=>"36","38"=>"38","40"=>"40","42"=>"42","44"=>"44","46"=>"46","48"=>"48","50"=>"50","52"=>"52");
$women_size = array("2"=>"2","4"=>"4","6"=>"6","8"=>"8","10"=>"10","12"=>"12","14"=>"14","16"=>"16","18"=>"18");

$fname = $db->getParam('txtFirstName');
$lname = $db->getParam('txtLastName');
$addr = $db->getParam('txtMailingAddr');
$aptmnt = $db->getParam('txtAppartment');
$city = $db->getParam('txtCity');
$state = $db->getParam('txtState');
$zipcode = $db->getParam('txtZipcode');
$expe = $db->getParam('txtWorkExp');
$paidcleaning = $db->getParam('txtPaidCleaning');
$knowabot = $db->getParam('txtHearAbout');
$eligible = $db->getParam('txtEligibleToWork');
$tshirt_preference = $db->getParam('txtTshirtPreference');
$tshirt_size = $db->getParam('txtTshirtSize');
$agree_terms = $db->getParam('txtAgreeTerms');

?>

<?php include dirname(__DIR__).'/includes/header.php' ?>

<body class="inner">
    <div id="wrapper">

		<?php include dirname(__DIR__).'/includes/header-menu.php' ?>

		<div style="margin-top:200px !important;"></div>

		<div id="main-content">
	    	<div class="container page-container">
	        	<div class="row">
	        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-content">
	        			<h2><?= strtoupper('Employee Application Form')?></h2>
						
						<div class="col-md-12"><hr></div>
						
						<div class="col-md-12">
			            	<div class="alert alert-danger" role="alert" style="display:none"></div>
							<form role="form" id="frm-Application" name="frm-Application" method="post" action="quiz-for-professional.php">
			                    <div class="row">
			                        <div class="col-sm-12">
			                    		<h4><b><?= strtoupper('Personal Info')?></b></h4>
			                    	</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">First Name&nbsp;<span>*</span></label>
			                                <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" value="<?= $fname?>">
			                            </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">Last Name&nbsp;<span class>*</span></label>
			                                <input type="text" class="form-control" id="txtLastName" name="txtLastName" value="<?= $lname?>">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">Mailing Address&nbsp;<span class>*</span></label>
			                                <input type="text" class="form-control" id="txtMailingAddr" name="txtMailingAddr" value="<?= $addr?>" onblur="checkMailAddr(this.value)">
			                            </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">Apartment (optional)</label>
			                                <input type="text" class="form-control" id="txtAppartment" name="txtAppartment" value="<?= $aptmnt?>">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">City&nbsp;<span class>*</span></label>
			                                <input type="text" class="form-control" id="txtCity" name="txtCity" value="<?= $city?>">
			                            </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">State/Province&nbsp;<span class>*</span></label>
			                                <input type="text" class="form-control" id="txtState" name="txtState" value="<?= $state?>">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <label class="control-label">Zip code&nbsp;<span class="errmsg">*</span></label>
			                                <input type="text" class="form-control" id="txtZipcode" name="txtZipcode" value="<?= $zipcode?>" maxlength="6">
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row"><div class="col-sm-12">&nbsp;</div></div>
			                    <div class="row">
			                        <div class="col-sm-12">
			                    		<h4><b><?= strtoupper('Other Info')?></b></h4>
			                    	</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">Work Experience&nbsp;<span class>*</span></label>
			                                <div class="input-group">
												<input type="text" class="form-control" id="txtWorkExp" name="txtWorkExp" value="<?= $expe?>">
												<span class="input-group-addon" id="basic-addon2">Of Experience</span>
											</div>
										</div>
			                        </div>
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">How much paid cleaning do you have?&nbsp;<span class>*</span></label>
			                                <select class="form-control" id="txtPaidCleaning" name="txtPaidCleaning">
			                                	<option value="0">-- Select --</option>
			                                	<?php
			                                	foreach ($paid_cleaning as $key => $value) {
			                                		$selected = ($key == $paidcleaning) ? "selected" : "";
			                                		echo "<option value='".$key."' ".$selected.">".$value."</option>";
			                                	}
			                                	?>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">How did you hear about Unwritten Cleaning?&nbsp;<span class>*</span></label>
			                                <select class="form-control" id="txtHearAbout" name="txtHearAbout">
			                                	<option value="0">-- Select --</option>
			                                	<?php
			                                	foreach ($know_about as $key => $value) {
			                                		$selected = ($key == $knowabot) ? "selected" : "";
			                                		echo "<option value='".$key."' ".$selected.">".$value."</option>";
			                                	}
			                                	?>
			                                </select>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">Are you legally eligible to work in the U.S.?&nbsp;<span class>*</span></label>
			                                <div>
												<?php if ($eligible == "Y") { ?>
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="Y" checked="checked">&nbsp;Yes</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="N">&nbsp;No</label>
												<?php } elseif ($eligible == "N") {?>
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="Y">&nbsp;Yes</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="N" checked="checked">&nbsp;No</label>	
												<?php } else {?>
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="Y">&nbsp;Yes</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtEligibleToWork" name="txtEligibleToWork" value="N">&nbsp;No</label>	
												<?php } ?>	
											</div>
										</div>
			                        </div>
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">T-Shirt Preference&nbsp;<span class>*</span></label>
			                                <div>
												<?php if ($tshirt_preference == "M") { ?>
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="M" checked="checked">&nbsp;Mens</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="F">&nbsp;Womens</label>
												<?php } elseif ($tshirt_preference == "F") {?>
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="M">&nbsp;Mens</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="F" checked="checked">&nbsp;Womens</label>	
												<?php } else {?>
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="M">&nbsp;Mens</label>
												&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" id="txtTshirtPreference" name="txtTshirtPreference" value="F">&nbsp;Womens</label>	
												<?php } ?>	
											</div>
										</div>
			                        </div>
			                        <div class="col-sm-4">
			                            <div class="form-group">
			                                <label class="control-label">T-Shirt Size&nbsp;<span class>*</span></label>
			                                <select class="form-control" id="txtTshirtSize" name="txtTshirtSize">
			                                	<?php
			                                	if ($tshirt_preference == "M") {
			                                		foreach ($men_size as $key => $val) {
			                                			$selected = ($tshirt_size == $key) ? "selected" : "";
														echo "<option value='".$key."' ".$selected.">".$val."</option>";
													}
			                                	} elseif ($tshirt_preference == "F") {
			                                		foreach ($women_size as $key => $val) {
														$selected = ($tshirt_size == $key) ? "selected" : "";
														echo "<option value='".$key."' ".$selected.">".$val."</option>";
													}
			                                	} else {
			                                		echo "<option value='0'>-- Select --</option>";
			                                	}	
		                                		?>
			                                </select>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
			                                <div>
			                                	<?php if ($agree_terms == "Y") { ?>
												<label class="checkbox-inline"><input type="checkbox" id="txtAgreeTerms" name="txtAgreeTerms" value="Y" checked="">&nbsp;I agree to all <a href="#">terms and conditions.</a></label>
												<?php } else { ?>
												<label class="checkbox-inline"><input type="checkbox" id="txtAgreeTerms" name="txtAgreeTerms" value="Y">&nbsp;I agree to all <a href="#">terms and conditions.</a></label>	
												<?php } ?>	
											</div>
										</div>
			                        </div>
			                    </div>
			                    <div class="row"><div class="col-sm-6">&nbsp;</div></div>
	                            <div class="form-group pull-right">
			                        <button type="reset" class="btn btn-default" id="btnClear" name="btnClear"><b>Clear Form</b></button>
			                        &nbsp;&nbsp;
			                        <button type="submit" class="btn btn-primary" id="btnApplication" name="btnApplication">
			                            <span style="display:none" id="reg_user_loading"></span>&nbsp;<b>Submit Application</b>
			                        </button>
			                    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>			
    
	</div>	

	<?php include dirname(__DIR__).'/includes/footer-upper-grid.php' ?>

<?php include dirname(__DIR__).'/includes/footer.php'; ?>