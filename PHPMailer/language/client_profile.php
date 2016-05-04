<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
    header("location:../index.php");
}

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$utype = $_SESSION["txtUserType"];
$ulevel= $_SESSION["txtUserLevel"];

$pid    = base64_decode($_GET["pid"]);
$utype  = base64_decode($_GET["utype"]);

include '../include/connection.php';
include '../include/config.php';
include 'cls_common.php';
$db = new Config();
$objCommon = new Common();

if ($pid) {
    $collection = $objCommon->getEditDetails("edit_client",$pid);
    $client = $collection[0];

    $txtCustId          = $client["txtCustId"];
    $txtProPic          = $client["txtProPic"];
    $txtFirstName       = $client["txtFirstName"];
    $txtMiddleName      = $client["txtMiddleName"];
    $txtLastName        = $client["txtLastName"];
    $txtGender          = $client["txtGender"];
    $txtDOB             = $client["txtDOB"];
    $txtEmail           = $client["txtEmail"];
    $txtStreetNo        = $client["txtStreetNo"];
    $txtCity            = $client["txtCity"];
    $txtState           = $client["txtState"];
    $txtLand            = $client["txtLand"];
    $txtPostalCode      = $client["txtPostalCode"];
    $txtPhone           = $client["txtPhone"];
    $txtOtherNum        = $client["txtOtherNum"];
    $txtBillStreet      = $client["txtBillingStreet"];
    $txtBillCity        = $client["txtBillingCity"];
    $txtBillState       = $client["txtBillingState"];
    $txtBillLand        = $client["txtBillingLand"];
    $txtBillPostalCode  = $client["txtBillingPostalCode"];
    $txtBillAddSame     = $client["txtBillingAddSame"];
}
if (isset($_POST["btnUpdate"])) {
    $dirName = "../uploads/";
    $images    = $_FILES['txtProPic']['name'];
    $file_name = time()."_".$images;
    $file_temp = $_FILES['txtProPic']['tmp_name'];
    $file_size = $_FILES['txtProPic']['size'];
    move_uploaded_file($file_temp, $dirName.$file_name);
    $profileImg= "http://centuryoutsourcing.com/mind-online/uploads/".$file_name;
    
    if ($images != "") : $arr_client["txtProPic"]  = $profileImg;
    else : $arr_client["txtProPic"]  = $txtProPic;
    endif;
    $arr_client["txtFirstName"]       = $db->getParam("txtFirstName");
    $arr_client["txtMiddleName"]      = $db->getParam("txtMiddleName");
    $arr_client["txtLastName"]        = $db->getParam("txtLastName");
    $arr_client["txtGender"]          = $db->getParam("txtGender");
    $arr_client["txtDOB"]             = $db->getParam("txtDOB");
    $arr_client["txtEmail"]           = $db->getParam("txtEmail");
    $arr_client["txtStreetNo"]        = $db->getParam("txtStreetNo");
    $arr_client["txtCity"]            = $db->getParam("txtCity");
    $arr_client["txtState"]           = $db->getParam("txtState");
    $arr_client["txtLand"]            = $db->getParam("txtLand");
    $arr_client["txtPostalCode"]      = $db->getParam("txtPostalCode");
    $arr_client["txtPhone"]           = $db->getParam("txtPhone");
    $arr_client["txtOtherNum"]        = $db->getParam("txtOtherNum");
    $arr_client["txtBillingStreet"]   = $db->getParam("txtBillingStreet");
    $arr_client["txtBillingCity"]     = $db->getParam("txtBillingCity");
    $arr_client["txtBillingState"]    = $db->getParam("txtBillingState");
    $arr_client["txtBillingLand"]     = $db->getParam("txtBillingLand");
    $arr_client["txtBillingPostalCode"]= $db->getParam("txtBillingPostalCode");
    $arr_client["txtBillAddSame"]     = $db->getParam("txtBillingAddSame");
    
    $objCommon->setClietDetails($arr_client);
    $objCommon->updateClientDetail($pid);
    header("Location:view_clients.php?success=".base64_decode("update"));
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Staff Profile | Super Admin</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,800,700italic,700,800italic" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
<link href="../css/global.css" rel="stylesheet" type="text/css"/>
</head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
    $("#txtDOB").datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeMonth: true,
                                changeYear: true,
                                yearRange: '-40:-15'
                            });
});
$(document).ready(function () {
  $("#txtPostalCode").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  })
  $("#txtPhoneNum").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  })
  $("#txtOtherNum").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  })
  $("#txtBillingPostalCode").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  })
}); 
</script>

