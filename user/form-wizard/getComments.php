<?php

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$more = $db->getParam('more');
if (!empty($more)) {
    $rate_comments = $objCommon->getCommnets($more);
    foreach ($rate_comments as $comments) {
        echo '<div class="col-md-12 form-group">';
            echo '<label><strong>Full Remarks : </strong></label><br>';
            echo $comments['txtRatingComment'];
        echo '</div>';
        
    }	
}

?>