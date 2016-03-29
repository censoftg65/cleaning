<?php
/**
*
*/
$menu_group_index = 0;
$menu_group_count = 0;

$db = new Config(); 
$collection = getMenus();
$menu_group_count = count(getMenus());

$collection2 = getMenus();

?>
<script>
function prepareFilterBlocks() {
    for (var i = 0; i < <?php echo $menu_group_count?>; i++) {
        if(document.getElementById("plusbox"+i).style.display == "none") {
            setCookie("FilterCatId_"+i+"_State","maximized",14);
        }
        else if(document.getElementById("plusbox"+i).style.display == "block") {
	       setCookie("FilterCatId_"+i+"_State","minimized",14);
        }    
    }
}
</script>
<?php
$FilterCatIds = array();
for($i = 0; $i < $menu_group_count; $i++) {
    $FilterCatIds[$i] = (isset($_COOKIE['FilterCatId_'.$i.'_State']) && ($_COOKIE['FilterCatId_'.$i.'_State'] != "")) ? $_COOKIE['FilterCatId_'.$i.'_State'] : "maximized";
}
?>
<div class="left_menu">
    <table align="left" celppadding=1 cellspacing=1 border="0" width="150px">
        <?php if(isset($_SESSION['ad_logged']) && $_SESSION['ad_logged'] == true){ ?>
    	<div id="textfilters" style="border:0px;">
            <?php foreach ($collection as $list) {?>
            <div class="curtainBox <?php echo $FilterCatIds[$menu_group_index];?>" id="filter<?php echo $menu_group_index;?>" style="width:150px;">
    		    <div class="header switch" style="height:20px;width:200px">
        			<span class="expand" id='plusbox<?php echo $menu_group_index;?>'><IMG class="plusbox" alt="(+)" src="images/expand.gif"></span> 
        			<span class="collapse" id='minusbox<?php echo $menu_group_index;?>'><IMG class="plusbox" alt="(-)" src="images/collapse.gif"></span> 
        			<strong><?php echo $list['txtMenu'];?></strong>
    		    </div>
    		    <div class="toggleBox curtain filterValues" id="filter5PopularFilterValues">
        			<ul class="case1 popularFilterValues">
        			<?php			
        			    $db->query("SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 0 AND txtIsHidden = 0 AND txtParentId = ".intval($list['txtId'])."");
                        if($_SESSION['txtUserLevel'] == "admin"){
                            $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 0 AND txtIsHidden = 0 AND txtParentId = ".intval($list['txtId'])."";
                        } else {
                            $sql = "SELECT * FROM "._DB_PREFIX."menus WHERE txtIsMenuGroup = 0 AND txtIsHidden = 0 AND txtParentId = ".intval($list['txtId'])."";
                        }
                        $db->query($sql);
                        while($list_ = $db->fetchAssoc()){
                            echo "<LI><A target='frameMain' href='".$list_['txtMenuUrl']."'  onclick='prepareFilterBlocks()'>".$list_['txtMenu']."</A></LI>";	
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

        <tr><td vAlign=top height="10px" nowrap><hr class="divider"></td></tr>	
    	<tr><td vAlign=top><a href="<?php echo _SITE_URL?>/logout.php" onclick="prepareFilterBlocks()">Log Out</a></td></tr>
    	<tr><td vAlign=top>&nbsp;</td></tr>    
    	<tr><td vAlign=top>&nbsp;</td></tr>
    	<tr><td vAlign=top>&nbsp;</td></tr>
        <tr><td vAlign=top>&nbsp;</td></tr>
        <tr><td vAlign=top>&nbsp;</td></tr>
        <?php } ?>
    </table>
</div>