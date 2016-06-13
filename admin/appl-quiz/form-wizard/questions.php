<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_quiz.php';
$db = new Config();

$queId = $db->getParam('queId');
$sel_chk = $db->getParam('allSelQue');
$sel_cnt = count($db->getParam('allSelQue'));
$flag = $db->getParam('flag');

if (!empty($queId) && $flag == 'view') {
    $quiz_detail = $objQuiz->getQuestionPreview($queId);
    $quiz = $quiz_detail[0];

	echo '<div class="col-md-12">';
        echo '<label><b>'.$quiz["txtQuestion"].'</b></label>';
    echo '</div>';
	echo '<div class="col-md-12">&nbsp;</div>';
    echo '<div class="col-md-12">';
        echo '<label>Answer : <b>'.$quiz["txtAnswer"].'</b></label>';
    echo '</div>';
    echo '<div class="col-md-12">&nbsp;</div>';
	echo '<div class="col-md-12">';
		echo '<label><b>Options</b></label>';
		echo '<div>&star;&nbsp;'.$quiz["txtOptionOne"].'</div>';
		echo '<div>&star;&nbsp;'.$quiz["txtOptionTwo"].'</div>';
		echo '<div>&star;&nbsp;'.$quiz["txtOptionThree"].'</div>';
        if (!empty($quiz["txtOptionFour"])) {
            echo '<div>&star;&nbsp;'.$quiz["txtOptionFour"].'</div>';
        } else { }
	echo '</div>';	

} elseif (isset($sel_chk) && ($flag == "multitrash")) {
	for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $sql_quiz = $db->query("DELETE FROM "._DB_PREFIX."quiz WHERE txtId = '$id';");
        $sql_quiz_ans = $db->query("DELETE FROM "._DB_PREFIX."quiz_ans WHERE txtQuizId = '$id';");
    }
}

$db->freeResult();
$db->close();

?>