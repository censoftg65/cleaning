/**
* 
*/
//--------------------------------------------------------------------------------------
function setCookie(name,value,days) {
    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = '; expires='+date.toGMTString();
    }
    else var expires = '';
    document.cookie = name+'='+value+expires+'; path=/';
}

jQuery(document).ready(function($) {
    var min_height = jQuery(window).height();
    jQuery('div.register-page-container').css('min-height', min_height);
    jQuery('div.register-page-container').css('line-height', min_height + 'px');

    //$(".inner", ".boxed").fadeIn(500);
});

//*---- CLIENT REGISTRATION ----*//
function validateClientReg(){
    var txtFirstName = document.getElementById("txtFirstName").value;
    if(txtFirstName == ""){
        alert("Please enter your first name.");
        document.getElementById("txtFirstName").focus();
        return false;
    }
}


/*
* Auther : Vinek T.
* Description : Script for creating/adding page from back-end
* Date : 30th March'2016
*/
jQuery(document).ready(function() {
    /*--Insert Edito into the page content area--*/
    tinymce.init({ selector: "textarea#txtPageContent" });
    tinymce.init({ selector: "textarea#txtEditPageContent" });

    /*--Add/Create Pages--*/
    jQuery('#btnCreatePage').click(function(){
        var pageTitle = jQuery("#txtPageTitle").val();
        var pageUri = jQuery("#txtPageUri").val();
        var pageContent = tinyMCE.activeEditor.getContent();
        if (pageTitle == "" && pageUri == "" && pageContent == "") {
            alert("Please fill the required field");
            jQuery("#txtPageTitle").focus();
            return false;
        } else if (pageTitle == "") { 
            alert("Please enter the page title");
            jQuery("#txtPageTitle").focus();
            return false;
        } else if (pageUri == "") { 
            alert("Please enter the page url link");
            jQuery("#txtPageUri").focus();
            return false;
        } else {
            jQuery('#loading').html('<img src="http://localhost/cleaning/images/loader.gif">');
            jQuery('#loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/addPage.php',
                data: {"pagetitle":pageTitle,"pageurl":pageUri,"pagecontent":pageContent},
                // data: jQuery("#frmAddPages").serialize(),
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#loading').hide();}, 2000);
                }
            });
        }
    })

    /*--Edit/Update Pages--*/
    jQuery('#btnUpdatePage').click(function(){
        var pageid = jQuery("#hidPageId").val();
        var pageTitle = jQuery("#txtEditPageTitle").val();
        var pageUri = jQuery("#txtEditPageUri").val();
        var pageContent = tinyMCE.activeEditor.getContent();
        if (pageTitle == "" && pageUri == "" && pageContent == "") {
            alert("Please fill the required field");
            jQuery("#txtEditPageTitle").focus();
            return false;
        } else if (pageTitle == "") { 
            alert("Please enter the page title");
            jQuery("#txtEditPageTitle").focus();
            return false;
        } else if (pageUri == "") { 
            alert("Please enter the page url link");
            jQuery("#txtEditPageUri").focus();
            return false;
        } else {
            jQuery('#edit_loading').html('<img src="http://localhost/cleaning/images/loader.gif">');
            jQuery('#edit_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/editPage.php',
                data: {"pageid":pageid,"editPagetitle":pageTitle,"editPageurl":pageUri,"editPagecontent":pageContent},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#edit_loading').hide();}, 2000);
                }
            });
        }
    })
});    
/* ---- End ---- */

