<?php
/*Booknow.php
* This file for book now form
*/
?>
<?php include_once(dirname(dirname(__FILE__)).'/inc/config.inc.php');?>
<?php include(INCLUDE_PATH.'/header.php');?>
<?php
if(isset($_POST['btnSubmit'])){
	print_r($_POST);
}
?>
<a href="#" >Book Now</a>
<div class="col-lg-12">
	<form class="form-validate form-horizontal" method="post">
		<div class="card">
			<div class="card-head style-primary">
				<header>Create an account</header>
			</div>
			<div class="card-body">
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
			</div><!--end .card-body -->

			<div class="card-body">
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
								<input type="text" class="form-control" id="addressLine1" name="addressLine1" required="">
							</div>
						</div>
					</div>
				</div>
			</div><!--end .card-body -->

			<div class="card-body">
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
			</div><!--end .card-body -->

			<div class="card-body">
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
							<label for="zipCode" class="col-sm-4 control-label">Zip code</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="zipCode" name="zipCode" required="">
							</div>
						</div>
					</div>
				</div>
			</div><!--end .card-body -->

			<div class="card-body">
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
			</div><!--end .card-body -->

			<div class="card-actionbar">
				<div class="card-actionbar-row">
					<button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btnSubmit">Create Account</button>
				</div>
			<div class="card-actionbar-row">
					<button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btnPreview">Preview</button>
				</div>
			</div>
		</div><!--end .card -->
	</form>
</div><!--end .col -->




