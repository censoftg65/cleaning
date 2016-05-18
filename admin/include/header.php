<?php

$ulevel = $_SESSION["txtUserLevel"];
/* header.php
*  This file for header section
*/

/*this include header section*/
include_once 'head.php';

?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    		<div class="col-md-12">
    			<div class="col-md-12">&nbsp;</div>
	    		<div class="col-md-6">
	    			<a href="<?= _SITE_URL?>/admin/dashboard.php">
		                <img src="<?= _SITE_URL?>/images/logo.png" alt="Unwritten Cleaning" title="Unwritten Cleaning" width="210px" border="0" />
		            </a>
		        </div>
		        <div class="col-md-4 open-up-msg">
				  	<div class="form-group">
				    	<div id="success-dialog" title="Thank you" style="display: none">
				        	Admin profile updated successfully
				    	</div>
				  	</div>
				</div>
		        <div class="col-md-2">
		        	<?php if ($ulevel == 'admin') { ?>
		            <div class="dropdown pull-right">
						<button class="btn btn-danger user-dropdown-toggle active" type="button" data-toggle="dropdown">
					  		<span class="glyphicon glyphicon-user"></span>
					  		Admin
					  		<span class="caret"></span>
					  	</button>
						<ul id="user-menu" class="dropdown-menu">
							<span id="cross"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></span>
							<li><a href="#" id="profile"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
							<li><a href="#" id="account"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Account</a></li>
							<li>
								<a href="<?= _SITE_URL?>/admin/logout.php">
									<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout
								</a>
							</li>
						</ul>
					</div>
		            <?php } ?>
		        </div>
		    </div>
	    </div>

	    <div style="display:none;" id="admin-back-color"></div>
	    <!-- Admin profile pop-up start -->
	    <div style="display:none;" class="profile-pop-up-form">
			<div class="modal-dialog">
		    	<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						<h4 id="myModalLabel" class="modal-title">Admin Profile Info</h4>
					</div>
					<form method="post" action="#" name="frmAdminProfile" id="frmAdminProfile" class="frmMenus">
						<input type="hidden" id="get_user" name="get_user" value="<?= $_SESSION['txtId']?>">
						<input type="hidden" id="form_edit_value" name="form_edit_value" value="Editprofile">
						<div class="modal-body">
							<div class="col-md-4 form-group">
			                    <label>First Name&nbsp;<span>*</span></label>
			                    <input class="form-control input-sm" type="text" id="firstName" name="firstName" value="">
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Last Name&nbsp;<span>*</span></span></label>
			                    <input class="form-control input-sm" type="text" id="lastName" name="lastName" value="">
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Phone&nbsp;<span>*</span>&nbsp;<span class="errmsg"></span></label>
			                    <input class="form-control input-sm" type="text" id="phone" name="phone" value="" maxlength="15">
			                </div>
			                <div class="col-md-12 form-group">
			                    <label>Emai-id&nbsp;<span>*</span></span></label>
			                    <input class="form-control input-sm" type="text" id="email" name="email" value="">
			                </div>
			                <div class="col-md-6 form-group">
			                    <label>Address Line 1</label>
			                    <input class="form-control input-sm" type="text" id="addressLine1" name="addressLine1" value="">
			                </div>
			                <div class="col-md-6 form-group">
			                    <label>Address Line 2</label>
			                    <input class="form-control input-sm" type="text" id="addressLine2" name="addressLine2" value="">
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Country</label>
			                    <select class="form-control input-sm" id="country" name="country">
			                      <option value="USA">USA</option>      
			                    </select>
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>State</label>
			                    <select class="form-control input-sm" id="state" name="state">
			                      <option value="">-- Select --</option>
			                      <option value="NY">New York</option>
			                      <option value="CL">California</option>
			                      <option value="AL">Alaska</option>
			                    </select>
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>City</label>
			                    <input class="form-control input-sm" type="text" id="city" name="city" value="">
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Zipcode</label>
			                    <input class="form-control input-sm" type="text" id="zipcode" name="zipcode" value="">
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Access Level</label>
			                    <select class="form-control input-sm" id="userlevel" name="userlevel">
			                      <option value="">-- Select --</option>
			                      <option value="user">User</option>
			                      <option value="admin">Admin</option>
			                    </select>
			                </div>
			                <div class="col-md-4 form-group">
			                    <label>Status&nbsp;<span>*</span></span></label>
			                    <select class="form-control input-sm" id="status" name="status">
			                      <option value="">-- Select --</option>
			                      <option value="1">Activate</option>
			                      <option value="0">Deactivate</option>
			                    </select>
			                </div>
						</div>
						<div class="clear"></div>
						<div class="modal-footer">
							<button class="btn btn-default" type="button" id="close-admin-profile">Close</button>
							<button class="btn btn-primary" type="button" id="btnAdminInfo" name="btnAdminInfo">
								<span style="display:none" id="admin_profile_loading"></span>&nbsp;&nbsp;Update  
							</button>
						</div>
					</form>
			    </div>
			</div>
		</div>

		<div style="display:none;" class="account-pop-up-form">
			<div class="modal-dialog">
		    	<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						<h4 id="myModalLabel" class="modal-title">Admin Account Setting</h4>
					</div>
					<form method="post" action="#" name="frmAdminAccount" id="frmAdminAccount" class="frmMenus">
						<input type="hidden" id="get_user" name="get_user" value="<?= $_SESSION['txtId']?>">
						<input type="hidden" id="form_edit_value" name="form_edit_value" value="Editaccount">
						<div class="modal-body">
							<div class="col-md-12 form-group">
			                    <label>Emai-id&nbsp;<span>*</span></span></label>
			                    <input class="form-control input-sm" type="text" id="emailid" name="emailid">
			                </div>
			                <div class="col-md-6 form-group">
			                    <label>Username&nbsp;<span>*</span></span></label>
			                    <input class="form-control input-sm" type="text" id="username" name="username">
			                </div>
			                <div class="col-md-6 form-group">
			                    <label>Password</label>
			                    <input class="form-control input-sm" type="password" id="password" name="password">
			                </div>
			            </div>
						<div class="clear"></div>
						<div class="modal-footer">
							<button class="btn btn-default" type="button" id="close-admin-account">Close</button>
							<button class="btn btn-primary" type="button" id="btnAdminAcc" name="btnAdminAcc">
								<span style="display:none" id="admin_account_loading"></span>&nbsp;&nbsp;Update  
							</button>
						</div>
					</form>
			    </div>
			</div>
		</div>
		<!-- Admin profile pop-up end -->

	    <div class="col-md-12 col-md-12 col-sm-12 col-xs-12	 border-partition"></div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-area">
