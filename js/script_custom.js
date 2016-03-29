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
