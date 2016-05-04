<!DOCTYPE HTML  PUBL IC "-//W3C//DTD HTML  4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html lang="en">
<head>
	<!-- AL L  META TAGGS INCL UDE HERE -->
    <meta http-equiv=Content-Type content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="googlebot" content="noindex,nofollow">
    <meta name="googlebot-news" content="noindex,nofollow">
    <meta name="keywords" content="crm">
    <meta name="description" content="Website Back-End management script that provides access to the control features of your site.">
    <meta name="author" content="Cleaning Company">
    <meta name="generator" content="ApPHP AdminPanel">

    <title><?= $_SESSION['page_title']?></title>

    <!-- ALL STYLE TAGGS INCL UDE HERE -->
    <link href="<?= _IMAGE_URL?>/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?= _BOOTSTRAP_URL?>/css/jquery.timepicker.css" rel="stylesheet" type="text/css">
    <link href="<?= _BOOTSTRAP_URL?>/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
    <link href="<?= _CSS_URL?>/style.css" rel="stylesheet" type="text/css">
    <link href="<?= _CSS_URL?>/style_global.css" type="text/css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,800,700italic,700,800italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- ALL SCRIPT TAGGS INCL UDE HERE -->
    <script src="<?= _JS_URL?>/jquery-1.11.2.min.js"></script>
    <script src="<?= _BOOTSTRAP_URL?>/js/bootstrap.js"></script>
    <script src="<?= _BOOTSTRAP_URL?>/js/bootstrap.min.js"></script>
    <script src="<?= _BOOTSTRAP_URL?>/js/jquery.timepicker.js" type="text/javascript"></script>
    <script src="<?= _BOOTSTRAP_URL?>/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?= _JS_URL?>/functions.js"></script>    
    <script src="<?= _JS_URL?>/pr-tools.js"></script>
    <script src="<?= _EDITOR_URL?>/tinymce.min.js"></script>
    <script src="<?= _JS_URL?>/script_custom.js"></script>
    <script src="<?= _JS_URL?>/user_custom.js"></script>

    <!-- SCRIPTS FROM BOOKING FORM -->
    <script src="<?= _JS_URL?>/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?= _JS_URL?>/jquery.validate.js"></script>
    <!-- <script src="<?= _JS_URL?>/AppForm.js"></script>
    <script src="<?= _BOOKING_URL ?>/js/booking.js"></script> -->

    <!-- SCRIPT TO SET THE COOKIES -->
    <script src="<?= _JS_URL?>/jquery.cookie.js"></script>
    <script>
    $.cookie('_SITE_URL', '<?= _SITE_URL?>', { path: '/' });
    var _SITE_URL = $.cookie('_SITE_URL');
    </script>
</head>
