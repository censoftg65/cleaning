<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_quiz.php';
$db = new Config();

$queid = $db->getParam("hidQueId");
$editval = $db->getParam("hidEditVal");
$arr_quiz['txtQuestion'] 	= addslashes($db->getParam('txtQuestion'));
$arr_quiz['txtAnswer'] 		= addslashes($db->getParam('txtAnswer'));
$arr_quiz['txtOptionOne'] 	= addslashes($db->getParam('txtOptionOne'));
$arr_quiz['txtOptionTwo'] 	= addslashes($db->getParam('txtOptionTwo'));
$arr_quiz['txtOptionThree']	= addslashes($db->getParam('txtOptionThree'));
$arr_quiz['txtOptionFour'] 	= addslashes($db->getParam('txtOptionFour'));

if (!empty($editval) && ($editval == "Edit_record")) {
	if ((strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionThree'])) || (strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'one');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionThree'])) || (strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'two');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'three');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionThree']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'four');
		$output = json_encode($data);
		echo $output;	
	} else {
		$objQuiz->setDetails($arr_quiz);
		$objQuiz->updateQuestion($queid);
		$objQuiz->updateQueAns($queid);
		$data = array('message' => "Question edited successfully.", 'success' => 'edit');
		$output = json_encode($data);
		echo $output;
	}
} else {
	if ((strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionThree'])) || (strtolower($arr_quiz['txtOptionOne']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'one');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionThree'])) || (strtolower($arr_quiz['txtOptionTwo']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'two');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionThree']) == strtolower($arr_quiz['txtOptionFour']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'three');
		$output = json_encode($data);
		echo $output;	
	} elseif ((strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionOne'])) || (strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionTwo'])) || (strtolower($arr_quiz['txtOptionFour']) == strtolower($arr_quiz['txtOptionThree']))) {
		$data = array('message' => "Options can not be same.", 'success' => 'four');
		$output = json_encode($data);
		echo $output;	
	} else {
		$setDetails = $objQuiz->setDetails($arr_quiz);
		$queId = $objQuiz->insertQuestion();
		$exqueId = $objQuiz->insertQueAns($queId);
		$data = array('message' => "Question added successfully.", 'success' => 'add');
		$output = json_encode($data);
		echo $output;
	}
}

$db->freeResult();
$db->close();

?>