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
<?php $_SESSION['page_title'] = "Booking Form";?><!-- Show page title -->
<?php include_once(_INCLUDE_PATH.'/header.php');?>
<!-- THIS CSS FOR BOOKING FORM -->
<link href="<?= _CSS_URL  ?>/booking-awesome.css" rel="stylesheet">
<link href="<?= _CSS_URL  ?>/wizard.css" rel="stylesheet"/>
    <!-- END THIS CSS FOR BOOKING FORM -->
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
														<input type="text" class="form-control" id="txtCountry"  name="txtCountry"  required="">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtCity" class="col-sm-4 control-label">City</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCity" name="txtCity" required="">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtState" class="col-sm-4 control-label">State/Provience</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtState" name="txtState" required="">
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtZipcode" class="col-sm-4 control-label">Zip code</label>
													<div class="col-sm-8">
														<select id="txtZipcode" name="txtZipcode" class="form-control" required>
															<option value="">(select zipcode)</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
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
										<input type="hidden" value="XXX" name="is_step_2">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtBedroom" class="col-sm-4 control-label">Choose Bedroom</label>
													<div class="col-sm-8">
														<select id="txtBedroom" name="txtBedroom" class="form-control" required>
															<option value="">&nbsp;</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="txtBathroom" class="col-sm-4 control-label">Choose Bathroom</label>
													<div class="col-sm-8">
														<select id="txtBathroom" name="txtBathroom" class="form-control" required>
															<option value="">&nbsp;</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
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
																<input type="checkbox" value="<?= $value['txtId'].'@'.$value['txtServiceName']?>" name="txtExtraCleaningServiceId[]"><span><?= $value['txtServiceName']?></span>
															</div>
														</label>
													</div>
												</div>
											<?php endforeach;?>
										</div>
									</div>	


								<!-- <div class="row">
								<div class="col-sm-12"> -->
									<div class="form-group">
										<label for="txtServiceDateTime" class="col-sm-2 control-label">Service Date</label>
										<div class="col-sm-10">
											<input type="text" name="txtServiceDateTime" id="txtServiceDateTime" class="form-control" required readOnly>
										</div>
									</div>
									<!-- </div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="service_time" class="col-sm-4 control-label">Service Time</label>
											<div class="col-sm-8">
												<input type="text" name="service_time" id="service_time" class="form-control" required>
											</div>
										</div>
									</div>
								</div> -->

								<div class="form-group">
									<label for="txtServiceHours" class="col-sm-2 control-label">Choose No. of Hours</label>
									<div class="col-sm-10">
										<select id="txtServiceHours" name="txtServiceHours" class="form-control" required>
											<option value="">&nbsp;</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
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
									<label for="txtTotal" class="col-sm-2 control-label">Total</label>
									<div class="col-sm-10">
										<input type="text" name="txtTotal" id="txtTotal" class="form-control" required>
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


<script>
$(document).ready(function(){
/*  $("#step2_booking").prop("disabled",true);
    $("#step3_confirm").prop("disabled",true);
    $("#btnSaveBookingForm").prop("disabled",true);
    */
/*    var _date = new Date();
_today = _date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();*/

/*for date in step2*/
$('#txtServiceDateTime').datetimepicker({
	format: 'dd-mm-yy hh:ii P',
	showMeridian: true,
	autoclose: true,
});
    /*for datetime in step2
    $('#service_time').datetimepicker({
    	format:'hh:ii',
    	autoclose: true,
    	startDate : _today,
    	endDate : _today+' 23:59'
    });
*/
$(".next-step1-preview").click(function(){
	if($(".form-horizontal").valid()){
		var formdata = $(".form-horizontal").serializeArray();
		var step1_model_preview = '';
		$.each(formdata, function(index,field) {
			if(field.name == "is_step_2"){
				return false;
			}
			if(field.value){
				step1_model_preview += '<div class="col-sm-6"><div class="form-group">';
				step1_model_preview += '<label for="country" class="col-sm-6 control-label">'+field.name.replace('txt','')+' : </label>';
				step1_model_preview += '<div class="col-sm-6">'+field.value.replace('txt','')+'</div></div></div>';
			}
		});
		$(".modal-body").html(step1_model_preview);
		$("#step1-preview").modal('show');
		/*$("#step2_booking").prop("disabled",false);*/
	};
})

$(".next-step2-preview").click(function(){
	if($("#bookingForm").valid()){
		var formdata = $("#bookingForm").serializeArray();
		var step2_model_preview = '';
		var extra_service_arr = '';
		var check_flag = 0;
		$.each(formdata, function(index, field) {
			if((field.value) && (index > 10)){ /*10 index for hidden element XXXX*/
				var for_extra_ser = field.value.indexOf("@") + 1;
				if(for_extra_ser){
					extra_service_arr += field.value.substring(for_extra_ser)+',';
					check_flag++;
					return;
				}else{
					field_value = field.value;
				}
				step2_model_preview += '<div class="col-sm-6"><div class="form-group">';
				step2_model_preview += '<label for="country" class="col-sm-6 control-label">'+field.name.replace('txt','')+' : </label>';
				step2_model_preview += '<div class="col-sm-6">';
				
				if(check_flag > 0){
					step2_model_preview += extra_service_arr.slice(0, -1);
					check_flag = 0;
				}	else{
					step2_model_preview += field_value;
				}		
				step2_model_preview += '</div></div></div>';	
			}
		});
		$(".modal-body").html(step2_model_preview);
		$("#step2-preview").modal('show');
		/*$("#step3_confirm").prop("disabled",false);*/
	};
})

$(".gotoStep2").click(function(){
	$("#step2_booking").trigger('click');
})
$(".gotoStep3").click(function(){
	$("#step3_confirm").trigger('click');
	/*$("#btnSaveBookingForm").prop("disabled",false);*/
})
})




/*########AjaxJqueryInsertion for Booking-form inside bookings/index.php #########*/

$(document).ready(function() {
	$('#bookingForm').submit(function(e) {
		e.preventDefault();
		var formdata = $("#bookingForm").serialize();
		$.ajax({
			type        : 'POST',
			url         : "form-wizard/process-booking.php",
			data        : formdata,
			beforeSend: function() {
				if($('#bookingForm').valid() === false){
					return false;
				}else{
					$("body").addClass("faderclass");
				}
			},
			success:function(data){
				$("body").removeClass("faderclass");
				$("#succ-resp").html(data);
           // $("#succ-resp").html("Thanks for booking, we will get back to you very soon");
           // $('#bookingForm')[0].reset();
       },
       error:function(data){
       	$("body").removeClass("faderclass");
       	alert(data);
       },
   })
	});
});
/*######## End Booking-form #########*/
</script>

<?php //include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>