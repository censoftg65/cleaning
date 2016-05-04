<?php  
/* 
*  This file for footer-upper grid section
*/

/*this include footer-upper grid section*/
$contact_detail = $objPage->getContactDetails();
?>  

<div class="footer">
    <div class="footerInner cmnWidth">
        <div class="footerLft">
            <?php 
            foreach ($contact_detail as $contact) {
                echo "<h3>".$contact['txtTitle']."</h3>";
                echo $contact['txtContactDetails'];
            } 
            ?>
        </div>
        <div class="footerMid">
            <ul>
                <li><a href="#">Booking Form</a></li>
                <li><a href="#">Cleaning Professional</a></li>                
            </ul>
        </div>
        <div class="footerRight">
            <h3>Follow Us On</h3>
            <div class="socialBox">
            <a href="#" class="link"></a>
            <a href="#" class="twit"></a>
            <a href="#" class="fb"></a>
        </div>
        </div>
        <div class="clear"></div>
    </div>
</div>