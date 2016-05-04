<?php
/**
*
*/
$db = new Config(); 
$collection = getMenus();

// $act_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/admin/dashboard.php") ? "active" : "";
// $act_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/admin/dashboard.php") ? "active" : "";

?>
    
        <div class="col-md-3">
            <?php if(isset($_SESSION['ad_logged']) && $_SESSION['ad_logged'] == true){ ?>
        	<div class="col-md-12">
                <ul id="nav">
                    <?php foreach ($collection as $list) { ?>
                    <li><a href="#"><?= $list['txtMenuIcon']?>&nbsp;&nbsp;<?= $list['txtMenu']?></a>
                        <ul id="sub-nav">
                            <?php           
                            if($_SESSION['txtUserLevel'] == "admin"){
                                $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 1 AND txtIsHidden = 0 AND txtParentId = ".intval($list['txtId'])."";
                            } else {
                                $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 1 AND txtIsHidden = 0 AND txtParentId = 0";
                            }
                            $db->query($sql);
                            while($_list = $db->fetchAssoc()){
                                if ($_list['txtMenuUrl'] == '') {
                                    $menu_url = "#";
                                } else {
                                    $menu_url = _SITE_URL."/admin/".$_list['txtMenuUrl'];
                                }
                                echo "<li><a href='$menu_url'>".$_list['txtMenuIcon']."&nbsp;&nbsp;".$_list['txtMenu']."</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-12">
                <ul id="nav">
                    <li>
                        <a href="<?= _SITE_URL?>/admin/logout.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</a>        
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>