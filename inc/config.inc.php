<?php
// SITE MODES
//------------------------------------------------------------------------------
define("_SITE_MODE", "debug"); // debug, production 

// SITE CONSTANTS
//------------------------------------------------------------------------------
// define("_SITE_URL", "http://centurysoftwares.com/cleaning");
define("_SITE_URL", "http://localhost/cleaning");
define("_PANEL_NAME", "Admin Panel");
define("_SITE_NAME", "Website Cleaning");
define("_SITE_ADDRESS", "localhost.com");
define("_SITE_LANGUAGE", "en");
define("_ADMIN_EMAIL", "admin@domain.com");
define("_DB_PREFIX", "wc_cleaning_");

/*Directry URL*/
define("_ROOT_PATH", dirname(__DIR__));
define("_BOOKING_PATH", dirname(__DIR__).'/bookings');
define("_INCLUDE_PATH", dirname(__DIR__).'/includes');
define("_IMAGE_URL", _SITE_URL.'/images');
define("_CSS_URL", _SITE_URL.'/css');
define("_BOOTSTRAP_URL", _SITE_URL.'/bootstrap');
define("_JS_URL", _SITE_URL.'/js');
define("_EDITOR_URL", _SITE_URL.'/tinymce');

// *** encrypt or not admin password true|false
define("_USE_PASSWORD_ENCRYPTION", true);
// *** type of encryption - AES|MD5
define("_PASSWORD_ENCRYPTION_TYPE", "base64_encode");

//------------------------------------------------------------------------------
if(_SITE_MODE == "debug"){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','1');
    ini_set('display_startup_errors','1');
    error_reporting (E_ALL);    
}

/*########## database credintials #######*/
require_once('database.inc.php');
/*########## end database credintials #######*/

//------------------------------------------------------------------------------
/**
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
    function freeResult() {
        return (@mysql_free_result($this->result));
    }
}

?>