<body>
<div class="dashbord">
    <?php include 'common/header.php';?>
    
    <?php include 'common/mainmenu.php';?>
    
    <div class="grey-part"></div>
    <div class="com-wid mid-sec cl-reg staffprofile">
        <h1>Staff Profile</h1>        
        <div class="stf-prof">
            <form name="frmClientProfile" id="frmClientProfile" method="post" enctype="multipart/form-data" onsubmit="return validateClientProfile();">
                <div class="prof-pic">
                    <?php if (!empty($txtProPic)) {?>
                    <img src="<?php echo $txtProPic?>" alt="Profile Picture" title="Profile Picture" border="0" />
                    <?php } else { ?>
                    <img src="../images/profile-watermark.jpg" alt="Profile Picture" title="Profile Picture" />
                    <?php } ?>
                    <div class="btnovrlp">
                        Picture Selection<input multiple type="file" name="txtProPic" id="txtProPic" class="overlpinput">
                    </div>
                </div>
                <div class="prof-form">
                    <h4>CUSTOMER ID : <a href="#"><?php echo $txtCustId?></a></h4>
                    <br>
                    <!-- Personal Info Start -->
                    <h2>Personal Info</h2>
                    <input type="text" name="txtFirstName" id="txtFirstName" value="<?php echo $txtFirstName?>" placeholder="First Name">
                    <input type="text" name="txtMiddleName" id="txtMiddleName" value="<?php echo $txtMiddleName?>" placeholder="Middle Name">
                    <input type="text" name="txtLastName" id="txtLastName" value="<?php echo $txtLastName?>" placeholder="Last Name">
                    <select name="txtGender" id="txtGender" class="sexinpt">
                        <?php if ($txtGender == 'M') { ?>
                        <option value="M" selected="">Male</option>
                        <option value="F">Female</option>
                        <?php } elseif ($txtGender == 'F') { ?>
                        <option value="M">Male</option>
                        <option value="F" selected="">Female</option>
                        <?php } else { ?>
                        <option value="0">Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <?php } ?>
                    </select>
                    <input type="text" name="txtDOB" id="txtDOB" value="<?php echo $txtDOB?>" placeholder="Date Of Birth" class="dobinpt">
                    <input type="text" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail?>" readonly="readonly" placeholder="E-mail">
                    <!-- Personal Info End -->

                    <!-- Customer Info Start -->
                    <h2 class="road">Customer Info</h2>
                    <input type="text" name="txtStreetNo" id="txtStreetNo" value="<?php echo $txtStreetNo?>" placeholder="Street">
                    <input type="text" name="txtCity" id="txtCity" value="<?php echo $txtCity?>" placeholder="City" class="cityinpt">
                    <select name="txtState" id="txtState" class="stateinpt">
                        <option value="-1">State</option>
                        <option value="0">------------</option>
                        <option value="Germany">Germany</option>
                    </select>
                    <select name="txtLand" id="txtLand" class="plcinpt">
                        <option value="-1">Land</option>
                        <option value="0">------------</option>
                        <option value="Germany">Germany</option>
                    </select>
                    <input type="text" name="txtPostalCode" id="txtPostalCode" value="<?php echo $txtPostalCode?>" placeholder="Postal Code" class="postcd" maxlength="6">
                    <input type="text" name="txtPhone" id="txtPhone" value="<?php echo $txtPhone?>" placeholder="Phone Number" maxlength="12">
                    <input type="text" name="txtOtherNum" id="txtOtherNum" value="<?php echo $txtOtherNum?>" placeholder="Alternate Number" maxlength="12">
                    <!-- Customer Info End -->

                    <!-- Billing Address Info Start -->
                    <h2 class="road">Billing Info</h2>
                    <input type="text" name="txtBillingStreet" id="txtBillingStreet" value="<?php echo $txtBillStreet?>" placeholder="Billing Street">
                    <input type="text" name="txtBillingCity" id="txtBillingCity" value="<?php echo $txtBillCity?>" placeholder="Billing City" class="cityinpt">
                    <select name="txtBillingState" id="txtBillingState" class="stateinpt">
                        <option value="-1">State</option>
                        <option value="0">------------</option>
                        <option value="Germany">Germany</option>
                    </select>
                    <select name="txtBillingLand" id="txtBillingLand" class="billplcinpt">
                        <option value="-1">Land</option>
                        <option value="0">------------</option>
                        <option value="Germany">Germany</option>
                    </select>
                    <input type="text" name="txtBillingPostalCode" id="txtBillingPostalCode" value="<?php echo $txtBillPostalCode?>" placeholder="Billing Postal Code" class="billpostcd" maxlength="6">
                    <!-- Billing Address Info End -->
                    <div class="clear"></div>
                    <input type="submit" name="btnUpdate" id="btnUpdate" value="Save" class="submit">
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </div>

    <?php include 'common/footer.php';?>

</div>

<!-- Custome Script Adding-->
<script type="text/javascript" src="../js/script_common.js"></script>

</body>
</html>
