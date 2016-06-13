<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
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

require_once (dirname(dirname(__DIR__)).'/inc/config.inc.php');
include_once (dirname(dirname(__DIR__)).'/inc/function.inc.php');
include_once 'cls_quiz.php';
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}
$db = new Config();

$_SESSION['page_title'] = "View Applications | "._PANEL_NAME." :: "._SITE_NAME;

$appl_forms = $objQuiz->getApplications("all","");

$appl_id = base64_decode($db->getParam('flag'));
$status = $db->getParam('status');
if (!empty($appl_id) && $status == 'trash') {
  $objQuiz->trashApplication($appl_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

	<?php include dirname(__DIR__).'/include/left_menu.php' ?>

	<div class="col-md-9">
		<div class="col-md-12">
			<h4><strong>VIEW APPLICATIONS</strong></h4>
			<div class="pull-left">
				<input class="form-control input-sm" size="50" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
			</div>
			<div class="pull-right">
				<button type="button" id="btnTrashAppls" id="btnTrashAppls" class="btn btn-sm  btn-danger">
					<span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
				</button>
			</div>
			<div class="col-xs-12">&nbsp;</div>
		</div>	
		<div class="col-md-12">
			<form name="frmViewApplicaion" id="frmViewApplicaion" method="post">
		        <table class="table table-bordered table-striped table-hover" id="dTable">
					<thead class="thead-default">
						<tr>
							<th>#</th>
							<th><center><input type="checkbox" name="selAllAppl" id="selAllAppl"></center></th>
							<th>Name</th>
							<th>Email ID</th>
							<th>City - Zipcode</th>
							<th>State</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
			        <tbody>
					<?php
					$i = 1;
					foreach ($appl_forms as $appli) {
					?>
			            <tr>
							<th scope="row"><?php echo $i?></th>
							<td><center><input class="check-appl" type="checkbox" name="allSelAllp[]" id="allSelAllp" value="<?= $appli['txtId']?>"></center></td>
							<td><a id="uname"><?= $appli['txtFirstName']." ".$appli['txtLastName']?></a></td>
							<td><?= $appli['txtMailingAddr']?></td>
							<td><?= ucfirst($appli['txtCity'])." - ".$appli['txtZipcode']?></td>
							<td><?= ucfirst($appli['txtState'])?></td>
							<td>
								<center>
									<a href="#"><button type="button" title="Generate User/Pass" id="create-user" value="<?php echo $appli['txtId']?>">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</button></a>
									<a href="#"><button type="button" title="View" id="view-appl" value="<?php echo $appli['txtId']?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button></a>
									<a href="#"><button type="button" title="Delete" id="delete-appl" value="<?php echo $appli['txtId']?>">
										<i class="fa fa-trash"></i>
									</button></a>
								</center>
							</td>
			            </tr>
		            <?php
		                $i++;
		            }
		            if (empty($appl_forms)) {
		            ?>
			            <tr class="no-record">
			              <td colspan="10">Sorry..! No records found.</td>
			            </tr>
		            <?php } ?>
			        </tbody>
		        </table>
		    </form>
		</div>
	</div>

	<?php include dirname(__DIR__).'/include/footer.php' ?>	

	<!-- View Question Popup-->
	<div class="modal fade" id="view-applications" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="step1_previewLabel">User Application Preview</h4>
				</div>
				<div id="view_appl" class="modal-body"></div>
				<div class="clear">&nbsp;</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End-->

<script type="text/javascript">
$(document).ready(function() {
  $('#dTable').DataTable( {
      "pagingType": "numbers",
      "ordering": false,
      "info":     false,
      "bFilter": false,
      "bInfo": false
  });
});
</script>