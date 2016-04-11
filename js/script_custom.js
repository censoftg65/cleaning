
/*
* Auther : Vinek T.
* Description : Script for setting up the cookies
* Date : 26th March'2016
*/
function setCookie(name,value,days) {
    if (days) {
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
/* ---- End ---- */

jQuery(document).ready(function() {
    /*
    * Auther : Vinek T.
    * Description : Script for creating/adding page from back-end
    * Date : 30th March'2016
    */
    /*--Insert Editor into the content area--*/
    tinymce.init({ 
        selector: "textarea#txtPageSliderContent",
        height: 300,
        theme: 'modern',
        plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true, 
    });
    tinymce.init({ 
        selector: "textarea#txtPageTextContent",
        height: 300,
        theme: 'modern',
        plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,  
    });
    tinymce.init({ 
        selector: "textarea#txtEditSliderContent",
        height: 300,
        theme: 'modern',
        plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,  
    });
    tinymce.init({ 
        selector: "textarea#txtEditTextContent",
        height: 300,
        theme: 'modern',
        plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,  
    });
    tinymce.init({ 
        selector: "textarea#txtEditContactDetails",
        height: 300,
        theme: 'modern',
        plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,  
    });
    
    /* ---- End ---- */

    /*--Add/Create Pages--*/
    jQuery('#btnCreatePage').click(function(){
        var pageTitle = jQuery("#txtPageTitle").val();
        var pageUri = jQuery("#txtPageUri").val();
        var pageSliderContent = tinyMCE.get('txtPageSliderContent').getContent();
        var pageTextContent = tinyMCE.get('txtPageTextContent').getContent();
        if (pageTitle == "" && pageUri == "") {
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
                data: {"pagetitle":pageTitle,"pageurl":pageUri,"pageslidercontent":pageSliderContent,"pagetextcontent":pageTextContent},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#loading').hide();}, 2000);
                }
            });
        }
    })
    /* ---- End ---- */

    /*--Edit/Update Pages--*/
    jQuery('#btnUpdatePage').click(function(){
        var pageid = jQuery("#hidPageId").val();
        var pageTitle = jQuery("#txtEditPageTitle").val();
        var pageUri = jQuery("#txtEditPageUri").val();
        var pageSliderContent = tinyMCE.get('txtEditSliderContent').getContent();
        var pageTextContent = tinyMCE.get('txtEditTextContent').getContent();
        if (pageTitle == "" && pageUri == "") {
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
                data: {"pageid":pageid,"editPagetitle":pageTitle,"editPageurl":pageUri,"editSlidercontent":pageSliderContent,"editTextcontent":pageTextContent},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#edit_loading').hide();}, 2000);
                }
            });
        }
    })
    /* ---- End ---- */

    /*--Edit/Update Contact Details--*/
    jQuery('#btnContactDetails').click(function(){
        var contactId = jQuery("#hidContactId").val();
        var title = jQuery("#txtTitle").val();
        var contactDetail = tinyMCE.get('txtEditContactDetails').getContent();
        if (title == "") {
            alert("Please fill the title field");
            jQuery("#txtTitle").focus();
            return false;
        } else {
            jQuery('#contact_loading').html('<img src="http://localhost/cleaning/images/loader.gif">');
            jQuery('#contact_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/editContactDetails.php',
                data: {"contactid":contactId,"title":title,"contactDetail":contactDetail},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#contact_loading').hide();}, 2000);
                    location.reload();
                }
            });
        }
    })
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for creating menu accordion in admin apnel
    * Date : 1st April'2016
    */
    /*-- Admin Main Menu Accordion --*/
    $('#nav > li > a').click(function(){
        if ($(this).attr('class') != 'active'){
            $('#nav li ul').slideUp();
            $(this).next().slideToggle();
            $('#nav li a').removeClass('active');
            $(this).addClass('active');
        }
    });
    /* ---- End ---- */

    /*-- Creating/adding Menus Pop-up --*/
    jQuery('button#editMenu').click(function() {
        var menu_id = jQuery(this).val();
        $.ajax({
            type: "POST",
            url: 'form-wizard/getEditMenu.php',
            data: {"menu_id": menu_id},
            success: function(response) {
                // alert(response);
                var obj = jQuery.parseJSON(response);
                jQuery("#txtEditParentMenu").val(obj.txtParentId);
                jQuery("#txtEditMenuTitle").val(obj.txtMenu);
                jQuery('#txtEditMenuUri').val(obj.txtMenuUrl);
                jQuery('#txtEditMenuIcon').val(obj.txtMenuIcon);
                jQuery('#back-color').show();
                jQuery('.pop-up-form').toggle("slow");
                jQuery('#form_edit_value').val("Editrecord");
                jQuery('#edit_menus').val(menu_id);
            }
        })
    });
    /* ---- End ---- */

    /*--Edit/Update Menus--*/
    jQuery('.close').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    jQuery('#close-edit-menu-form').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    jQuery('#btnUpdateMenu').click(function(){
        var menuId = jQuery("#edit_menus").val();
        var menuTitle = jQuery("#txtEditMenuTitle").val();
        var menuParent = jQuery("#txtEditParentMenu").val();
        var menuUrl = jQuery("#txtEditMenuUri").val();
        var menuIcon = jQuery("#txtEditMenuIcon").val();
        if (menuTitle == "") { 
            alert("Please enter the menu title");
            jQuery("#txtEditMenuTitle").focus();
            return false;
        } else if (menuIcon == "") { 
            alert("Please enter the menu icon");
            jQuery("#txtEditMenuIcon").focus();
            return false;
        } else {
            jQuery('#edit_menu_loading').html('<img src="http://localhost/cleaning/images/loader.gif">');
            jQuery('#edit_menu_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/editMenus.php',
                data: {"menuId":menuId,"menuTitle":menuTitle,"menuParent":menuParent,"menuUrl":menuUrl,"menuIcon":menuIcon},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){jQuery('#edit_menu_loading').hide();}, 2000);
                    location.reload();
                }
            });
        }
    })
    /* ---- End ---- */   

    /*
    * Auther : Vinek T.
    * Description : Script for creating/adding users from back-end
    * Date : 4th April'2016
    */
    /*-- Add/Create users --*/
    jQuery('#btnAddPopUp').click(function() {
        jQuery('#frmAddUser')[0].reset();
        jQuery('#back-color').show();
        jQuery('.pop-up-form').toggle("slow");
    });
    jQuery('.close').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    jQuery('#close-user-form').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    jQuery('#btnAddUser').click(function(){
        var baseuri   = "/cleaning/admin/users/view_users.php";
        var fname = jQuery("#txtFirstName").val();
        var lname = jQuery("#txtLastName").val();
        var email = jQuery("#txtEmail").val();
        var phone = jQuery("#txtPhone").val();
        var addr1 = jQuery("#txtAddressLine1").val();
        var addr2 = jQuery("#txtAddressLine2").val();
        var country = jQuery("#txtCountry").val();
        var state = jQuery("#txtState").val();
        var city = jQuery("#txtCity").val();
        var zipcode = jQuery("#txtZipcode").val();
        var ulevel = jQuery("#txtUserLevel").val();
        var status = jQuery("#txtStatus").val();

        if (fname == "" || lname == "" || email == "" || phone == "" || status == "") { 
            alert("Please fill required (*) field");
            return false;
        } else {
            jQuery('#add_user_loading').html('<img src="http://localhost/cleaning/images/loader.gif">');
            jQuery('#add_user_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/processUsers.php',
                data: $("#frmAddUser").serialize(),
                dataType :'json',
                success: function(response) {
                    if(response.success == 'yes') {
                        alert(response.message);
                        setTimeout(function(){jQuery('#add_user_loading').hide();}, 1000);
                        jQuery('.pop-up-form').hide(500);
                        window.location = baseuri;
                    } else if(response.success == 'no') {
                        alert(response.message);
                        setTimeout(function(){jQuery('#add_user_loading').hide();}, 100);
                        return false;
                    }  
                }
            });
        }
    })
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for getting the edit data from database and edit/update users from back-end
    * Date : 5th April'2016
    */
    /*-- Get Edit Data --*/
    jQuery('button#editUser').click(function() {
        var user_id = jQuery(this).val();
        $.ajax({
            type: "POST",
            url: 'form-wizard/getEditUsers.php',
            data: {"user_id": user_id},
            success: function(response) {
                // alert(response);
                var obj = jQuery.parseJSON(response);
                jQuery("#txtFirstName").val(obj.txtFirstName);
                jQuery("#txtLastName").val(obj.txtLastName);
                jQuery('#txtEmail').val(obj.txtEmail);
                jQuery('#txtPhone').val(obj.txtPhone);
                jQuery('#txtAddressLine1').val(obj.txtAddressLine1);
                jQuery('#txtAddressLine2').val(obj.txtAddressLine2);
                jQuery('#txtState').val(obj.txtState);
                jQuery('#txtCity').val(obj.txtCity);
                jQuery('#txtZipcode').val(obj.txtZipcode);
                jQuery('#txtUserLevel').val(obj.txtUserLevel);
                jQuery('#txtStatus').val(obj.txtStatus);
                jQuery('#back-color').show();
                jQuery('.pop-up-form').toggle("slow");
                jQuery('#form_edit_value').val("Editrecord");
                jQuery('#edit_users').val(user_id);
            }
        })
    });
    /* ---- End ---- */

    /*-- Update Delete/Deactivate User Profile --*/
    jQuery('button#deleteUser').click(function() {
        var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete/deactivate user profile?")) {
            document.frmViewUsers.action = "view_users.php?flag="+Base64.encode(user_id);
            document.frmViewUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Delete User Profile Permanently --*/
    jQuery('button#deleteUser_permant').click(function() {
        var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to permanently delete user?")) {
            document.frmViewDeactiveUsers.action = "view_users_deactive.php?flag="+Base64.encode(user_id);
            document.frmViewDeactiveUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Update Pages to Disable --*/
    jQuery('button#deletePage').click(function() {
        var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete/disable page?")) {
            document.frmViewPages.action = "view_pages.php?flag="+Base64.encode(user_id);
            document.frmViewPages.submit();
        } else {
            return false;
            
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for activate the user profile which is shows as deactivate in a list of back-end
    * Date : 6th April'2016
    */
    /*-- Activate User Profile --*/
    jQuery('input[type="checkbox"]').on('change', function() {
        var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
        var user_id = jQuery(this).val();
        if(jQuery(this).prop("checked") == true){
            if(confirm("Are you sure you want to activate user profile again?")) {
                document.frmViewDeactiveUsers.action = "view_users_deactive.php?status=active&flag="+Base64.encode(user_id);
                document.frmViewDeactiveUsers.submit();
            } else {
                document.frmViewDeactiveUsers.action = "view_users_deactive.php";
                document.frmViewDeactiveUsers.submit();
            }
        }
    });
    /* ---- End ---- */
});    
