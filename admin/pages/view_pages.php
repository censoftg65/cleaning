<?php
session_start();
ob_start();
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

require_once(dirname(dirname(__DIR__)).'/inc/config.inc.php');
include(dirname(dirname(__DIR__)).'/inc/function.inc.php');
include 'cls_pages.php';
$db = new Config(); 
$objPage = new Pages(); 
$collection_page = $objPage->getPageDetails("all","");

?>

<head>
    <title><?php echo _SITE_NAME ?> :: Pages | View Pages</title>
</head>

<?php include '../include/header.php' ?>

<?php include '../include/left_menu.php' ?>

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form name="frmViewPages" id="frmViewPages" method="post">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>PAGE TITLE</th>
                      <th>PAGE URL</th>
                      <th>PAGE STATUS</th>
                      <th><center>ACTION</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($collection_page as $pages) {
                    ?>
                    <tr>
                      <th scope="row"><?php echo $i?></th>
                      <td><?php echo $pages['txtPageTitle']?></td>
                      <td><?php echo $pages['txtPageUrl']?></td>
                      <td><?php echo $active = ($pages['txtPageStatus'] == 1) ? "Publish" : "Disabled";?></td>
                      <td>
                        <center>
                            <a title="Edit" href="edit_pages.php?pid=<?= base64_encode($pages['txtId'])?>">
                                <button type="button" title="Edit">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                            </a>
                            &nbsp;&nbsp;
                            <a title="Delete">
                                <button type="button" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </a>
                        </center>
                      </td>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                  </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include '../include/footer.php' ?>