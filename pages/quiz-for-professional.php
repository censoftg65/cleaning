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

$page_entity = "quiz";
$_SESSION['page_title'] = ucfirst($page_entity)." | "._SITE_NAME;

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

if(empty($agree_terms)) {
	header("location:clean-prof-appl.php");
}

$quiz_coll = $objPage->getQuiz();
global $count;

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
	        			<h2><?= strtoupper('quiz')?></h2>
						
						<div class="col-md-12"><hr></div>
						
						<div class="col-md-12">
			            	<div class="alert alert-danger" role="alert" style="display:none"></div>
							<form role="form" id="frm-Empquiz" name="frm-Empquiz" method="post" action="clean-prof-appl.php">
			                    <div class="row"><div class="col-sm-6">&nbsp;</div></div>
			                	
			                    <div class="row">
			                    	<?php 
			                    	$i = 1;
			                    	$count = 0;
			                    	foreach ($quiz_coll as $quiz) { 
			                    	?>
			                    	<div class="col-sm-12">
			                    		<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">
													<strong><?= $i?>)&nbsp;<?= $quiz["txtQuestion"]?></strong>
												</h3>
											</div>
											<div class="panel-body">
												<?php if ($quiz["txtOptionThree"] == "") { ?>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionOne"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionOne"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionTwo"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionTwo"]?></label>
												</div>
												<?php } elseif ($quiz["txtOptionFour"] == "") { ?>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionOne"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionOne"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionTwo"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionTwo"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionThree"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionThree"]?></label>
												</div>
												<?php } else { ?>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionOne"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionOne"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionTwo"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionTwo"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionThree"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionThree"]?></label>
												</div>
												<div>
													<label class="radio-inline"><input type="radio" class="answer" id="txtAnswer<?= $i?>" name="txtAnswer<?= $quiz["txtQuizId"]?>" value="<?= $quiz["txtOptionFour"]?>" data-queid="<?= $quiz["txtQuizId"]?>">&nbsp;<?= $quiz["txtOptionFour"]?></label>
												</div>	
												<?php } ?>	
											</div>
										</div>
			                    	</div>
			                    	<?php 
			                    		$i++;
			                    		$count++;
			                    	} 
			                    	?>
			                    </div>

			                	<div class="row">
			                        <div class="col-sm-6">
					                    <div class="form-group">
					                        <a>
					                        	<button type="submit" class="btn btn-info" id="btnPreAppl" name="btnPreAppl">
						                            <span style="display:none" id="reg_user_loading"></span>&nbsp;<b>Application Form</b>
						                        </button>
					                        </a>
					                    </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="form-group pull-right">
					                        <button type="button" class="btn btn-primary" id="btnSubQuiz" name="btnSubQuiz">
					                            <span style="display:none" id="applform_loading"></span>&nbsp;<b>Submit Quiz</b>
					                        </button>
					                    </div>
					                </div>    
			                    </div>
			                    <div>
			                    	<input type="hidden" id="txtFirstName" name="txtFirstName" value="<?= $fname?>">
			                    	<input type="hidden" id="txtLastName" name="txtLastName" value="<?= $lname?>">
			                    	<input type="hidden" id="txtMailingAddr" name="txtMailingAddr" value="<?= $addr?>">
			                    	<input type="hidden" id="txtAppartment" name="txtAppartment" value="<?= $aptmnt?>">
			                    	<input type="hidden" id="txtCity" name="txtCity" value="<?= $city?>">
			                    	<input type="hidden" id="txtState" name="txtState" value="<?= $state?>">
			                    	<input type="hidden" id="txtZipcode" name="txtZipcode" value="<?= $zipcode?>">
			                    	<input type="hidden" id="txtWorkExp" name="txtWorkExp" value="<?= $expe?>">
			                    	<input type="hidden" id="txtPaidCleaning" name="txtPaidCleaning" value="<?= $paidcleaning?>">
			                    	<input type="hidden" id="txtHearAbout" name="txtHearAbout" value="<?= $knowabot?>">
			                    	<input type="hidden" id="txtEligibleToWork" name="txtEligibleToWork" value="<?= $eligible?>">
			                    	<input type="hidden" id="txtTshirtPreference" name="txtTshirtPreference" value="<?= $tshirt_preference?>">
			                    	<input type="hidden" id="txtTshirtSize" name="txtTshirtSize" value="<?= $tshirt_size?>">
			                    	<input type="hidden" id="txtAgreeTerms" name="txtAgreeTerms" value="<?= $agree_terms?>">
			                    	<input type="hidden" id="hidQueCount" name="hidQueCount" value="<?= $count?>"></input>
			                    </div>
			                </form>
						</div>
					</div>
				</div>
			</div>
		</div>			
    </div>

    <div style="display:none" id="back-color"></div>
    <!-- Application Success Meaasgae -->
    <div style="display:none" class="modal-dialog" id="success-preview">
        <div class="modal-content">
            <div class="modal-body msg-body"></div>
        </div>
    </div>
    <!-- End-->
	
	<?php include dirname(__DIR__).'/includes/footer-upper-grid.php' ?>

<?php include dirname(__DIR__).'/includes/footer.php'; ?>