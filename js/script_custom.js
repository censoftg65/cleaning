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
});
/* ---- End ---- */

/*
* Auther : Vinek T.
* Description : Script for global search functionality
* Date : 20th April'2016
*/
jQuery(document).ready(function() {
    $("#txtSearch").keyup(function () {
        var value = this.value.toLowerCase().trim();
        $("table tr").each(function (index) {
            if (!index) return;
            $(this).find("td").each(function () {
                var id = $(this).text().toLowerCase().trim();
                var not_found = (id.indexOf(value) == -1);
                $(this).closest('tr').toggle(!not_found);
                return not_found;
            })
        })
    });

    $("#txtSearchUser").keyup(function () {
        if (jQuery("#txtSearchUser").val() != "") {
            var value = this.value.toLowerCase().trim();
            $("table tr").each(function (index) {
                if (!index) return;
                $(this).find("td").each(function () {
                    $("table").css("display","block");
                    var id = $(this).text().toLowerCase().trim();
                    var not_found = (id.indexOf(value) == -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                })
            })
        } else {
            $("table").css("display","none");
        }
    });
}); 
/* ---- End ---- */   

jQuery(window).load(function(){
    /*
    * Auther : Vinek T.
    * Description : Script for user menu in admin section header
    * Date : 18th April'2016
    */
    jQuery(".user-dropdown-toggle").click(function() {
        jQuery("#user-menu").slideToggle('fast');
    });
    jQuery("#cross").click(function() {
        jQuery("#user-menu").slideUp('fast');
    });
    /* ---- End ---- */   

    /*
    * Auther : Vinek T.
    * Description : Script for to make active class to selected pages
    * Date : 5th may'2016
    */
    var path = window.location.pathname.substring(1);
    if (path == 'cleaning/admin/dashboard.php') {
        $('#nav li:nth-child(1) a').addClass('active');
        $('#nav li:nth-child(1) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(1) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(1) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/site_config.php') {
        $('#nav li:nth-child(1) a').addClass('active');
        $('#nav li:nth-child(1) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(1) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(1) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/pages/contact_details.php') {
        $('#nav li:nth-child(1) a').addClass('active');
        $('#nav li:nth-child(1) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(1) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(1) ul#sub-nav li:nth-child(3) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/users/view_users.php') {
        $('#nav li:nth-child(2) a').addClass('active');
        $('#nav li:nth-child(2) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(2) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(2) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/users/view_users_deactive.php') {
        $('#nav li:nth-child(2) a').addClass('active');
        $('#nav li:nth-child(2) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(2) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(2) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/users/trash.php') {
        $('#nav li:nth-child(2) a').addClass('active');
        $('#nav li:nth-child(2) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(2) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(2) ul#sub-nav li:nth-child(3) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/bookings/create_services.php') {
        $('#nav li:nth-child(3) a').addClass('active');
        $('#nav li:nth-child(3) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(3) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(3) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/bookings/pending_services.php' || path == 'cleaning/admin/bookings/edit_services.php') {
        $('#nav li:nth-child(3) a').addClass('active');
        $('#nav li:nth-child(3) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(3) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(3) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/bookings/complete_services.php') {
        $('#nav li:nth-child(3) a').addClass('active');
        $('#nav li:nth-child(3) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(3) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(3) ul#sub-nav li:nth-child(3) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/bookings/trash.php') {
        $('#nav li:nth-child(3) a').addClass('active');
        $('#nav li:nth-child(3) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(3) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(3) ul#sub-nav li:nth-child(4) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/pages/add_pages.php') {
        $('#nav li:nth-child(4) a').addClass('active');
        $('#nav li:nth-child(4) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(4) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(4) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/pages/edit_pages.php') {
        $('#nav li:nth-child(4) a').addClass('active');
        $('#nav li:nth-child(4) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(4) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(4) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/pages/view_pages.php') {
        $('#nav li:nth-child(4) a').addClass('active');
        $('#nav li:nth-child(4) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(4) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(4) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/pages/trash.php') {
        $('#nav li:nth-child(4) a').addClass('active');
        $('#nav li:nth-child(4) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(4) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(4) ul#sub-nav li:nth-child(3) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/offers/view_offers.php') {
        $('#nav li:nth-child(5) a').addClass('active');
        $('#nav li:nth-child(5) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(5) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(5) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/ratings/view_ratings.php') {
        $('#nav li:nth-child(6) a').addClass('active');
        $('#nav li:nth-child(6) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(6) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(6) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/appl-quiz/add_questions.php') {
        $('#nav li:nth-child(7) a').addClass('active');
        $('#nav li:nth-child(7) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(7) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(7) ul#sub-nav li:nth-child(1) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/appl-quiz/edit_questions.php') {
        $('#nav li:nth-child(7) a').addClass('active');
        $('#nav li:nth-child(7) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(7) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(7) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/appl-quiz/view_questions.php') {
        $('#nav li:nth-child(7) a').addClass('active');
        $('#nav li:nth-child(7) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(7) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(7) ul#sub-nav li:nth-child(2) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/appl-quiz/view_applications.php') {
        $('#nav li:nth-child(7) a').addClass('active');
        $('#nav li:nth-child(7) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(7) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(7) ul#sub-nav li:nth-child(3) a').css('color','#AB2925');
    } else if (path == 'cleaning/admin/appl-quiz/trash.php') {
        $('#nav li:nth-child(7) a').addClass('active');
        $('#nav li:nth-child(7) ul#sub-nav').slideDown('slow');
        $('#nav li:nth-child(7) ul#sub-nav li a').removeClass('active');
        $('#nav li:nth-child(7) ul#sub-nav li:nth-child(4) a').css('color','#AB2925');
    } else {
        $('#nav li a').removeClass('active');
        $('#nav li ul#sub-nav').slideUp('slow');
    }
    /* ---- End ---- */   
    
})
/* ---- End ---- */

jQuery(document).ready(function() {
    /* -- Initialize the variable for base url & base64_encode & base64_decodes -- */
    var baseuri = window.location.origin+'/cleaning';
    var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
    /* ---- End ---- */   

    /*
    * Auther : Vinek T.
    * Description : Tinymce Editor teaxtarea filed visibilities
    * Date : 30th March'2016
    */
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
    tinymce.init({ 
        selector: "textarea#txtRegBody",
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
        selector: "textarea#txtRegAdminBody",
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
        selector: "textarea#txtForgotBody",
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
        selector: "textarea#txtOfferBody",
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
        selector: "textarea#txtAccountBody",
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
        selector: "textarea#txtAccountAdminBody",
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

    /*
    * Auther : Vinek T.
    * Description : Script for creating/adding page from back-end
    * Date : 30th March'2016
    */
    /*--Add/Create Pages--*/
    jQuery('#btnCreatePage').click(function(){
        var pageTitle = jQuery("#txtPageTitle").val();
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
        } else {
            jQuery('#loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('#loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/addPage.php',
                data: {"pagetitle":pageTitle,"pageslidercontent":pageSliderContent,"pagetextcontent":pageTextContent},
                success: function(response) {
                    setTimeout(function(){
                        jQuery('#loading').hide();
                        jQuery("#page-success").fadeIn({opacity:'0.8',height:'50px'});
                    }, 2000);
                    setTimeout(function(){jQuery('#page-success').fadeOut();}, 4000);
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
            jQuery('#edit_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('#edit_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/editPage.php',
                data: {"pageid":pageid,"editPagetitle":pageTitle,"editPageurl":pageUri,"editSlidercontent":pageSliderContent,"editTextcontent":pageTextContent},
                success: function(response) {
                    // alert(response);
                    setTimeout(function(){
                        jQuery('#edit_loading').hide();
                        jQuery("#page-success").fadeIn({opacity:'0.8',height:'50px'});
                    }, 2000);
                    setTimeout(function(){jQuery('#page-success').fadeOut();}, 4000);
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
            jQuery('#contact_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('#contact_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/editContactDetails.php',
                data: {"contactid":contactId,"title":title,"contactDetail":contactDetail},
                success: function(response) {
                    setTimeout(function(){
                        jQuery('#contact_loading').hide();
                        jQuery('#msg-back-color').show();
                        jQuery("#footer-success-dialog").fadeIn({opacity:'0.8',height:'50px'});
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#footer-success-dialog').fadeOut();
                        jQuery('#msg-back-color').hide();
                        location.reload();
                    }, 4000);
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

    /*
    * Auther : Vinek T.
    * Description : Script for creating/adding users from back-end
    * Date : 4th April'2016
    */
    /*-- Add/Create users --*/
    jQuery('#btnAddPopUp').click(function() {
        jQuery('#frmAddUser')[0].reset();
        jQuery('#back-color').show();
        jQuery('.pop-up-user-form').toggle("slow");
    });
    jQuery('.close').click(function() {
        jQuery('.pop-up-user-form').hide(1000);
        jQuery('#back-color').hide();
        // setTimeout(function(){location.reload();}, 500);
    });
    jQuery('#close-user-form').click(function() {
        jQuery('.pop-up-user-form').hide(1000);
        jQuery('#back-color').hide();
        // setTimeout(function(){location.reload();}, 500);
    });
    jQuery('#btnAddUser').click(function(){
        var location_path = $(location).attr('href');
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
        if (fname == "" || lname == "" || email == "" || phone == "" || ulevel == "" || status == "") { 
            alert("Please fill all required (*) field");
            return false;
        } else if(!isValidEmailAddress(email)) {
            alert('Please provide valid mail id');
            jQuery('#txtEmail').focus();
            return false;
        } else if(phone.length < 10) {
            alert('Please provide valid phone number');
            jQuery('#txtPhone').focus();
            return false;
        } else {
            jQuery('#add_user_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('#add_user_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/processUsers.php',
                data: $("#frmAddUser").serialize(),
                dataType :'json',
                success: function(response) {
                    // alert(response);
                    if(response.success == 'yes') {
                        setTimeout(function() {
                            jQuery('#add_user_loading').hide();
                            jQuery('.pop-up-user-form').hide();
                            jQuery("#user-success-dialog").fadeIn({opacity:'0.8',height:'50px'});
                        }, 2000);
                        setTimeout(function(){
                            jQuery('#user-success-dialog').fadeOut();
                            jQuery('#back-color').hide();
                            location.reload();
                        }, 4000);
                    } else if(response.success == 'no') {
                        alert(response.message);
                        setTimeout(function(){jQuery('#add_user_loading').hide();}, 100);
                        return false;
                    } else if(response.success == 'update') {
                        setTimeout(function() {
                            jQuery('#add_user_loading').hide();
                            jQuery('.pop-up-user-form').hide();
                            jQuery("#user-success-dialog").fadeIn({opacity:'0.8',height:'50px'});
                        }, 2000);
                        setTimeout(function(){
                            jQuery('#user-success-dialog').fadeOut();
                            jQuery('#back-color').hide();
                            location.reload();
                        }, 4000);
                    }  
                }
            });
        }
    })
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for getting the updated data from database and edit/update users from back-end
    * Date : 5th April'2016
    */
    /*-- Get Edit Data --*/
    jQuery('button#editUser').click(function() {
        var user_id = jQuery(this).val();
        $.ajax({
            type: "POST",
            url: 'form-wizard/getEditUsers.php',
            data: {user_id:user_id},
            success: function(response) {
                // alert(response);
                var obj = jQuery.parseJSON(response);
                jQuery("#txtFirstName").val(obj.txtFirstName);
                jQuery("#txtLastName").val(obj.txtLastName);
                jQuery('#txtEmail').prop('readonly', true).val(obj.txtEmail);
                jQuery('#txtPhone').val(obj.txtPhone);
                jQuery('#txtAddressLine1').val(obj.txtAddressLine1);
                jQuery('#txtAddressLine2').val(obj.txtAddressLine2);
                jQuery('#txtState').val(obj.txtState);
                jQuery('#txtCity').val(obj.txtCity);
                jQuery('#txtZipcode').val(obj.txtZipcode);
                jQuery('#txtUserLevel').val(obj.txtUserLevel);
                jQuery('#txtStatus').val(obj.txtStatus);
                jQuery('#back-color').show();
                jQuery('.pop-up-user-form').toggle("slow");
                jQuery('#user_edit_value').val("Editrecord");
                jQuery('#edit_users').val(user_id);
            }
        })
    });
    /* ---- End ---- */

    
    /*-- Update Deactivate User Profile --*/
    jQuery('button#deactiveUser').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to deactive the user?")) {
            document.frmViewUsers.action = "view_users.php?status=deactive&flag="+Base64.encode(user_id);
            document.frmViewUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Update Delete User Profile --*/
    jQuery('button#deleteUser').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the user?")) {
            document.frmViewUsers.action = "view_users.php?status=delete&flag="+Base64.encode(user_id);
            document.frmViewUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Activate user profile --*/
    jQuery('button#btnActivate').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to enable/activate this user?")) {
            document.frmViewDeactiveUsers.action = "view_users_deactive.php?status=active&flag="+Base64.encode(user_id);
            document.frmViewDeactiveUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */
    
    /*-- Delete User Profile Permanently --*/
    jQuery('button#deleteUser_permant').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to permanently delete user?")) {
            document.frmViewDeactiveUsers.action = "view_users_deactive.php?status=delete&flag="+Base64.encode(user_id);
            document.frmViewDeactiveUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Activate user profile --*/
    jQuery('button#btnActivateUser').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to enable/activate this user?")) {
            document.frmViewTrashUsers.action = "trash.php?status=active&flag="+Base64.encode(user_id);
            document.frmViewTrashUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Activate user profile --*/
    jQuery('button#delete_permanant').click(function() {
        var user_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the user?")) {
            document.frmViewTrashUsers.action = "trash.php?status=delete&flag="+Base64.encode(user_id);
            document.frmViewTrashUsers.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Update Pages to Disable --*/
    jQuery('button#deletePage').click(function() {
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
    * Description : Script for updating site info and SMTP configuration from back-end
    * Date : 11th April'2016
    * Updated : 13th April'2016
    */
    jQuery('#btnSiteInfo').click(function() {
        var info_id = jQuery('#hidSiteInfoId').val();
        var site_name = jQuery('#txtSiteName').val();
        var site_lang = jQuery('#txtSiteLanguage').val();
        var site_host = jQuery('#txtSMTPhost').val();
        var site_port = jQuery('#txtSMTPport').val();
        var site_uname = jQuery('#txtSMTPuname').val();
        var site_pword = jQuery('#txtSMTPpword').val();
        var site_fromname = jQuery('#txtSMTPfromname').val();
        var site_replymail = jQuery('#txtSMTPrplymail').val();
        var site_ccmail = jQuery('#txtSMTPccmail').val();
        var site_bccmail = jQuery('#txtSMTPbccmail').val();
        var site_reg_sub = jQuery('#txtRegSub').val();
        var site_reg_mailfrom = jQuery('#txtRegMailFrom').val();
        var site_reg_body = tinyMCE.get('txtRegBody').getContent();
        var site_reg_adminbody = tinyMCE.get('txtRegAdminBody').getContent();
        var site_forgot_sub = jQuery('#txtForgotSub').val();
        var site_forgot_mailfrom = jQuery('#txtForgotMailFrom').val();
        var site_forgot_body = tinyMCE.get('txtForgotBody').getContent();
        var site_offer_sub = jQuery('#txtOfferSub').val();
        var site_offer_mailfrom = jQuery('#txtOfferMailFrom').val();
        var site_offer_body = tinyMCE.get('txtOfferBody').getContent();
        var site_account_sub = jQuery('#txtAccountSub').val();
        var site_account_mailfrom = jQuery('#txtAccountMailFrom').val();
        var site_account_body = tinyMCE.get('txtAccountBody').getContent();
        var site_account_adminbody = tinyMCE.get('txtAccountAdminBody').getContent();

        jQuery('#siteinfo_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
        jQuery('#siteinfo_loading').show();
        jQuery.ajax({
            type: "POST",
            url: 'processSiteInfo.php',
            data: {info_id:info_id,site_name:site_name,site_lang:site_lang,site_host:site_host,site_port:site_port,site_uname:site_uname,site_pword:site_pword,site_fromname:site_fromname,site_replymail:site_replymail,site_ccmail:site_ccmail,site_bccmail:site_bccmail,site_reg_sub:site_reg_sub,site_reg_mailfrom:site_reg_mailfrom,site_reg_body:site_reg_body,site_reg_adminbody:site_reg_adminbody,site_forgot_sub:site_forgot_sub,site_forgot_mailfrom:site_forgot_mailfrom,site_forgot_body:site_forgot_body,site_offer_sub:site_offer_sub,site_offer_mailfrom:site_offer_mailfrom,site_offer_body:site_offer_body,site_account_sub:site_account_sub,site_account_mailfrom:site_account_mailfrom,site_account_body:site_account_body,site_account_adminbody:site_account_adminbody},
            success: function(response) {
                // alert(response);
                setTimeout(function(){
                    jQuery('#siteinfo_loading').hide();
                    jQuery('#msg-back-color').show();
                    jQuery("#site-info-success").fadeIn({opacity:'0.8',height:'50px'});
                }, 2000);
                setTimeout(function(){
                    jQuery('#site-info-success').fadeOut();
                    jQuery('#msg-back-color').hide();
                    location.reload();
                }, 4000);
            }
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for making tabs on SMTP configuration from back-end
    * Date : 13th April'2016
    */
    jQuery(".subtab").click(function(){
        var index = jQuery(".subtab").index(this);
        if (index == 0) {
            jQuery("#subtab-div0").fadeIn("slow");
            jQuery(".nav-tabs li a").removeClass("subnav-selected");
            jQuery(".nav-tabs li:nth-child(1) a").addClass("subnav-selected");
            jQuery("#subtab-div1").hide();
            jQuery("#subtab-div2").hide();
            jQuery("#subtab-div3").hide();
            jQuery("#subtab-div4").hide();
        } else if (index == 1) {
            jQuery("#subtab-div1").fadeIn("slow");
            jQuery(".nav-tabs li a").removeClass("subnav-selected");
            jQuery(".nav-tabs li:nth-child(2) a").addClass("subnav-selected");
            jQuery("#subtab-div0").hide();
            jQuery("#subtab-div2").hide();
            jQuery("#subtab-div3").hide();
            jQuery("#subtab-div4").hide();
        } else if (index == 2) {
            jQuery("#subtab-div2").fadeIn("slow");
            jQuery(".nav-tabs li a").removeClass("subnav-selected");
            jQuery(".nav-tabs li:nth-child(3) a").addClass("subnav-selected");
            jQuery("#subtab-div0").hide();
            jQuery("#subtab-div1").hide();
            jQuery("#subtab-div3").hide();
            jQuery("#subtab-div4").hide();
        } else if (index == 3) {
            jQuery("#subtab-div3").fadeIn("slow");
            jQuery(".nav-tabs li a").removeClass("subnav-selected");
            jQuery(".nav-tabs li:nth-child(4) a").addClass("subnav-selected");
            jQuery("#subtab-div0").hide();
            jQuery("#subtab-div1").hide();
            jQuery("#subtab-div2").hide();
            jQuery("#subtab-div4").hide();
        } else if (index == 4) {
            jQuery("#subtab-div4").fadeIn("slow");
            jQuery(".nav-tabs li a").removeClass("subnav-selected");
            jQuery(".nav-tabs li:nth-child(5) a").addClass("subnav-selected");
            jQuery("#subtab-div0").hide();
            jQuery("#subtab-div1").hide();
            jQuery("#subtab-div2").hide();
            jQuery("#subtab-div3").hide();
        }
    })
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for validating the number format only
    * Date : 14th April'2016
    */
    $("#txtOffer").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(".errmsg").html("<b>Digits Only</b>").css("color","red").css("font-size","13px").show().fadeOut("slow");
            return false;
        }
    });
    $("#txtPhone").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(".errmsg").html("<b>Digits Only</b>").css("color","red").css("font-size","13px").show().fadeOut("slow");
            return false;
        }
    });
    $("#phone").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(".errmsg").html("<b>Digits Only</b>").css("color","red").css("font-size","13px").show().fadeOut("slow");
            return false;
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for validating the email-id
    * Date : 18th April'2016
    */
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        return pattern.test(emailAddress);
    }
    
    /*
    * Auther : Vinek T.
    * Description : Script for creating promotional offers from back-end
    * Date : 14th April'2016
    */
    /* ---- Create Offer Code Pop-Up ---- */
    jQuery("#btnCreateOffer").click(function(){
        jQuery('#frmCreateOffer')[0].reset();
        jQuery('#back-color').show();
        jQuery('.pop-up-form').toggle("slow");
    });
    jQuery('.close').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    jQuery('#close-offer-form').click(function() {
        jQuery('.pop-up-form').hide(1000);
        jQuery('#back-color').hide();
    });
    function generateRandomString(string_length) {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var string = '';
        for(var i = 0; i <= string_length; i++) {
            var rand = Math.round(Math.random() * (characters.length - 1));
            var character = characters.substr(rand, 1);
            string = string + character;
        }
        return string;
    }
    jQuery("#btnGeneratCode").click(function(clicked_element){
        var self = jQuery(clicked_element);
        var random_string = "UC/"+generateRandomString(7);
        jQuery('#txtPromoCode').val(random_string);
        self.remove();
    });
    jQuery('#btnSaveOffer').click(function(){
        var offerCode = jQuery('#txtPromoCode').val();
        var offerPrice = jQuery('#txtOffer').val();
        var offerTaken = jQuery('#txtOfferTaken').val();
        if ((offerCode == "") && (offerPrice == "") && (offerTaken == 0)) {
            alert('Please fill the required field');
            jQuery('#txtPromoCode').focus();
            return false;
        } else if ((offerCode == "")) {
            alert('Please generate the offer code');
            jQuery('#txtPromoCode').focus();
            return false;
        } else if ((offerPrice == "")) {
            alert('Please enter the offer amount in percent');
            jQuery('#txtOffer').focus();
            return false;
        } else if ((offerTaken == 0)) {
            alert('Please select the client mail id');
            jQuery('#txtOfferTaken').focus();
            return false;
        } else {
            jQuery('#createOffer_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('#createOffer_loading').show();
            jQuery.ajax( {
                type: "POST",
                url: 'form-wizard/processOffers.php',
                data: $("#frmCreateOffer").serialize(),
                success: function(response) {
                    // alert(response);
                    setTimeout(function() {
                        jQuery('#createOffer_loading').hide();
                        jQuery('.pop-up-form').hide();
                        jQuery("#save-offer-dialog").fadeIn({opacity:'0.8',height:'50px'});
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#save-offer-dialog').fadeOut();
                        jQuery('#back-color').hide();
                        location.reload();
                    }, 4000);
                }
            });
        }
    })
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for sharing the discount offer mail with users
    * Date : 14th April'2016
    */
    jQuery("button#shareOffer").click(function(){
        var user_id = jQuery(this).val();
        var user_email = jQuery(this).data('email');
        jQuery('#frmShareOffer')[0].reset();
        jQuery('#get_user_id').val(user_id);
        jQuery('#email-id').val(user_email);
        jQuery('#back-color').show();
        jQuery('.pop-up-form').toggle("slow");
        jQuery("#btnShareOffer").click(function(){
            var promocode = jQuery('#txtPromoCode').val();
            var promooffer = jQuery('#txtOffer').val();
            if ((promocode == "") && (promooffer == "")) {
                alert('Please fill the required field');
                jQuery('#txtPromoCode').focus();
                return false;
            } else if ((promocode == "")) {
                alert('Please generate the offer code');
                jQuery('#txtPromoCode').focus();
                return false;
            } else if ((promooffer == "")) {
                alert('Please enter the offer amount in percent');
                jQuery('#txtOffer').focus();
                return false;
            } else {
                jQuery('#shareOffer_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
                jQuery('#shareOffer_loading').show();
                jQuery.ajax({
                    type: "POST",
                    url: 'form-wizard/shareOffers.php',
                    data: $("#frmShareOffer").serialize(),
                    success: function(response) {
                        // alert(response);
                        setTimeout(function() {
                            jQuery('#shareOffer_loading').hide();
                            jQuery('.pop-up-form').hide();
                            jQuery("#success-dialog-offer").fadeIn({opacity:'0.8',height:'50px'});
                        }, 2000);
                        setTimeout(function(){
                            jQuery('#success-dialog-offer').fadeOut();
                            jQuery('#back-color').hide();
                            location.reload();
                        }, 4000);
                    }
                })
            }
        });
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for registering new user
    * Date : 18th April'2016
    */
    jQuery("#btnRegister").click(function(){
        var firstname = jQuery('#txtFirstName').val();
        var lastname = jQuery('#txtLastName').val();
        var addr1 = jQuery('#txtAddressLine1').val();
        var city = jQuery('#txtCity').val();
        var zipcode = jQuery('#txtZipcode').val();
        var email = jQuery('#txtEmail').val();
        var phone = jQuery('#txtPhone').val();

        if ((firstname == "") || (lastname == "") || (addr1 == "") || (city == 0) || (zipcode == 0) || (email == "") || (phone == "")) {
            jQuery('#succ-resp').html('Please fill all required (*) fields');
            jQuery('#succ-resp').css('color','red');
            jQuery('#succ-resp').css('font-size','13');
            return false
        } else if(!isValidEmailAddress(email)) {
            jQuery('#succ-resp').html('Please provide valid mail id');
            jQuery('#succ-resp').css('color','red');
            jQuery('#succ-resp').css('font-size','13');
            return false;
        } else if(phone.length < 10) {
            jQuery('#succ-resp').html('Please provide valid phone number');
            jQuery('#succ-resp').css('color','red');
            jQuery('#succ-resp').css('font-size','13');
            return false;
        } else {    
            jQuery('#reg_user_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#reg_user_loading').show();
            jQuery.ajax({
                type: "POST",
                url: 'form-wizard/check_register.php',
                data: $("#frm-registration").serialize(),
                dataType :'json',
                success: function(response) {
                    // alert(response);
                    if (response.success == 'yes') {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').css('color','green');
                            jQuery('#succ-resp').css('font-size','20');
                        }, 2000);
                    } else {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var err_mesg = JSON.stringify(response.message);
                            err_mesg = err_mesg.replace(/^"/, "");
                            err_mesg = err_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(err_mesg);
                            jQuery('#succ-resp').css('color','red');
                            jQuery('#succ-resp').css('font-size','20');
                        }, 2000);
                    }
                }
            })
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for change profile & account settings for admin
    * Date : 19th April'2016
    */
    /* ---- Admin profile ---- */
    jQuery("#profile").click(function(){
        var user_id = jQuery('#get_user').val();
        $.ajax({
            type: "POST",
            url: baseuri+'/admin/include/getAdmin.php',
            data: {user_id:user_id},
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                jQuery('#firstName').val(obj.txtFirstName);
                jQuery('#lastName').val(obj.txtLastName);
                jQuery('#email').prop('readonly', true).val(obj.txtEmail);
                jQuery('#phone').val(obj.txtPhone);
                jQuery('#addressLine1').val(obj.txtAddressLine1);
                jQuery('#addressLine2').val(obj.txtAddressLine2);
                jQuery('#country').val(obj.txtCountry);
                jQuery('#state').val(obj.txtState);
                jQuery('#city').val(obj.txtCity);
                jQuery('#zipcode').val(obj.txtZipcode);
                jQuery('#userlevel').val(obj.txtUserLevel);
                jQuery('#status').val(obj.txtStatus);
                jQuery('#admin-back-color').show();
                jQuery(".dropdown-menu").slideUp('fast');
                jQuery('.account-pop-up-form').fadeOut();
                jQuery('.profile-pop-up-form').toggle('slow');
            }
        })
    });
    jQuery('.close').click(function() {
        jQuery('.profile-pop-up-form').hide(1000);
        jQuery('#admin-back-color').hide();
    });
    jQuery('#close-admin-profile').click(function() {
        jQuery('.profile-pop-up-form').hide(1000);
        jQuery('#admin-back-color').hide();
    });
    jQuery("#btnAdminInfo").click(function(){
        jQuery('#admin_profile_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#admin_profile_loading').show();
        $.ajax({
            type: "POST",
            url: baseuri+'/admin/include/updateAdmin.php',
            data: $('#frmAdminProfile').serialize(),
            success: function(response) {
                setTimeout(function() {
                    jQuery('#admin_profile_loading').hide();
                    jQuery('.profile-pop-up-form').hide();
                    jQuery('#admin-back-color').hide();
                    jQuery("#success-dialog").fadeIn({opacity:'0.9',height:'50px'});
                }, 2000);
                setTimeout(function(){
                    jQuery('#success-dialog').fadeOut();
                    location.reload();
                }, 4000);
            }
        })
    });
    /* ---- End ---- */

    /* ---- Admin account settings ---- */
    jQuery("#account").click(function(){
        var user_id = jQuery('#get_user').val();
        $.ajax({
            type: "POST",
            url: baseuri+'/admin/include/getAccount.php',
            data: {user_id:user_id},
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                jQuery('#emailid').prop('readonly', true).val(obj.txtEmail);
                jQuery('#username').prop('readonly', true).val(obj.txtUsername);
                jQuery('#password').val(Base64.decode(obj.txtPassword));
                jQuery('#admin-back-color').show();
                jQuery(".dropdown-menu").slideUp('fast');
                jQuery('.pop-up-form').fadeOut();
                jQuery('.account-pop-up-form').toggle('slow');
            }
        })
    });
    jQuery('.close').click(function() {
        jQuery('.account-pop-up-form').hide(1000);
        jQuery('#admin-back-color').hide();
    });
    jQuery('#close-admin-account').click(function() {
        jQuery('.account-pop-up-form').hide(1000);
        jQuery('#admin-back-color').hide();
    });
    jQuery("#btnAdminAcc").click(function(){
        var user_id = jQuery('#get_user').val();
        jQuery('#admin_account_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#admin_account_loading').show();
        $.ajax({
            type: "POST",
            url: baseuri+'/admin/include/updateAdmin.php',
            data: $('#frmAdminAccount').serialize(),
            success: function(response) {
                setTimeout(function() {
                    jQuery('#admin_account_loading').hide();
                    jQuery('.account-pop-up-form').hide();
                    jQuery('#admin-back-color').hide();
                    jQuery("#success-dialog").fadeIn({opacity:'0.9',height:'50px'});
                }, 2000);
                setTimeout(function(){
                    jQuery('#success-dialog').fadeOut();
                    location.reload();
                }, 4000);
            }
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for changing the zipcodes, cities, multiple users activation, multiple users deletion etc.
    * Date : 20th April'2016
    */
    /* ---- Script for changes in zipcode by changing in cities ---- */
    jQuery('#frmAddUser #txtCity').change(function() {
        var city = jQuery(this).find(':selected').data('property');
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/changeZipcode.php',
            data: { city : city },
            success: function(response){
                jQuery("#txtZipcode").html(response);
            }
        });
    });
    /* ---- End ---- */

    /* ---- Script for multiple checked / unchecked by clicking on checkbox ---- */
    jQuery('#selAllUser').click(function(event) {
        if (this.checked) {
            jQuery('.checkbox1').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.checkbox1').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */
    
    /* ---- Script for multiple moves/activate the user ---- */
    jQuery("#btnMoveAll").click(function() {
        var inputs = jQuery('input#allSelect');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelect" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelect[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one user(s) to activate");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to enable/activate the user?");
        } else {
            res = confirm("Are you sure you want to enable/activate these users?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {allSelect:vals,status:"moveAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the user ---- */
    jQuery("#btnDeleteAll").click(function() {
        var inputs = jQuery('input#allSelect');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelect" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelect[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one user(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the user?");
        } else {
            res = confirm("Are you sure you want to delete these users?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {allSelect:vals,status:"deleteAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for multiple pages select, multiple pages activation, multiple pages deletion etc.
    * Date : 21th April'2016
    */
    /* ---- Script for multiple checked / unchecked by clicking on checkbox ---- */
    jQuery('#selAllPage').click(function(event) {
        if (this.checked) {
            jQuery('.check-page').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.check-page').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */
    
    /* ---- Script for multiple publishes the pages ---- */
    jQuery("#btnMoveAllPage").click(function() {
        var inputs = jQuery('input#allSelPage');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelPage" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelPage[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one page(s) to publish");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to publish the page?");
        } else {
            res = confirm("Are you sure you want to publish these pages?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/pageAction.php',
                data: {allSelPage:vals,status:"moveAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the pages ---- */
    jQuery("#btnDeleteAllPage").click(function() {
        var inputs = jQuery('input#allSelPage');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelPage" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelPage[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one page(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the page?");
        } else {
            res = confirm("Are you sure you want to delete these pages?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/pageAction.php',
                data: {allSelPage:vals,status:"deleteAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for to send a request for forgot password and reset the password.
    * Date : 21th April'2016
    */
    /* ---- Script for forgot password on front-end---- */
    jQuery("#btnForPass").click(function(){
        var email = jQuery('#txtEmail').val();
        if (email == "") {
            jQuery('input#txtEmail').focus();
            jQuery('input#txtEmail').css('border-color','red');
            jQuery("input#txtEmail").attr("placeholder","Please provide mail id");
            jQuery("input#txtEmail").addClass('inputfocus');
            return false
        } else if(!isValidEmailAddress(email)) {
            jQuery("input#txtEmail").val('');
            jQuery('input#txtEmail').focus();
            jQuery('input#txtEmail').css('border-color','red');
            jQuery("input#txtEmail").attr("placeholder","Please provide valid mail id");
            jQuery("input#txtEmail").addClass('inputfocus');
            return false;
        } else {    
            jQuery('#reg_user_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#reg_user_loading').show();
            jQuery.ajax({
                type: "POST",
                url: 'form-wizard/check_password.php',
                data: $("#frmForpass").serialize(),
                dataType :'json',
                success: function(response) {
                    if (response.error == 'yes') {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').css('color','green');
                            jQuery('#succ-resp').css('font-size','20');
                        }, 3000);    
                    } else if (response.error == 'no') {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').css('color','red');
                            jQuery('#succ-resp').css('font-size','20');
                        }, 3000);    
                    }
                }
            })
        }
    });
    /* ---- End ---- */

    /* ---- Script for reset password on front-end---- */
    jQuery("#btnResetPass").click(function(){
        var pass_word = jQuery('#txtPassword').val();
        var con_Pass = jQuery('#txtConfirmPass').val();
        
        if (pass_word == "") {
            jQuery('input#txtPassword').focus();
            jQuery('input#txtPassword').css('border-color','red');
            jQuery("input#txtPassword").attr("placeholder","Please enter password");
            jQuery("input#txtPassword").addClass('inputfocus');
            return false
        } else if (pass_word.length < 6) {
            jQuery('input#txtPassword').val('');
            jQuery('input#txtPassword').focus();
            jQuery('input#txtPassword').css('border-color','red');
            jQuery("input#txtPassword").attr("placeholder","Password must be atleast 6 char long");
            jQuery("input#txtPassword").addClass('inputfocus');
            return false
        } else if (con_Pass == "") {
            jQuery('input#txtConfirmPass').focus();
            jQuery('input#txtConfirmPass').css('border-color','red');
            jQuery("input#txtConfirmPass").attr("placeholder","Please repeat password");
            jQuery("input#txtConfirmPass").addClass('inputfocus');
            return false
        } else if (con_Pass.length < 6) {
            jQuery('input#txtConfirmPass').val('');
            jQuery('input#txtConfirmPass').focus();
            jQuery('input#txtConfirmPass').css('border-color','red');
            jQuery("input#txtConfirmPass").attr("placeholder","Password must be atleast 6 char long");
            jQuery("input#txtConfirmPass").addClass('inputfocus');
        } else if (pass_word != con_Pass) {
            alert('Password & Repeat Password should be same');
            jQuery('input#txtConfirmPass').val('');
            jQuery('input#txtConfirmPass').focus();
            return false
        } else {
            jQuery('#reg_user_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#reg_user_loading').show();
            jQuery.ajax({
                type: "POST",
                url: 'form-wizard/check_resetpassword.php',
                data: $("#frmResetPass").serialize(),
                dataType :'json',
                success: function(response) {
                    // alert(response);
                    if (response.error == 'yes') {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#shows').empty();
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').css('color','green');
                            jQuery('#succ-resp').css('font-size','20');
                            jQuery('#frmResetPass')[0].reset();
                        }, 3000);
                        setTimeout(function() { window.location = baseuri+'/user/' }, 6000);
                    } else if (response.error == 'no') {
                        setTimeout(function() {
                            jQuery('#reg_user_loading').hide();
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#shows').empty();
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').css('color','red');
                            jQuery('#succ-resp').css('font-size','20');
                            jQuery('#frmResetPass')[0].reset();
                        }, 3000);    
                    }
                }
            })
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for to delete mul-active users and delete mul-active pages
    * Date : 25th April'2016
    */
    /* ---- Script for delete all active user from back-end---- */
    jQuery("#btnDelActUsers").click(function() {
        var inputs = jQuery('input#allSelect');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelect" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelect[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one user(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the user?");
        } else {
            res = confirm("Are you sure you want to delete these users?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {allSelect:vals,status:"delAllActUser"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for delete all active pages from back-end---- */
    jQuery("#btnDelActPages").click(function() {
        var inputs = jQuery('input#allSelPage');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelPage" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelPage[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one page(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the page?");
        } else {
            res = confirm("Are you sure you want to delete these pages?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/pageAction.php',
                data: {allSelPage:vals,status:"deleteAllActPages"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple moves/activate the user ---- */
    jQuery("#btnActivateAll").click(function() {
        var inputs = jQuery('input#allSelect');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelect" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelect[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one user(s) to activate");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to enable/activate the user?");
        } else {
            res = confirm("Are you sure you want to enable/activate these users?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {allSelect:vals,status:"activeAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the user ---- */
    jQuery("#btnDeleteAllPermanant").click(function() {
        var inputs = jQuery('input#allSelect');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelect" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelect[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one user(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the user permanantly?");
        } else {
            res = confirm("Are you sure you want to delete these users permanantly?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {allSelect:vals,status:"deleteAllPer"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for to restrict zero to enter in discount offer field
    * Date : 29th April'2016
    */
    jQuery(document).on('keyup','.restrict-zero', function(event){
        var input = event.currentTarget.value;
        if(input.search(/^0/) != -1){
            alert("Invalid");
            jQuery('.restrict-zero').val('');
            return false;
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for to change zipcode by changing city
    * Date : 2nd May'2016
    */
    jQuery('#frm-registration #txtCity').change(function() {
        var city = jQuery(this).find(':selected').data('property');
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/check_zipcode.php',
            data: { city : city },
            success: function(response){
                jQuery("#txtZipcode").html(response);
            }
        });
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for to change zipcode by changing city
    * Date : 2nd May'2016
    */
    jQuery('.clean_process').click(function() {
        var process_id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/preview_booking.php',
            data: { process_id:process_id },
            success: function(response) {
                jQuery(".modal-body").html(response);
                jQuery("#preview-process").modal('show');
            }    
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for viewing the rating on each services
    * Date : 13th May'2016
    */
    jQuery('button#viewRating').click(function() {
        var rate_id = jQuery(this).val();
        // alert(rate_id);
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/preview_rating.php',
            data: { rate_id:rate_id },
            success: function(response) {
                // alert(response);
                jQuery("#view-rate").html(response);
                jQuery("#preview-rating").modal('show');
            }    
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for multiple booked service select and delete the sevice etc.
    * Date : 17th May'2016
    */
    /* ---- Script for multiple checked / unchecked by clicking on checkbox ---- */
    jQuery('#selAllProcess').click(function(event) {
        if (this.checked) {
            jQuery('.chkService').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.chkService').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the booked services ---- */
    jQuery("#btnDelAllBooking").click(function() {
        var inputs = jQuery('input#selProcess');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "selProcess" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='selProcess[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one service(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the booked service?");
        } else {
            res = confirm("Are you sure you want to delete these booked service(s)?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {selProcess:vals,status:"deleteAll"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the booked services permanantly ---- */
    jQuery("#btnDelAllPermanantly").click(function() {
        var inputs = jQuery('input#selProcess');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "selProcess" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='selProcess[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one service(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the service permanantly?");
        } else {
            res = confirm("Are you sure you want to delete these service(s) permanantly?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {selProcess:vals,status:"deletePermanantly"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple activation of the booked services ---- */
    jQuery("#btnEnableSer").click(function() {
        var inputs = jQuery('input#selProcess');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "selProcess" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='selProcess[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one service(s) to active");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to active the service?");
        } else {
            res = confirm("Are you sure you want to active these service(s)?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/delete.php',
                data: {selProcess:vals,status:"moveActive"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for trash pending services ---- */
    jQuery("button#trashPendingService").click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the service?")) {
            document.frmViewBooking.action = "pending_services.php?status=pending_trash&flag="+Base64.encode(book_id);
            document.frmViewBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for trash complete services ---- */
    jQuery("button#trashCompleteService").click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the service?")) {
            document.frmViewBooking.action = "complete_services.php?status=complete_trash&flag="+Base64.encode(book_id);
            document.frmViewBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for delete booked services ---- */
    jQuery("button#deleteService").click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the service?")) {
            document.frmViewTrashBooking.action = "trash.php?status=delete&flag="+Base64.encode(book_id);
            document.frmViewTrashBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for read more remark writtenin start comment ---- */
    jQuery("a#read-more").on('click', function(){
        var more = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/getComments.php',
            data: {more:more},
            success: function(response) {
                jQuery("#pre-comment").html(response);
                jQuery("#comment-pop-up").modal('show');
            }        
        });
    });
    /* ---- End ---- */

    /* ---- Script for delete rating given to services ---- */
    jQuery("button#deleteRating").click(function() {
        var rate_id = jQuery(this).val();
        if(confirm("Are you sure you want to delete the rating?")) {
            document.frmViewRating.action = "view_ratings.php?status=delete&flag="+Base64.encode(rate_id);
            document.frmViewRating.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple checked / unchecked by clicking on checkbox on rating ---- */
    jQuery('#selAllRating').click(function(event) {
        if (this.checked) {
            jQuery('.chkAllReat').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.chkAllReat').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the applications from trash ---- */
    jQuery("#btnDelAllRating").click(function() {
        var inputs = jQuery('input#selAllRate');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "selAllRate" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='selAllRate[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one review to delete permanently");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete this review permanently?");
        } else {
            res = confirm("Are you sure you want to delete these review(s) permanently?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/deleteRating.php',
                data: {selAllRate:vals,flag:"multidel"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for making quize with adding question, edit question, view question, update answers etc.
    * Date : 19th May'2016
    */
    /* ---- Script for adding new question ---- */
    jQuery('#btnCreateQuize').click(function(event) {
        var formdata = jQuery("#frmAddQuestion").serialize();
        var que = jQuery("#txtQuestion").val();
        var ans = jQuery("#txtAnswer").val();
        var opt_one = jQuery("#txtOptionOne").val();
        var opt_two = jQuery("#txtOptionTwo").val();
        if (que == "" || ans == "" || opt_one == "" || opt_two == "") {
            alert("Please fill the required (*) fields.");
            return false;
        } else {
            jQuery('#ques_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#ques_loading').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/processQuiz.php',
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    if (response.success == 'add') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'one') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'two') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'three') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'four') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                }        
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for editing the question ---- */
    jQuery('#btnEditQuize').click(function(event) {
        var formdata = jQuery("#frmEditQuestion").serialize();
        var que = jQuery("#txtQuestion").val();
        var ans = jQuery("#txtAnswer").val();
        var opt_one = jQuery("#txtOptionOne").val();
        var opt_two = jQuery("#txtOptionTwo").val();
        if (que == "" || ans == "" || opt_one == "" || opt_two == "") {
            alert("Please fill the required (*) fields.");
            return false;
        } else {
            jQuery('#ques_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#ques_loading').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/processQuiz.php',
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    if (response.success == 'edit') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'one') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'two') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'three') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                    if (response.success == 'four') {
                        setTimeout(function() {
                            jQuery('#ques_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#succ-resp').html(suc_mesg);
                            jQuery('#succ-resp').fadeIn(500);
                            jQuery('#succ-resp').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#succ-resp').fadeOut();}, 4000);
                    }
                }        
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for view detail question ---- */
    jQuery('button#viewQue').click(function(event) {
        var queId = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/questions.php',
            data: {queId:queId,flag:'view'},
            success: function(response) {
                jQuery("#view_que").html(response);
                jQuery('#view-question').modal('show');
            }        
        });
    });
    /* ---- End ---- */

    /* ---- Script for disable question ---- */
    jQuery('button#disableQue').click(function() {
        var queId = jQuery(this).val();
        if(confirm("Are you sure you want to disable the question?")) {
            document.frmViewQuestion.action = "view_questions.php?status=disable&flag="+Base64.encode(queId);
            document.frmViewQuestion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for enable question ---- */
    jQuery('button#enableQue').click(function() {
        var queId = jQuery(this).val();
        if(confirm("Are you sure you want to enable the question?")) {
            document.frmViewQuestion.action = "view_questions.php?status=enable&flag="+Base64.encode(queId);
            document.frmViewQuestion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for delete question ---- */
    jQuery('button#deleteQue').click(function() {
        var queId = jQuery(this).val();
        if(confirm("Are you sure you want to delete this question?")) {
            document.frmViewQuestion.action = "view_questions.php?status=delete&flag="+Base64.encode(queId);
            document.frmViewQuestion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple checked / unchecked by clicking on checkbox on questions ---- */
    jQuery('#selAllQue').click(function(event) {
        if (this.checked) {
            jQuery('.check-que').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.check-que').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple trash the questions ---- */
    jQuery("#btnTrashQue").click(function() {
        var inputs = jQuery('input#allSelQue');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelQue" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelQue[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one question(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the question?");
        } else {
            res = confirm("Are you sure you want to delete these question(s)?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/questions.php',
                data: {allSelQue:vals,flag:"multitrash"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */


    /* ---- Script for making notification ---- */
    jQuery('#main-notify').click(function() {
        jQuery.ajax({
            type: 'POST',
            url: baseuri+'/admin/include/getNotification.php',
            data: {complete_nitify:'complete_nitify'},
            success: function(response) {
                jQuery('#sub-notify').slideToggle('fast');
                jQuery('#sub-notify').html(response);
            }
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for setting up the datepicker, timepicker & booking parameter for craeting a new service
    * Date : 26th may'2016
    */
    var date = new Date();
    date.setDate(date.getDate()-0);
    jQuery('#txtServiceDate').datepicker({
        format: 'yyyy-mm-dd',
        startDate: date,
        autoclose: true
    });
    jQuery("#cal").click(function() { 
        jQuery("#txtServiceDate").datepicker("show");
    });
    jQuery('#txtServiceTime').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia',
    });
    jQuery("#time").click(function() { 
        jQuery("#txtServiceTime").timepicker("show");
    });
    /* ---- End ---- */


    /*-- Initializing calculation variables for booking form --*/
    var bathroom = [
        [],
        [1, 2],
        [1, 2],
        [1, 2, 3],
        [1, 2, 3],
        [1, 2, 3, 4],
        [1, 2, 3, 4, 5],
        [1, 2, 3, 4, 5, 6]
    ];

    var bathrooms;
    var service_price = 0.0;
    var bedroom = 0;
    var price = 0.0;
    var bathroom_options = $("#txtBathroom");
    var hours_options = $("#txtServiceHours");
    var prices_options = $("#txtServiceAmt");
    var price_value = 0.0;
    var price_text = 0.0;
    var hour_value = 0;
    var hour_text = 0;
    var extra_hour = 0;

    var cal_data = {
        "1": [{
            "2.0": 60,
            "2.5": 75
        }],
        "2": [{
            "3.0": 90,
            "3.5": 105,
            "4.0": 120,
            "4.5": 135
        }],
        "3": [{
            "5.0": 150,
            "5.5": 165,
            "6.0": 180,
            "6.5": 195
        }],
        "4": [{
            "7.0": 210,
            "7.5": 225,
            "8.0": 240,
            "8.5": 255
        }],
        "5": [{
            "9.0": 270,
            "9.5": 285,
            "10.0": 300,
            "10.5": 315
        }],
        "6": [{
            "11.0": 330,
            "11.5": 345,
            "12.0": 360,
            "12.5": 375
        }],
        "7": [{"0": 0}]
    };
    /* ---- End ---- */

    /*On change bedroom Selection*/
    $("#txtBedroom").change(function() {
        filter_type = 'bedroom';
        bedroom = $(this).val();
        bathroom_options.html('');
        hours_options.html('');
        prices_options.html('');
        if (bedroom !== null || bedroom !== "") {
            if (filter_type == 'bedroom') {
                var price = 0;
                $.each(cal_data[bedroom], function(index, jsonObject) {
                    $.each(jsonObject, function(index, value) {
                        var temp = index.toString();
                        var val = value.toString();
                        var lastNum = parseInt(temp[temp.length - 1]); // it's 2
                        if(lastNum == 0){
                            index = index.slice(0, -2);
                        }
                        hours_options.append(new Option(index, index));
                        prices_options.append(new Option(Number(value + price), Number(value + price)));
                    });
                    $.each(bathroom[bedroom], function(index, value) {
                        bathroom_options.append(new Option(value, value));
                    });
                    var tot_sel = $('#txtServiceAmt option:selected').val();
                    $('#hidServiceAmt').val(tot_sel);
                });
            }
        }
        
    });
    /* ---- End ---- */

    /*-- Change total on hours selection --*/
    $("#txtServiceHours").change(function() {
        var selectedIndex = $(this)[0].selectedIndex;
        var price_options = $('#txtServiceAmt option').eq(selectedIndex).prop('selected', true);
        var obj_val = $( "#txtServiceAmt option:selected" ).val();
        $('#hidServiceAmt').val(obj_val);
    });
    /* ---- End ---- */

    /*-- Display total on extra services selection --*/
    $(":checkbox").on("change", function() {
        $("#txtExtraServiceHrs").val(function() {
            var sum = 0;
            $(":checkbox:checked").each(function() {
                service_hours = Number($(this).data('servicehrs'));
                sum += +service_hours;
            });
            return sum;
        });
        $("#txtExtraServiceAmt").val(function() {
            var sum = 0;
            $(":checkbox:checked").each(function() {
                service_amt = Number($(this).data('serviceprice'));
                sum += +service_amt;
            });
            return sum;
        });
    });
    /* ---- End ---- */

    /*-- Script for preview the current booking form fields --*/
    jQuery('#btnPreviewNew').click(function() {
        var bedroom = jQuery('#txtBedroom').val();
        var service_date = jQuery('#txtServiceDate').val();
        var service_time = jQuery('#txtServiceTime').val();
        if (bedroom == 0 || service_date == '' || service_time == '') {
            alert("Please fill all required fields");
            return false;
        } else {
            var formdata = jQuery("#frmNewBooking").serialize();
            var modal_preview = '';
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/new_booking_preview.php',
                data: formdata,
                success: function(response) {
                    jQuery(".modal-body").html(response);
                    jQuery("#book-preview").modal('show');
                }
            });
        }
    });
    /* ---- End ---- */

    /*-- Script for preview the update booking form fields --*/
    jQuery('#btnPreviewEdit').click(function() {
        var bedroom = jQuery('#txtBedroom').val();
        var service_date = jQuery('#txtServiceDate').val();
        var service_time = jQuery('#txtServiceTime').val();
        if (bedroom == 0 || service_date == '' || service_time == '') {
            alert("Please fill all required fields");
            return false;
        } else {
            var formdata = jQuery("#frmUpdateBooking").serialize();
            var modal_preview = '';
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/new_booking_preview.php',
                data: formdata,
                success: function(response) {
                    jQuery(".modal-body").html(response);
                    jQuery("#book-preview").modal('show');
                }
            });
        }
    });
    /* ---- End ---- */

    /*-- Script for create the new booking service --*/
    jQuery('#btnNewBook').click(function() {
        var bedroom = jQuery('#txtBedroom').val();
        var service_date = jQuery('#txtServiceDate').val();
        var service_time = jQuery('#txtServiceTime').val();
        if (!jQuery('input[name=rdoUser]:checked').val() ) {          
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            jQuery("#getUser").slideDown();
            jQuery('#txtSearchUser').focus();
            jQuery("#txtSearchUser").attr("placeholder","Please search for user first...");
            jQuery("#txtSearchUser").addClass('inputfocus');
            return false
            return false;
        } else if (bedroom == 0 || service_date == '' || service_time == '') {
            alert("Please fill all required fields");
            return false;
        } else {
            var formdata = jQuery("#frmNewBooking").serialize();
            jQuery('#service_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#service_loading').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/create_booking.php',
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    if (response.err == 'create') {
                        setTimeout(function() {
                            jQuery('#service_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#booking-service').html(suc_mesg);
                            jQuery('#booking-service').fadeIn(500);
                            jQuery('#booking-service').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#booking-service').fadeOut();}, 3000);
                    }
                }
            });
        }
    });
    /* ---- End ---- */

    /*-- Script for update the booking service --*/
    jQuery('#btnEditBook').click(function() {
        var bedroom = jQuery('#txtBedroom').val();
        var service_date = jQuery('#txtServiceDate').val();
        var service_time = jQuery('#txtServiceTime').val();
        if (bedroom == 0 || service_date == '' || service_time == '') {
            alert("Please fill all required fields");
            return false;
        } else {
            var formdata = jQuery("#frmUpdateBooking").serialize();
            jQuery('#service_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
            jQuery('#service_loading').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/create_booking.php',
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    if (response.err == 'update') {
                        setTimeout(function() {
                            jQuery('#service_loading').hide();
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            var suc_mesg = JSON.stringify(response.message);
                            suc_mesg = suc_mesg.replace(/^"/, "");
                            suc_mesg = suc_mesg.replace(/"$/, "");
                            jQuery('#booking-service').html(suc_mesg);
                            jQuery('#booking-service').fadeIn(500);
                            jQuery('#booking-service').css({
                                'background-color':'green',
                                'border-radius':'3px',
                                'color':'#ffffff',
                                'font-size':'15px',
                                'font-weight':'600',
                                'padding':'10px',
                                'text-align':'center'
                            });
                        }, 1000);
                        setTimeout(function() {jQuery('#booking-service').fadeOut();}, 3000);
                    }
                }
            });
        }
    });
    /* ---- End ---- */

    /*-- Script for cancel the booking service --*/
    jQuery('button#cancelBooking').click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to cancel this service?")) {
            document.frmViewBooking.action = "pending_services.php?status=cancel&flag="+Base64.encode(book_id);
            document.frmViewBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Script for complete the booking service --*/
    jQuery('button#completeService').click(function() {
        var book_id = jQuery(this).val();
        alert(book_id);
        if(confirm("Are you sure you want to make complete this service?")) {
            document.frmViewBooking.action = "pending_services.php?status=complete&flag="+Base64.encode(book_id);
            document.frmViewBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Script for complete the booking on edit service page --*/
    jQuery('#completedService').click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to make complete this service?")) {
            document.frmUpdateBooking.action = "edit_services.php?status=complete&flag="+Base64.encode(book_id);
            document.frmUpdateBooking.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Script for getting user for booking services --*/
    jQuery('#seluser').click(function() {
        jQuery("#getUser").slideToggle();
        jQuery("#txtSearchUser").focus();
    });
    /* ---- End ---- */

    /*-- Script for getting only one user to be display --*/
    jQuery('.chk-rdo').click(function() {
        var user_click = jQuery('input[name=rdoUser]:checked').val();
        if (user_click) {
            var uname = jQuery('#rdoUser'+user_click).attr("data-userval");
            jQuery("#txtSearchUser").val(uname);
            jQuery("#tab-hid").hide();
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for viewing the application form and multiple delete and edit and single delete the appl forms
    * Date : 9th June'2016
    */
    /*-- Script for viewing applications --*/
    jQuery('button#view-appl').click(function() {
        var applid = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/applications.php',
            data: {applid:applid, flag:"view"},
            success: function(response) {
                jQuery("#view_appl").html(response);
                jQuery('#view-applications').modal('show');
            }
        });
        
    });
    /* ---- End ---- */

    /*-- Script for trashing applications --*/
    jQuery('button#delete-appl').click(function() {
        var applid = jQuery(this).val();
        if(confirm("Are you sure you want to delete this application?")) {
            document.frmViewApplicaion.action = "view_applications.php?status=trash&flag="+Base64.encode(applid);
            document.frmViewApplicaion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Script for enabling applications --*/
    jQuery('button#enable-appl').click(function() {
        var applid = jQuery(this).val();
        if(confirm("Are you sure you want to enable this application?")) {
            document.frmTrashApplicaion.action = "trash.php?status=enable&flag="+Base64.encode(applid);
            document.frmTrashApplicaion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*-- Script for delete permanently applications --*/
    jQuery('button#delete-permanentappl').click(function() {
        var applid = jQuery(this).val();
        if(confirm("Are you sure you want to delete this application permanently?")) {
            document.frmTrashApplicaion.action = "trash.php?status=delete&flag="+Base64.encode(applid);
            document.frmTrashApplicaion.submit();
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple checked / unchecked by clicking on checkbox on applications ---- */
    jQuery('#selAllAppl').click(function(event) {
        if (this.checked) {
            jQuery('.check-appl').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.check-appl').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple trash the applications ---- */
    jQuery("#btnTrashAppls").click(function() {
        var inputs = jQuery('input#allSelAllp');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allSelAllp" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allSelAllp[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one application(s) to delete");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete the application?");
        } else {
            res = confirm("Are you sure you want to delete these application(s)?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/applications.php',
                data: {allSelAllp:vals,flag:"multitrash"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for multil delete, view, enable and permanant delete from trash
    * Date : 10th June'2016
    */
    /* ---- Script for multiple checked / unchecked by clicking on checkbox on trash applications ---- */
    jQuery('#delAllAppl').click(function(event) {
        if (this.checked) {
            jQuery('.check-trashappl').each(function() {
                this.checked = true;
            });
        } else {
            jQuery('.check-trashappl').each(function() {
                this.checked = false;
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the applications from trash ---- */
    jQuery("#btnDeleteAppls").click(function() {
        var inputs = jQuery('input#allDelAllp');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allDelAllp" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allDelAllp[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one application(s) to delete permanently");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete this application permanently?");
        } else {
            res = confirm("Are you sure you want to delete these application(s) permanently?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/applications.php',
                data: {allDelAllp:vals,flag:"multidel"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for multiple delete the applications from trash ---- */
    jQuery("#btnDeleteAppls").click(function() {
        var inputs = jQuery('input#allDelAllp');
        var vals = [];
        var res;
        for(var i = 0; i < inputs.length; i++) { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(inputs[i].id == "allDelAllp" && inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = jQuery("[name='allDelAllp[]']:checked").length; 
        if(count_checked == 0) {
            alert("Please select atleast one application(s) to delete permanently");
            return false;
        } else if(count_checked == 1) {
            res = confirm("Are you sure you want to delete this application permanently?");
        } else {
            res = confirm("Are you sure you want to delete these application(s) permanently?");
        }
        if (res) {
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/applications.php',
                data: {allDelAllp:vals,flag:"multidel"},
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
    /* ---- End ---- */

    /* ---- Script for getting the correct ans value on testfield ---- */
    jQuery("input[name=rdoCorrect]").click(function(){
        if(jQuery("#rdoCorrectOne").is(":checked")) {
            var val_one = jQuery("#txtOptionOne").val();
            jQuery("#txtAnswer").val(val_one);
        } else if(jQuery("#rdoCorrectTwo").is(":checked")) {
            var val_two = jQuery("#txtOptionTwo").val();
            jQuery("#txtAnswer").val(val_two);
        } else if(jQuery("#rdoCorrectThree").is(":checked")) {
            var val_three = jQuery("#txtOptionThree").val();
            jQuery("#txtAnswer").val(val_three);
        } else if(jQuery("#rdoCorrectFour").is(":checked")) {
            var val_four = jQuery("#txtOptionFour").val();
            jQuery("#txtAnswer").val(val_four);
        }
    })    
    /* ---- End ---- */

});


/*
* Auther : Vinek T.
* Description : Script for making notification
* Date : 23th May'2016
*/
(function showUpNotty(){
    setTimeout(showUpNotty, 10000);
    var baseuri = window.location.origin+'/cleaning';
    jQuery.ajax({
        type: 'POST',
        url: baseuri+'/admin/include/getNotification.php',
        data: {count:'count'},
        success: function(response) {
            jQuery('#sub-notify').html(response);
            var tot_noti = jQuery('input[name=hidNottyTot]').val();
            jQuery('#show-notty-tot').html(tot_noti);
        }
    })
})();

