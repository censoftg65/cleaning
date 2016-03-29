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

include '../include/connection.php';
include '../include/config.php';
include 'cls_common.php';
$db = new Config();
$objCommon = new Common();
$collection = $objCommon->getClientDetails();

$delid = base64_decode($_GET["del_id"]);
if ($delid) {
  $sqlDelete = "UPDATE tbl_clients SET txtStatus = '0' WHERE txtId = '$delid'";
  mysql_query($sqlDelete);
  header("Location:".basename($_SERVER['PHP_SELF'])."?success=".base64_decode("one"));
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Admin Data | Super Admin</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,800,700italic,700,800italic" rel="stylesheet" type="text/css" />
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/global.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
  /*---- Search Functionality For Trainer List ----*/
  $("#txtSearch").keyup(function () {
    var value = this.value.toLowerCase().trim();
    $("table tr").each(function (index) {
      if (!index) return;
      $(this).find("td").each(function () {
        var id = $(this).text().toLowerCase().trim();
        var not_found = (id.indexOf(value) == -1);
        $(this).closest('tr').toggle(!not_found);
        return not_found;
      });
    });
  });
});
</script>

<body>
<div class="dashbord">
     <?php include 'common/header.php';?>

    <!-- Main Menu Start -->
    <?php include 'common/mainmenu.php';?>
    <!-- Main Menu End -->
    <div class="grey-part"></div>
    
    <?php
    if ($_GET["success"] == base64_decode("one"))
      echo "<div class='msg-center'><span class='success'>User has been deleted successfully..!</span></div>";
    ?>

    <form class="registerfrom" name="frmNewClient" id="frmNewClient">
        <div class="com-wid mid-sec">
            <h1>
                Customer Data
                <span>
                    <input type="text" name="txtSearch" id="txtSearch" value="" placeholder="Search here...">
                </span>
            </h1>
            <table cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <th>NAME</th>
                    <th>PHONE</th>
                    <th>EMAIL</th>
                    <th>DATE</th>
                    <th>&nbsp;</th>
                </thead>
                <?php foreach ($collection as $client) {?>
                <tr>
                    <td>
                        <a href="client_profile.php?pid=<?php echo base64_encode($client['txtId'])?>">
                            <?php echo $client["txtFirstName"]." ".$client["txtLastName"]?>
                        </a>
                    </td>
                    <td><?php echo $client["txtPhoneNum"]?></td>
                    <td><a href="mailto:<?php echo $client['txtEmail']?>"><?php echo $client["txtEmail"]?></a></td>
                    <td><?php echo $client["txtDate"]?></td>
                    <td>
                      <a href="<?php echo $_SERVER['PHP_SELF'];?>?del_id=<?php echo base64_encode($client['txtId']);?>" onClick="return confirm('Are you sure you want to delete?')" title="Delete">
                        <button type="button" id="user-delete" title="Delete"><i class="fa fa-trash-o"></i></button>
                      </a>
                    </td>
                </tr>
                <?php 
                }
                if (empty($collection)) { ?>
                <tr>
                    <td colspan="7" class="no-record"> -- Sorry no records found...! -- </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </form>

    <!-- Footer Start -->
    <?php include 'common/footer.php';?>
    <!-- Footer End -->
</div>

<!-- Custome Script Adding-->
<script type="text/javascript" src="../js/script_common.js"></script>

</body>
</html>
