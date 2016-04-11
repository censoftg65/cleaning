<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html lang="en">
<head>
	<!-- ALL META TAGGS INCLUDE HERE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="crm">
    <meta name="description" content="Website Back-End management script that provides access to the control features of your site.">
    <meta name="author" content="Cleaning Company">
    <meta name="generator" content="ApPHP AdminPanel">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">

    <title><?= $_SESSION['page_title']?></title>

    <!-- ALL STYLE TAGGS INCLUDE HERE -->
    <link href="<?= _CSS_URL?>/style_menu.css" type="text/css" rel="stylesheet">
    <link href="<?= _CSS_URL?>/pr-tools.css" type="text/css" rel="stylesheet">
    <link href="<?= _CSS_URL?>/style_global.css" type=text/css rel=stylesheet>
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap.css" type=text/css rel=stylesheet>
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap.min.css" type=text/css rel=stylesheet>
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap-theme.min.css" type=text/css rel=stylesheet>
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap-theme.min.css" type=text/css rel=stylesheet>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- ALL SCRIPT TAGGS INCLUDE HERE -->
    <script type="text/javaScript" src="<?php echo _BOOTSTRAP_URL?>/js/bootstrap.min.js"></script>
    <script type="text/javaScript" src="<?php echo _JS_URL?>/jquery-1.11.2.min.js"></script>
    <script type="text/JavaScript" src="<?php echo _JS_URL?>/functions.js"></script>    
    <script type="text/javascript" src="<?php echo _JS_URL?>/pr-tools.js"></script>
    <script type="text/javaScript" src="<?php echo _EDITOR_URL?>/tinymce.min.js"></script>
    <script type="text/javaScript" src="<?php echo _JS_URL?>/script_custom.js"></script>

    <script>
    function rememberMe(val) {
        if(document.getElementById("txtRemember").checked == true) {
            setCookie("remember_name",document.getElementById("txtUsername").value,14);       
        } else {
            setCookie("remember_name","",-2);       
        }
    }
    </script>
</head>
<body>