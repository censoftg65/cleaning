<?php
/*filename :  process-personal-data.php
 *description : for Personal Section Ajax call
 */
?>
<?php
require_once(dirname(dirname(__DIR__)) . '/inc/config.inc.php');
?>
<?php
$db = new Config();

/*#############For Personal Profile###############*/


$form_request = $_POST['form_request'];
$formdata     = $_POST['formdata'];

$output     = "";
$result1    = "";
$result2    = "";
$table_name = _DB_PREFIX . 'zipcity';

/*On State chage fill city and zipcode*/
if (isset($_POST) && $form_request == "state") {
    /*city*/
    
    $query1 = $db->select('txtCity');
    $query1 .= $db->from($table_name);
    $query1 .= $db->where('upper(txtState) = upper("' . $formdata . '")');
    $query1 .= $db->orderby('txtCity');
    $db->query($query1);
    while ($rows = $db->fetchAssoc()):
        $result1 .= "<option value='" . $rows['txtCity'] . "'>" . ucfirst(strtolower($rows['txtCity'])) . "</option>";
    endwhile;
    
    /*Zipcode*/
    $query2 = $db->select('txtZip');
    $query2 .= $db->from($table_name);
    $query2 .= $db->where('upper(txtState) = upper("' . $formdata . '")');
    $query2 .= $db->orderby('txtZip');
    $db->query($query2);
    while ($rows = $db->fetchAssoc()):
        $result2 .= "<option value='" . $rows['txtZip'] . "'>" . $rows['txtZip'] . "</option>";
    endwhile;
    
    $output = $result1 . '@' . $result2;
    echo $output;
    $db->freeResult();
}
/*On change City*/
if (isset($_POST) && $form_request == "city") {
    $table_name = _DB_PREFIX . 'zipcity';
    $query2     = $db->select('txtZip');
    $query2 .= $db->from($table_name);
    $query2 .= $db->where('upper(txtCity) = upper("' . $formdata . '")');
    $query2 .= $db->orderby('txtZip');
    $db->query($query2);
    while ($rows = $db->fetchAssoc()):
        $output .= "<option value='" . $rows['txtZip'] . "'>" . $rows['txtZip'] . "</option>";
    endwhile;
    echo $output;
    $db->freeResult();
}
$db->close();

?>