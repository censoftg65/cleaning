<?php
/**
* Define All Contact Variables Here
*/
/*------------------------------------------------------------------------------*/
define("_SITE_MODE", "debug"); // debug, production 

// define("_SITE_URL", "http://centurysoftwares.com/cleaning");
// define("_SITE_URL", "http://192.168.17.157/cleaning");
define("_SITE_URL", "http://localhost/cleaning");
define("_PANEL_NAME", "Admin Panel");
define("_SITE_NAME", "Unwritten Cleaning");
define("_SITE_ADDRESS", "localhost.com");
define("_SITE_LANGUAGE", "en");
define("_ADMIN_EMAIL", "admin@domain.com");
define("_DB_PREFIX", "wc_cleaning_");

/*Directry URL*/
define("_ROOT_PATH", dirname(__DIR__));
define("_ADMIN_CSS_ASSETS", _SITE_URL.'/admin/assets');
// define("_BOOKING_PATH", dirname(__DIR__).'/booking');
define("_BOOKING_PATH", _SITE_URL.'/booking');
define("_INCLUDE_PATH", dirname(__DIR__).'/includes');
define("_USER_PATH", dirname(__DIR__).'/user');
define("_BOOKING_URL", _SITE_URL.'/booking');
define("_USER_URL", _SITE_URL.'/user');
define("_IMAGE_URL", _SITE_URL.'/images');
define("_CSS_URL", _SITE_URL.'/css');
define("_BOOTSTRAP_URL", _SITE_URL.'/bootstrap');
define("_JS_URL", _SITE_URL.'/js');
define("_EDITOR_URL", _SITE_URL.'/tinymce');

// *** encrypt or not admin password true|false
define("_USE_PASSWORD_ENCRYPTION", true);
// *** type of encryption - AES|MD5
define("_PASSWORD_ENCRYPTION_TYPE", "base64_encode");

?>
