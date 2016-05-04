<?php
/*
* Include Neccessory Files Here
*
*/
require_once('define.inc.php');
require_once('database.inc.php');

/**
* Defined All Debug Mode Here
*
*/
if(_SITE_MODE == "debug"){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','0');
    ini_set('display_startup_errors','1');
    error_reporting (E_ALL);    
}

/**
* Defined Config Class Here
* 
*/
class Config
{
    protected $db_host = DB_HOST;
	protected $db_user = DB_USER;
	protected $db_pass = DB_PASSWORD;
    protected $db_name = DB_DATABASE;
	var $db_conn = NULL;
    var $result = false;

	public function __construct() {
		$this->db_conn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass);
		if (!$this->db_conn) {
            header("location:error.html"); 
            exit(); 
            return false;
        } else {
            // echo "DB connection done";
        }
        @mysql_select_db($this->db_name, $this->db_conn);
	}

	public function getParam($paramName) {
	    global $POST;
	    global $GET;
	    $paramValue = "";
	    if (isset ($_POST[$paramName])) {
	        $paramValue = $_POST[$paramName];
	    } elseif (isset ($_GET[$paramName])) {
	        $paramValue = $_GET[$paramName];
	    }
	    return $paramValue;
	}

	function close() { 
        return (@mysql_close($this->db_conn));
    }
    function error() {
        return (mysql_error());
    }
    function select($fields = null) {
        return ("SELECT DISTINCT $fields ");
    }
    function from($table_name = null) {
        return ("FROM $table_name ");
    }
    function where($condition = null) {
        return ("WHERE $condition ");
    }
    function orderby($field_name = null) {
       return ("ORDER BY $field_name");
    }
    function sortorder($sortorder = "ASC") {
       return ("$sortorder");
    }
    function limit($limit = "1") {
       return ("LIMIT $limit");
    }
    function query($sql = '') {
        $this->result = @mysql_query($sql, $this->db_conn);
        return ($this->result != false);
    }
    function affectedRows() {
        return (@mysql_affected_rows($this->db_conn));
    }
    function numRows() {
        return (@mysql_num_rows($this->result));
    }
    function numCols() {
        return @mysql_num_fields($this->result);
    }
    function fieldName($field) {
       return (@mysql_field_name($this->result,$field));
    }
    function insertID() {
        return (@mysql_insert_id($this->conn));
    }
    function fetchObject() {
        return (@mysql_fetch_object($this->result, MYSQL_ASSOC));
    }
    function fetchArray() {
        return (@mysql_fetch_array($this->result, MYSQL_BOTH));
    }
    function fetchAssoc() {
        return (@mysql_fetch_assoc($this->result));
    }
     function result($result = null) {
        return (@mysql_fetch_assoc($this->result));
    }
    function freeResult() {
        return (@mysql_free_result($this->result));
    }
}
?>