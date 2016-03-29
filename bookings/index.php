<?php
/*index.php
* This file for book now form
*/
?>
<?php include_once(dirname(dirname(__FILE__)).'/inc/config.inc.php');?>
<?php include(INCLUDE_PATH.'/header.php');?>

<link type="text/css" rel="stylesheet" href="http://localhost/www/materialadmin/assets/css/theme-default/bootstrap.css?1422792965" />
<link type="text/css" rel="stylesheet" href="http://localhost/www/materialadmin/assets/css/theme-default/materialadmin.css?1425466319" />
<link type="text/css" rel="stylesheet" href="http://localhost/www/materialadmin/assets/css/theme-default/font-awesome.min.css?1422529194" />
<link type="text/css" rel="stylesheet" href="http://localhost/www/materialadmin/assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
<link type="text/css" rel="stylesheet" href="http://localhost/www/materialadmin/assets/css/theme-default/libs/wizard/wizard.css?1425466601" />

<!-- BEGIN VALIDATION FORM WIZARD -->
<div class="complete-booking-form">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body ">
				<div id="rootwizard2" class="form-wizard form-wizard-horizontal">
					<form class="form-horizontal form-validation" role="form" method="post">
						<div class="form-wizard-nav">
							<div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
							<ul class="nav nav-justified">
								<li class="active"><a href="#step1" id="step1_profile" data-toggle="tab"><span class="step">1</span> <span class="title">PERSONAL</span></a></li>
								<li><a href="#step2" id="step2_booking" data-toggle="tab"><span class="step">2</span> <span class="title">BOOKING</span></a></li>
								<li><a href="#step3" data-toggle="tab"><span class="step">3</span> <span class="title">CONFIRM</span></a></li>
							</ul>
						</div><!--end .form-wizard-nav -->
						<div class="tab-content clearfix">
							<div class="tab-pane active" id="step1">
								<br/><br/>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="firstname" class="col-sm-4 control-label">Firstname</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="firstname" name="firstname" required="">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="lastname" class="col-sm-4 control-label">Lastname</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="lastname" name="lastname" required="">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="addressLine1" class="col-sm-4 control-label">Address Line1</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="addressLine1" name="addressLine1" required="">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="addressLine2" class="col-sm-4 control-label">Address Line2</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="addressLine2" name="addressLine2" required="">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="country" class="col-sm-4 control-label">Country</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="country"  name="country"  required="">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="city" class="col-sm-4 control-label">City</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="city" name="city" required="">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="state" class="col-sm-4 control-label">State/Provience</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="state" name="state" required="">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="zipcode" class="col-sm-4 control-label">Zip code</label>
											<div class="col-sm-8">
												<select id="zipcode" name="zipcode" class="form-control" required>
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
											<label for="emailId" class="col-sm-4 control-label">Email Id</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="emailId" name="emailId" required="">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="phone" class="col-sm-4 control-label">Phone</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="phone" name="phone" required="">
											</div>
										</div>
									</div>
								</div>

								<br/><br/>
								<div class="card-actionbar">
									<div class="card-actionbar-row">
										<button type="button" class="next-step1 btn btn-primary">Preview</button>
									</div>
								</div>
							</div><!--end #step1 -->

							<div class="tab-pane" id="step2">
								<br/><br/>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="bedroom" class="col-sm-4 control-label">Choose Bedroom</label>
											<div class="col-sm-8">
												<select id="bedroom" name="bedroom" class="form-control" required>
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
											<label for="bathroom" class="col-sm-4 control-label">Choose Bathroom</label>
											<div class="col-sm-8">
												<select id="bathroom" name="bathroom" class="form-control" required>
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
									<label for="bedroom" class="col-sm-4 control-label"><h3>Extra Choose Below</h3></label>
								</div>


								<div class="form-group">
									<div class="col-sm-2"></div>
									<div class="col-sm-5">
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option1"><span>1</span>
										</label>
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option2"><span>2</span>
										</label>
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option3"><span>3</span>
										</label>
									</div>
									<div class="col-sm-5">
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option1"><span>1</span>
										</label>
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option2"><span>2</span>
										</label>
										<label class="checkbox-inline checkbox-styled">
											<input type="checkbox" value="option3"><span>3</span>
										</label>
									</div>
								</div>	


								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="service_date" class="col-sm-4 control-label">Service Date</label>
											<div class="col-sm-8">
												<input type="text" name="service_date" id="service_date" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="service_time" class="col-sm-4 control-label">Service Time</label>
											<div class="col-sm-8">
												<input type="text" name="service_time" id="service_time" class="form-control" required>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="service_hours" class="col-sm-2 control-label">Choose No. of Hours</label>
									<div class="col-sm-10">
										<select id="service_hours" name="service_hours" class="form-control" required>
											<option value="">&nbsp;</option>
											<option value="30">30</option>
											<option value="40">40</option>
											<option value="50">50</option>
											<option value="60">60</option>
											<option value="70">70</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="service_tip" class="col-sm-2 control-label">Add Tip</label>
									<div class="col-sm-10">
										<input type="text" name="service_tip" id="service_tip" class="form-control" data-rule-minlength="2" required>
									</div>
								</div>

								<div class="form-group">
									<label for="firstname" class="col-sm-2 control-label">Total</label>
									<div class="col-sm-10">
										<input type="text" name="total" id="total" class="form-control" required>
									</div>
								</div>

								<br/><br/>
								<div class="card-actionbar">
									<div class="card-actionbar-row">
										<button type="button" class="next-step2 btn btn-primary">Preview</button>
									</div>
								</div>

							</div><!--end #step2 -->

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

<!-- END VALIDATION FORM WIZARD -->


<script>
$(document).ready(function(){

	$(".next-step1").click(function(){
		if($(".form-horizontal").valid()){
			var formdata = $(".form-horizontal").serializeArray();
			var step1_model_preview = '';
			$.each(formdata, function(index,field ) {
				if(field.value){
					index = index + 1;

					step1_model_preview += '<div class="col-sm-6"><div class="form-group">';
					step1_model_preview += '<label for="country" class="col-sm-6 control-label">'+field.name+' : </label>';
					step1_model_preview += '<div class="col-sm-6">'+field.value+'</div></div></div>';
				}
			});

			$(".modal-body").html(step1_model_preview);
			$("#step1-preview").modal('show');
		};
	})

	$(".next-step2").click(function(){
		if($(".form-horizontal").valid()){
			$("#step2-preview").modal('show');
		}
	})

	$(".gotoStep2").click(function(){
		$("#step2_booking").trigger('click');
	})
})
</script>