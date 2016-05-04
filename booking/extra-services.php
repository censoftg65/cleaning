 <?php
/*extra-services.php
* To Add extra services
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
<?php include_once(dirname(__DIR__).'/inc/config.inc.php');?>
<?php include_once(dirname(__DIR__).'/pages/cls_pages.php');?>
<?php $_SESSION['page_title'] = "Add Extra Services";?>
<?php include_once(_INCLUDE_PATH.'/header.php');?>
<link href="<?= _CSS_URL ?>/booking-awesome.css" rel="stylesheet">
<body class="inner">
	<div id="wrapper">
		<?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
		<div style="margin-top:160px !important;"></div>
		<!-- ============================START FROM HERE================================== -->
		<?php
		echo '<pre>';
		print_r($_POST);
		if(isset($_POST['btnAddService'])){
			$data = '';
			$query = "INSERT INTO `wc_cleaning_extra_services`(`txtBookingServiceId`, `txtServiceName`) VALUES (";
				foreach ($_POST as $value) {
					if($value){
						$data .= "'$value',";
					}
				}
				$query .= substr($data, 0, -1);
				$query .= ")";
 				echo $db->query();
}




?>

<form class="form-validate form-horizontal"  novalidate="novalidate" method="post">
	<div class="card">
		<div class="card-body">
			<div class="form-group">
				<label for="txtServiceName" class="col-sm-2 control-label">Service Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="txtServiceName" id="txtServiceName" required="" >
				</div>
			</div>

			<div class="form-group">
				<label for="txtServicePrice" class="col-sm-2 control-label">Service Price</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="txtServicePrice" id="txtServicePrice" required="" data-rule-number="true"/>
				</div>
			</div>

		</div><!--end .card-body -->
		<div class="card-actionbar">
			<div class="card-actionbar-row">
				<button class="btn btn-primary btnAddService" name="btnAddService" type="submit">Validate</button>
			</div>
		</div><!--end .card-actionbar -->
	</div><!--end .card -->
</form>

