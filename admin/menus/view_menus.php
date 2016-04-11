<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:/cleaning/admin/index.php");
}

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
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

require_once (dirname(dirname(__DIR__)).'/inc/config.inc.php');
include_once (dirname(dirname(__DIR__)).'/inc/function.inc.php');
include 'cls_menus.php';
$_SESSION['page_title'] = "View Menus | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
$collection_menu = $objPage->getMenuDetails("all","");
$menu_parent = $objPage->getMenuParents();

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <!-- Ppo-up To Add New Trainer Start -->
  <div style="display:none;" id="back-color"></div>
  <div style="display:none;" class="pop-up-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Edit Menu</h4>
          </div>
          <form method="post" action="#" name="frmEditMenus" id="frmEditMenus" class="frmMenus">
            <input type="hidden" id="form_edit_value" name="form_edit_value" value="">
            <input type="hidden" id="edit_menus" name="edit_menus" value="">
            <div class="modal-body">
                <div class="col-md-6">
                    <label>Menu Title&nbsp;<span>*</span></label>
                    <input class="form-control input-sm" type="text" id="txtEditMenuTitle" name="txtEditMenuTitle" value="<?= $menu['txtMenu']?>">
                </div>
                <div class="col-md-6">
                    <label>Menu Icon&nbsp;<span>*</span></span></label>
                    <input class="form-control input-sm" type="text" id="txtEditMenuIcon" name="txtEditMenuIcon" value='<?= $menu['txtMenuIcon']?>'>
                </div>
                <div class="col-md-12">&nbsp;</div>
                <?php ?>
                <div id="#parent-field" class="col-md-6">
                    <label>Parent Menu</label>
                    <select class="form-control input-sm" id="txtEditParentMenu" name="txtEditParentMenu">
                        <?php getOptions($menu_parent,"txtId","txtMenu",$menu['txtParentId']);?>
                    </select>
                </div>
                <div id="#url-field" class="col-md-6">
                    <label>Menu Url Link</label>
                    <input class="form-control input-sm" type="text" id="txtEditMenuUri" name="txtEditMenuUri" value="<?= $menu['txtMenuUrl']?>" readonly>
                </div>
                <div class="modal-in">&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" id="close-edit-menu-form">Close</button>
              <button class="btn btn-primary" type="button" id="btnUpdateMenu" name="btnUpdateMenu">
                <span style="display:none" id="edit_menu_loading"></span>&nbsp;&nbsp;Update Menu  
              </button>
            </div>
          </form>
        </div>
      </div>
  </div>
  <!-- Ppo-up To Add New Trainer End -->

  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <h4><strong>VIEW MENUS</strong></h4>
      <div class="col-md-12">&nbsp;</div>
      <form name="frmViewPages" id="frmViewPages" method="post">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>TITLE</th>
              <th>PARENT</th>
              <th>URL</th>
              <th>STATUS</th>
              <th><center>ACTION</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($collection_menu as $menus) {
            ?>
            <tr>
              <th scope="row"><?php echo $i?></th>
              <td><?php echo $menus['txtMenu']?></td>
              <td><?php 
                  if ($menus['txtParentId'] == 0) {
                    echo "--";
                  } else {
                    $string = displayName("wc_cleaning_menus","txtMenu",$menus['txtParentId'],"txtId");
                    echo $opt = str_replace("Manage", "", $string);
                  }
                  ?>
              </td>
              <td><?= $menu_uri = ($menus['txtParentId'] == 0) ? "--" : $menus['txtMenuUrl'];?>
              </td>
              <td><?php echo $active = ($menus['txtStatus'] == 1) ? "Publish" : "Disabled";?></td>
              <td>
                <center>
                    <a href="#" title="Edit">
                        <button type="button" title="Edit" id="editMenu" value="<?php echo $menus['txtId']?>">
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

  <?php include dirname(__DIR__).'/include/footer.php' ?>