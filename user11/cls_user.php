<?php
/*=============================
*filename :  cls_user.php
*description : All dataobject
===============================*/
?>
<?php
$db = new Config();

/*#######Logic Start Here#########*/

/*TO GET ALL NEWYORK CITIES*/
class NewyorkCitis{
	public function getUSCities(){
       $db = new Config();

       /*Initilise variable*/
       $table_name = _DB_PREFIX . 'zipcity';
       $NewyorkCityCode = 'NY';
     
       $query  = $db->select('txtCity');
       $query .= $db->from($table_name);
       $query .= $db->where('upper(txtState) = upper("' . $NewyorkCityCode. '")');
       $query .= $db->orderby('txtCity');
       $db->query($query);
       $data = array();
        while($rows = $db->fetchAssoc()){
            array_push($data,$rows);
        }
        return $data;
    }
}
$NewyorkCitisObj = new NewyorkCitis();

