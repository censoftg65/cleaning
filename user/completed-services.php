<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
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
require_once dirname(__DIR__).'/inc/function.inc.php';

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "New Booking | "._SITE_NAME;
$db = new Config(); 

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
    	<div class="container contentMain">
            <div class="row">
            	
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <h1 class="compHead">Completed Services</h1>
            
                <div class="col-sm-9 contentPart compServ">
                    <table class="ratedTable" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <th>Name of service</th>
                                <th>Extra Services</th>
                                <th>Date of Service</th>
                                <th>Hours</th>
                                <th>Price</th>
                                <th>Rating Status</th>
                            </tr>
                            <tr>
                                <td>3 beds ,bath1-2,</td>
                                <td>Balcony</td>
                                <td>03-01-2016</td>
                                <td>2.5</td>
                                <td>$90</td>
                                <td><a href="#" class="rated">Rated</a></td>
                            </tr>
                            <tr>
                                <td>2 beds ,bath1-2</td>
                                <td>Inside Refrigerator</td>
                                <td>11-01-2016</td>
                                <td>4.5</td>
                                <td>$90</td>
                                <td><a href="#" class="rateUs">Rate Us</a></td>
                            </tr>
                            <tr>
                                <td>3 beds ,bath1-3,</td>
                                <td>Inside Oven</td>
                                <td>22-01-2016</td>
                                <td>6.5</td>
                                <td>$15</td>
                                <td><a href="#" class="rated">Rated</a></td>
                            </tr>
                            <tr>
                                <td>3 beds ,bath1-3</td>
                                <td>Inside Cabiante</td>
                                <td>22-01-2016</td>
                                <td>6.5</td>
                                <td>$270</td>
                                <td><a href="#" class="rated">Rated</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>
