<?php
/**
*
*/
$menu_group_index = 0;
$menu_group_count = 0;

$db = new Config(); 
$collection = getMenus();
$menu_group_count = count(getMenus());

?>
<script>
function prepareFilterBlocks() {
    for (var i = 0; i < <?php echo $menu_group_count;?>; i++) {
        if(document.getElementById("plusbox"+i).style.display == "none") {
            setCookie("FilterCatId_"+i+"_State","maximized",14);
        } else if(document.getElementById("plusbox"+i).style.display == "block") {
            setCookie("FilterCatId_"+i+"_State","minimized",14);
        } 
    }
}
</script>
<?php
$FilterCatIds = array();
for($i = 0; $i < $menu_group_count; $i++){
    $FilterCatIds[$i] = (isset($_COOKIE['FilterCatId_'.$i.'_State']) && ($_COOKIE['FilterCatId_'.$i.'_State'] != "")) ? $_COOKIE['FilterCatId_'.$i.'_State'] : "maximized";
}
?>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if(isset($_SESSION['ad_logged']) && $_SESSION['ad_logged'] == true){ ?>
        	<div class="col-md-12">
                <?php foreach ($collection as $list) {?>
                <div class="curtainBox <?php echo $FilterCatIds[$menu_group_index];?>" id="filter<?php echo $menu_group_index;?>">
        		    <div class="header switch">
            			<?php if ($list['txtId'] != '1') { ?>
                        <span class="expand" id='plusbox<?php echo $menu_group_index;?>'>
                            <img class="plusbox" alt="(+)" src="<?= _IMAGE_URL?>/expand.gif">
                        </span>
            			<span class="collapse" id='minusbox<?php echo $menu_group_index;?>'>
                            <img class="plusbox" alt="(-)" src="<?= _IMAGE_URL?>/collapse.gif">
                        </span>
            			<?php } else { }?>
                        <a href="<?= $list['txtMenuUrl']?>" style="text-decoration: none">
                            <strong><?= $list['txtMenuIcon']?>&nbsp;&nbsp;<?= $list['txtMenu']?></strong>
                        </a>
        		    </div>
        		    <div class="toggleBox curtain filterValues" id="filter5PopularFilterValues">
            			<ul class="case1 popularFilterValues">
            			<?php			
                        if($_SESSION['txtUserLevel'] == "admin"){
                            $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 1 AND txtIsHidden = 0 AND txtParentId = ".intval($list['txtId'])."";
                        } else {
                            $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 1 AND txtIsHidden = 0 AND txtParentId = 0";
                        }
                        $db->query($sql);
                        while($_list = $db->fetchAssoc()){
                            echo "<li><a href='".$_list['txtMenuUrl']."' onclick='prepareFilterBlocks()'>".$_list['txtMenu']."</a></li>";
                        }
            			?>
                        </ul>
        		    </div>
        		</div>
        		<?php 
                    $menu_group_index++;
                }
                ?>
            </div>
            <div class="col-md-12"><hr class="divider"></div>
        	<div class="col-md-12">
                <a href="<?php echo _SITE_URL?>/logout.php" onclick="prepareFilterBlocks()">
                    <strong><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</strong>
                </a>    
            </div>
        	<?php } ?>
        </div>
    </div>
</div>