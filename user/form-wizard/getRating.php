<?php

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$book_id = $db->getParam('book_id');
$rate_id = $db->getParam('rate_id');

if (!empty($book_id)) {
    echo '<div class="col-md-12 form-group">';
        echo '<label><strong>Service Provider&nbsp;<span class="err">*</span></strong></label>';
        echo '<input class="form-control input-md" type="text" id="txtServiceProvider" name="txtServiceProvider" value="">';
    echo '</div>';
    echo '<div class="col-md-12 form-group">';
        echo '<label><strong>Remarks</strong></label>';
        echo '<textarea class="form-control input-md" type="text" id="txtRatingComment" name="txtRatingComment"></textarea>';
    echo '</div>';
    echo '<div class="col-md-12 form-group">';
        echo '<label><strong>Rating&nbsp;<span class="err">*</span></strong></label>';
        echo '<input id="rating-input" value="" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">';
    echo '</div>';
} elseif (!empty($rate_id)) {
    $coll_serv_rate = $objCommon->getServiceRat($rate_id);
    foreach ($coll_serv_rate as $rating) {
        echo '<div class="col-md-12 form-group">';
            echo '<label><strong>Service Provider</strong></label>';
            echo '<input class="form-control input-md" type="text" id="txtServiceProvider" name="txtServiceProvider" value="'.$rating['txtServiceProvider'].'">';
        echo '</div>';
        echo '<div class="col-md-12 form-group">';
            echo '<label><strong>Remarks</strong></label>';
            echo '<textarea class="form-control input-md" type="text" id="txtRatingComment" name="txtRatingComment">'.$rating['txtRatingComment'].'</textarea>';
        echo '</div>';
        echo '<div class="col-md-12 form-group">';
            echo '<label><strong>Rating</strong></label>';
            echo '<input id="rating-input-edit" name="rating-input-edit" value="'.$rating['txtRating'].'" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">';
        echo '</div>';
    }	
}

?>
<script src="<?= _BOOTSTRAP_URL?>/js/star-rating.js" type="text/javascript"></script>