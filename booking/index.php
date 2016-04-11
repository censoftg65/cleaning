 <?php
/*index.php
* This file for book now form
*/
?>

<?php
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
?>
<?php require_once(dirname(__DIR__).'/inc/config.inc.php');?>
<?php include_once(dirname(__DIR__).'/pages/cls_pages.php');?>
<?php $_SESSION['page_title'] = "Booking Form";?><!-- Show page title -->
<?php include_once(_INCLUDE_PATH.'/header.php');?>

<!-- THIS CSS FOR BOOKING FORM -->
<link href="<?= _CSS_URL  ?>/booking-awesome.css" rel="stylesheet">
<link href="<?= _CSS_URL  ?>/wizard.css" rel="stylesheet"/>
    <!-- END THIS CSS FOR BOOKING FORM -->

<script src="js/booking.js"></script><!-- ALL BOKKING JS SCRIPT -->


<?php include_once('cls_common.php');?>

<body class="inner">
	<div id="wrapper">
		<?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
		<div style="margin-top:160px !important;"></div>
		<!-- complete-booking-form -->
		<div class="complete-booking-form">
			<div class="col-lg-12">
				<div id="succ-resp"></div>
				<div class="card">
					<div class="card-body ">
						<div id="rootwizard2" class="form-wizard form-wizard-horizontal">
							<form class="form-horizontal form-validation" id="bookingForm" role="form" method="post">
								<div class="form-wizard-nav">
									<div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
									<ul class="nav nav-justified">
										<li class="active"><a href="#step1" id="step1_profile" data-toggle="tab"><span class="step">1</span> <span class="title">PERSONAL</span></a></li>
										<li><a href="#step2" id="step2_booking" data-toggle="tab"><span class="step">2</span> <span class="title">BOOKING</span></a></li>
										<li><a href="#step3" id="step3_confirm"  data-toggle="tab"><span class="step">3</span> <span class="title">CONFIRM</span></a></li>
									</ul>
								</div><!--end .form-wizard-nav -->
								<div class="tab-content clearfix">
									<!--Step1-->
									<div class="tab-pane active" id="step1">
										<br/><br/>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtFirstname" class="col-sm-4 control-label">Firstname</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtFirstname" name="txtFirstname" required="">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtLastname" class="col-sm-4 control-label">Lastname</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtLastname" name="txtLastname" required="">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtAddressLine1" class="col-sm-4 control-label">Address Line1</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtAddressLine1" name="txtAddressLine1" required="">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtAddressLine2" class="col-sm-4 control-label">Address Line2</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtAddressLine2" name="txtAddressLine2" required="">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtCountry" class="col-sm-4 control-label">Country</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCountry"  name="txtCountry"  value="USA" readOnly />
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtState" class="col-sm-4 control-label">State/Provience</label>
													<div class="col-sm-8">
														<select id="txtState" name="txtState" class="form-control" required="" />
														<option value="">(please select)</option>
														<?php $USSates =  $USStateListingObj->getUSStateListing(); ?>
														<?php foreach ($USSates as $value):?>
														<option value="<?= $value['txtAbbreviation']?>"><?= $value['txtState']?></option>
														<?php endforeach?>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtCity" class="col-sm-4 control-label">City</label>
													<div class="col-sm-8">
														<select id="txtCity" name="txtCity" class="form-control" required="" />
														<option value="">(please select)</option>
													</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtZipcode" class="col-sm-4 control-label">Zip code</label>
													<div class="col-sm-8">
														<select id="txtZipcode" name="txtZipcode" class="form-control" required>
															<option value="">(please select)</option>
															<option value="00501">00501</option>
															<option value="00502">00502</option>
															<option value="00503">00503</option>
															<option value="00504">00504</option>
															<option value="00505">00505</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtEmailId" class="col-sm-4 control-label">Email Id</label>
													<div class="col-sm-8">
														<input type="email" class="form-control" id="txtEmailId" name="txtEmailId" required="">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtPhone" class="col-sm-4 control-label">Phone</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtPhone" name="txtPhone" required="">
													</div>
												</div>
											</div>
										</div>

										<br/><br/>
										<div class="card-actionbar">
											<div class="card-actionbar-row">
												<button type="button" class="next-step1-preview btn btn-primary">Preview</button>
											</div>
										</div>
									</div><!--end #step1 -->

									<!--Step2-->
									<div class="tab-pane" id="step2">
										<br/><br/>
										<input type="hidden" value="XXX" name="is_step_2"><!-- Don't change this value -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtBedroom" class="col-sm-4 control-label">Choose Bedroom</label>
													<div class="col-sm-8">
														<select id="txtBedroom" name="txtBedroom" class="form-control" required>
															<option value="">(please select)</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7 & up</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtBathroom" class="col-sm-4 control-label">Choose Bathroom</label>
													<div class="col-sm-8">
														<select id="txtBathroom" name="txtBathroom" class="form-control" required>
															<option value="">(please select)</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="extraService" class="col-sm-4 control-label"><h3>Extra Choose Below</h3></label>
										</div>

										<div class="row">
											<div class="form-group">
												<?php $extraServices =  $extraBookingServiceObj->getExtraBookingServices(); ?>
												<?php foreach ($extraServices as $key => $value):?>
												<div class="col-sm-2"></div>
												<div class="col-sm-2">
													<div class="form-group">
														<label class="checkbox-inline checkbox-styled">
															<div class="col-sm">
																<input type="checkbox" data-serviceprice="<?= $value['txtServicePrice']?>" value="<?= $value['txtId'].'@'.$value['txtServiceName']?>" name="txtExtraCleaningServiceId[]"><span><?= $value['txtServiceName']?></span>
															</div>
														</label>
													</div>
												</div>
											<?php endforeach;?>
										</div>
									</div>	
									<!-- This input box for Date Preview Logic Purpose# Don't change this value# -->
									<input type="hidden" name="txtPreviewDate" value="XXX" required="" >

								<!-- <div class="row">
								<div class="col-sm-12"> -->
									<div class="form-group">
										<label for="txtServiceDateTime" class="col-sm-2 control-label">Service Date</label>
										<div class="col-sm-10">
											<input type="text" name="txtServiceDateTime" id="txtServiceDateTime" class="form-control" required="" readOnly>
										</div>
									</div>

								<div class="form-group">
									<label for="txtServiceHours" class="col-sm-2 control-label">Choose No. of Hours</label>
									<div class="col-sm-10">
										<select id="txtServiceHours" name="txtServiceHours" class="form-control" required="" />
											<option value="">(please select)</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="txtServiceTip" class="col-sm-2 control-label">Add Tip</label>
									<div class="col-sm-10">
										<input type="text" name="txtServiceTip" id="txtServiceTip" class="form-control" data-rule-minlength="2" required>
									</div>
								</div>

								<div class="form-group">
									<label for="txtTotal" class="col-sm-2 control-label">Total  ($)</label>
									<div class="col-sm-10">
											<select id="txtTotal" name="txtTotal" class="form-control" required="" />
											<option value="">(please select)</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</div>

								<br/><br/>
								<div class="card-actionbar">
									<div class="card-actionbar-row">
										<button type="button" class="next-step2-preview btn btn-primary">Preview</button>
									</div>
								</div>
							</div><!--end #step2 -->

							<!--start #step3 -->
							<div class="tab-pane" id="step3">
								<br/><br/>
								<div class="card-actionbar">
									<div class="card-actionbar-row">
										<button type="submit" id="btnSaveBookingForm" name="btnSaveBookingForm" class="btn btn-primary">Save All</button>
									</div>
								</div>
							</div><!--end #step3 -->

						</div><!--end .tab-content -->
					</form>
				</div><!--end #rootwizard -->
			</div><!--end .card-body -->
		</div><!--end .card -->
	</div><!--end .col -->
</div><!--end .row -->


<!-- Step1 Preview Confirmation Model Popup-->
<div class="modal fade" id="step1-preview" tabindex="-1" role="dialog" aria-labelledby="step1-preview" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="step1_previewLabel">Profile Preview</h4>
			</div>
			<div class="modal-body" style="padding-bottom:160px !important;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel & Edit</button>
				<button type="button" class="gotoStep2 btn btn-primary" data-dismiss="modal">Confirm & Next</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End of Step1 Preview Confirmation Model Popup-->

<!-- Step2 Preview Confirmation Model Popup-->
<div class="modal fade" id="step2-preview" tabindex="-1" role="dialog" aria-labelledby="step1-preview" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="step1_previewLabel">Booking Preview</h4>
			</div>
			<div class="modal-body" style="padding-bottom:160px !important;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel & Edit</button>
				<button type="button" class="gotoStep3 btn btn-primary" data-dismiss="modal">Confirm & Next</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End of Step2 Preview Confirmation Model Popup-->

<!-- complete-booking-form -->

<?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>