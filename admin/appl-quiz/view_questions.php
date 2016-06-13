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

$_SESSION['page_title'] = "View Quiz Question | "._PANEL_NAME." :: "._SITE_NAME;

$quiz_coll = $objQuiz->getQuizDetails("all","");

$que_id = base64_decode($db->getParam('flag'));
$status = $db->getParam('status');
if (!empty($que_id) && $status == 'disable') {
  $objQuiz->disableQuestion($que_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
} elseif (!empty($que_id) && $status == 'enable') {
  $objQuiz->enableQuestion($que_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
} elseif (!empty($que_id) && $status == 'delete') {
  $objQuiz->deleteQuestion($que_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

	<?php include dirname(__DIR__).'/include/left_menu.php' ?>

	<div class="col-md-9">
		<div class="col-md-12">
			<h4><strong>VIEW QUIZ QUESTIONS</strong></h4>
			<div class="pull-left">
				<input class="form-control input-sm" size="50" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
			</div>
			<div class="pull-right">
				<button type="button" id="btnTrashQue" id="btnTrashQue" class="btn btn-sm btn-danger">
					<span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
				</button>
			</div>
			<div class="col-xs-12">&nbsp;</div>
		</div>	
		<div class="col-md-12">
			<form name="frmViewQuestion" id="frmViewQuestion" method="post">
		        <table class="table table-bordered table-striped table-hover" id="dTable">
					<thead class="thead-default">
						<tr>
							<th>#</th>
							<th><center><input type="checkbox" name="selAllQue" id="selAllQue" value=""></center></th>
							<th>Questions</th>
							<th>Status</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
			        <tbody>
					<?php
					$i = 1;
					foreach ($quiz_coll as $quiz) {
						$class = ($quiz['txtStatus'] == '0') ? "warning" : "";
					?>
			            <tr class="<?= $class?>">
							<th scope="row"><?php echo $i?></th>
							<td><center><input class="check-que" type="checkbox" name="allSelQue[]" id="allSelQue" value="<?= $quiz['txtId']?>"></center></td>
							<td><a><?= $quiz['txtQuestion']?></a></td>
							<td><?= $active = ($quiz['txtStatus'] == 1) ? "Enabled" : "Disabled";?></td>
							<td>
								<center>
									<a href="#"><button type="button" title="View" id="viewQue" value="<?= $quiz['txtId']?>">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button></a>
									<a href="edit_questions.php?queid=<?php echo base64_encode($quiz['txtId'])?>">
										<button type="button" title="Edit" id="editQue">
											<i class="fa fa-pencil-square" aria-hidden="true"></i>
										</button>
									</a>
									<?php if ($quiz['txtStatus'] == 1) { ?>
									<a href="#"><button type="button" title="Disable" id="disableQue" value="<?= $quiz['txtId']?>">
										<i class="fa fa-times-circle" aria-hidden="true"></i>
									</button></a>
									<?php } else { ?>
									<a href="#"><button type="button" title="Enable" id="enableQue" value="<?= $quiz['txtId']?>">
										<i class="fa fa-check-square" aria-hidden="true"></i>
									</button></a>
									<a href="#"><button type="button" title="Delete" id="deleteQue" value="<?= $quiz['txtId']?>">
										<i class="fa fa-trash"></i>
									</button></a>	
									<?php } ?>	
								</center>
							</td>
			            </tr>
		            <?php
		                $i++;
		            }
		            if (empty($quiz_coll)) {
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
	<div class="modal fade" id="view-question" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="step1_previewLabel">Question Preview</h4>
				</div>
				<div id="view_que" class="modal-body"></div>
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