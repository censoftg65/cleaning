
/*
* Auther : Vinek T.
* Description : Script for user dashboard & booking form functonalities
* Date : 26th April'16
*/
$(document).ready(function(){
    /*
    * Auther : Vinek T.
    * Description : Script for ajax sereaching
    * Date : 16th May'2016
    */
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

    /*
    * Auther : Vinek T.
    * Description : Script for setting up the datepicker and timepicker
    * Date : 26th March'2016
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

    /* -- Initialize the variable for base url, base64_encode, base64_decodes, email-id & number validator -- */
    var baseuri = window.location.origin+'/cleaning';
    var Base64 = {
        _keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        encode:function(e){
            var t="";
            var n,r,i,s,o,u,a;
            var f=0;
            e=Base64._utf8_encode(e);
            while(f<e.length){
                n=e.charCodeAt(f++);
                r=e.charCodeAt(f++);
                i=e.charCodeAt(f++);
                s=n>>2;
                o=(n&3)<<4|r>>4;
                u=(r&15)<<2|i>>6;
                a=i&63;
                if(isNaN(r)){
                    u=a=64
                }else if(isNaN(i)){
                    a=64
                }
                t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)
            }
            return t
        },
        decode:function(e){
            var t="";
            var n,r,i;
            var s,o,u,a;
            var f=0;
            e=e.replace(/[^A-Za-z0-9+/=]/g,"");
            while(f<e.length){
                s=this._keyStr.indexOf(e.charAt(f++));
                o=this._keyStr.indexOf(e.charAt(f++));
                u=this._keyStr.indexOf(e.charAt(f++));
                a=this._keyStr.indexOf(e.charAt(f++));
                n=s<<2|o>>4;
                r=(o&15)<<4|u>>2;
                i=(u&3)<<6|a;
                t=t+String.fromCharCode(n);
                if(u!=64){
                    t=t+String.fromCharCode(r)
                }
                if(a!=64){
                    t=t+String.fromCharCode(i)
                }
            }
            t=Base64._utf8_decode(t);
            return t
        },
        _utf8_encode:function(e){
            e=e.replace(/rn/g,"n");
            var t="";
            for(var n=0;n<e.length;n++){
                var r=e.charCodeAt(n);
                if(r<128){
                    t+=String.fromCharCode(r)
                }else if(r>127&&r<2048){
                    t+=String.fromCharCode(r>>6|192);
                    t+=String.fromCharCode(r&63|128)
                }else{
                    t+=String.fromCharCode(r>>12|224);
                    t+=String.fromCharCode(r>>6&63|128);
                    t+=String.fromCharCode(r&63|128)
                }
            }
            return t
        },
        _utf8_decode:function(e){
            var t="";
            var n=0;
            var r=c1=c2=0;
            while(n<e.length){
                r=e.charCodeAt(n);
                if(r<128){
                    t+=String.fromCharCode(r);
                    n++
                }else if(r>191&&r<224){
                    c2=e.charCodeAt(n+1);
                    t+=String.fromCharCode((r&31)<<6|c2&63);
                    n+=2
                }else{
                    c2=e.charCodeAt(n+1);
                    c3=e.charCodeAt(n+2);
                    t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3
                }
            }
            return t
        }
    };
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        return pattern.test(emailAddress);
    }
    $("#txtZipcode").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(".errmsg").html("<b>Digits Only</b>").css("color","red").css("font-size","13px").show().fadeOut("slow");
            return false;
        }
    });
    /* ---- End ---- */
	
    /*
    * Auther : Vinek T.
    * Description : Script for user profile and account settings in user dashboard
    * Date : 30th April'2016
    */
    /* ---- Script for changing zipcode on basis of cities ---- */
    jQuery('#frmUserProfile #txtCity').change(function() {
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

    /* ---- Script for updating account settings ---- */
    jQuery('#btnAccount').click(function() {
        var new_pass = jQuery('#txtNewPassword').val();
        if (new_pass != '') {
            if (new_pass.length < 6) {
                alert('Password must be atleast 6 char long');
                jQuery('#txtNewPassword').focus();
                return false;
            }
        }
        jQuery('#user_acc_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#user_acc_loading').show();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/processAccount.php',
            data: $('#frmAccSetting').serialize(),
            dataType :'json',
            success: function(response){
                // alert(response);
                if(response.status == 'null') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'stat_yes') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'stat_no') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'pass_yes') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'pass_no') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'both_yes') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'one_yes') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'both_no') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                } else if(response.status == 'one_no') {
                    setTimeout(function() {
                        jQuery('#user_acc_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#acc-succ-msg').html(suc_mesg);
                        jQuery('#acc-succ-msg').css({
                            'background-color':'green',
                            'border-radius':'3px',
                            'color':'#ffffff',
                            'font-size':'15px',
                            'font-weight':'600',
                            'padding':'12px',
                            'text-align':'justify'
                        });
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#acc-succ-msg').fadeOut();
                        location.reload();
                    }, 5000);
                }
            }
        });

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
                // $(':checkbox').each(function() {
                //     if ($(this).prop("checked") === true) {
                //         price = Number($(this).attr('data-serviceprice')); /*Add Extra Charge*/
                //     }
                //     alert(price);
                // });
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
                    $('#hidtotal').val(tot_sel);
                    calTotal();
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
        $('#hidtotal').val(obj_val);
        calTotal();
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
        calTotal();
    });
    /* ---- End ---- */
    
    /*
    * Auther : Vinek T.
    * Description : Script for coupon code functionality in booking form
    * Date : 30th April'2016
    */
    /*-- Script for applying coupon code --*/
    jQuery("#btnPromoCode").click(function() {
        var promo_code = jQuery('#txtPromoCode').val();
        jQuery('#booking_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#booking_loading').show();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/check_promocode.php',
            data: { promo_code:promo_code },
            dataType :'json',
            success: function(response) {
                if(response.status == 'null') {
                    setTimeout(function() {
                        jQuery('#booking_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#offer-secc-msg').html(suc_mesg);
                        jQuery('#offer-secc-msg').fadeIn();
                        jQuery('#offer-secc-msg').addClass('btn btn-danger')
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#txtPromoCode').val('');
                        jQuery('#offer-secc-msg').fadeOut();
                        jQuery('#offer-secc-msg').removeClass('btn-danger')
                    }, 3000);
                } else if(response.status == 'abcsent') {
                    setTimeout(function() {
                        jQuery('#booking_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#offer-secc-msg').html(suc_mesg);
                        jQuery('#offer-secc-msg').fadeIn();
                        jQuery('#offer-secc-msg').addClass('btn btn-warning')
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#txtPromoCode').val('');
                        jQuery('#offer-secc-msg').fadeOut();
                        jQuery('#offer-secc-msg').removeClass('btn-warning')
                    }, 3000);
                } else if(response.status == 'consume') {
                    setTimeout(function() {
                        jQuery('#booking_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#offer-secc-msg').html(suc_mesg);
                        jQuery('#offer-secc-msg').fadeIn();
                        jQuery('#offer-secc-msg').addClass('btn btn-primary')
                    }, 2000);
                    setTimeout(function(){
                        jQuery('#txtPromoCode').val('');
                        jQuery('#offer-secc-msg').fadeOut();
                        jQuery('#offer-secc-msg').removeClass('btn-primary')
                    }, 3000);
                } else if(response.status == 'apply') {
                    setTimeout(function() {
                        jQuery('#booking_loading').hide();
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#offer-secc-msg').html(suc_mesg);
                        jQuery('#offer-secc-msg').fadeIn();
                        jQuery('#offer-secc-msg').addClass('btn btn-success');
                        jQuery("#remove-offer").append("<strong> Remove Offer</strong>");
                        jQuery("#remove-offer").css({
                            'text-decoration':'underline',
                            'cursor':'pointer'
                        });
                    }, 2000);
                    setTimeout(function(){jQuery('#btnPromoCode').fadeOut()}, 1500);
                    var offer_price = response.offer;
                    var obj_price = jQuery.parseJSON(response.offer);
                    jQuery('#hidOfferPrice').val(obj_price);
                }
            }
        })
    });
    /* ---- End ---- */
    
    /*-- Script for removing coupon code --*/
    jQuery("#remove-offer").click(function() {
        jQuery('#offer-secc-msg').fadeOut();
        jQuery('#offer-secc-msg').removeClass('btn-success');
        jQuery("#remove-offer").html('');
        var promo_code = jQuery('#txtPromoCode').val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/remove_promocode.php',
            data: { promo_code:promo_code },
            dataType :'json',
            success: function(response) {
                if(response.status == 'remove') {
                    setTimeout(function() {
                        var suc_mesg = JSON.stringify(response.message);
                        suc_mesg = suc_mesg.replace(/^"/, "");
                        suc_mesg = suc_mesg.replace(/"$/, "");
                        jQuery('#offer-secc-msg').html(suc_mesg);
                        jQuery('#offer-secc-msg').addClass('btn btn-default')
                        jQuery('#offer-secc-msg').fadeIn();
                    }, 500);
                    setTimeout(function(){
                        jQuery('#txtPromoCode').val('');
                        jQuery('#hidOfferPrice').val('');
                        jQuery('#offer-secc-msg').removeClass('btn-default')
                        jQuery('#offer-secc-msg').fadeOut();
                    }, 2600);
                    setTimeout(function(){jQuery('#btnPromoCode').fadeIn()}, 3000);
                }
            }
        })        
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for priview the booking form fields
    * Date : 3rd May'2016
    */    
    jQuery('#btnPreview').click(function() {
        var bedroom = jQuery('#txtBedroom').val();
        var service_date = jQuery('#txtServiceDate').val();
        var service_time = jQuery('#txtServiceTime').val();
        if (bedroom == 0 || service_date == '' || service_time == '') {
            alert("Please fill all required fields");
            return false;
        } else {
            var formdata = jQuery("#frmBookCleaning").serialize();
            var modal_preview = '';
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/preview_booking.php',
                data: formdata,
                success: function(response) {
                    // alert(response);
                    jQuery(".modal-body").html(response);
                    jQuery("#book-preview").modal('show');
                }
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for cancel the present booking and confirm the booking and pay for service
    * Date : 4th May'2016
    */
    /*-- Script for cancel booking  --*/
    $('#btnCancelBooking').click(function(){
        var promo_code = jQuery('#promo').val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/remove_promocode.php',
            data: { promo_code:promo_code },
            dataType: 'json',
            success: function(response) {
                window.location = baseuri+'/user/new_booking.php';
            }
        }) 
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for leftmenu booking tab dropdown
    * Date : 5th May'2016
    */
    jQuery(".dropdown-toggle").click(function() {
        jQuery("#book-tab").slideToggle('fast');
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for cancel and rate booking on user dashboard
    * Date : 6th May'2016
    */
    /*-- Script for cancel booking on pending booking list--*/
    jQuery("button#cancelService").click(function() {
        var book_id = jQuery(this).val();
        if(confirm("Are you sure you want to cancel this service now?")) {
            jQuery("#back-color").show();
            jQuery('#cancel-service-loader').html('<img src="'+baseuri+'/images/new_loader.gif">');
            jQuery('#cancel-service-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/cancelService.php',
                data: {book_id:book_id},
                dataType: 'json',
                success: function(response) {
                    if (response.error == 'yes') {
                        setTimeout(function() {
                            jQuery('#cancel-service-loader').hide();
                            jQuery("#back-color").hide();
                        }, 1000);
                        setTimeout(function() {
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                            jQuery("#msg-request").html(response.message);
                            jQuery("#msg-request").fadeIn(500);
                        }, 1000);
                        setTimeout(function() {location.reload();}, 6000);
                    }
                }
            });
        } else {
            return false;
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for priview the booking on pending services, rate services from user end
    * Date : 7th May'2016
    */    
    /*-- Script for view preview booking on pending/complete booking list--*/
    jQuery('.view_booking').click(function() {
        var process_id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/preview_booking.php',
            data: { process_id:process_id, pre_booking:'pre_booking' },
            success: function(response) {
                jQuery(".modal-body").html(response);
                jQuery("#book-preview").modal('show');
            }    
        })
        
    });
    /* ---- End ---- */

    /*-- Script for rate booking on complete booking list --*/
    jQuery("button#btnRateUs").click(function() {
        var book_id = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/getRating.php',
            data: {book_id:book_id},
            success: function(response) {
                jQuery("#body-rate").html(response);
                jQuery("#rate-pop-up").modal('show');
                jQuery('#book_id').val(book_id);
                jQuery('#rating-input').on('rating.change', function() {
                    var rate_cnt = jQuery('#rating-input').val();
                    jQuery('#txtRating').val(rate_cnt);
                });
            }
        });
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for rate services from user end
    * Date : 11th May'2016
    */  
    jQuery("#btnSubRate").click(function() {
        var userId = jQuery('#book_id').val();
        var rating = jQuery('#txtRating').val();
        var ser_provider = jQuery('#txtServiceProvider').val();
        if ((userId == '' && rating == '') || (ser_provider == '')) {
            alert('Please fill the required (*) field');
            return false;
        } else {
            jQuery('.rate-service-loader').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
            jQuery('.rate-service-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/processRating.php',
                data: jQuery('#frmRating').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.msg == 'insert') {
                        setTimeout(function() {
                            jQuery('.rate-service-loader').hide();
                            jQuery("#rate-pop-up").modal('hide');
                        }, 500);
                        setTimeout(function() {
                            jQuery("#com-msg-request").html(response.message);
                            jQuery("#com-msg-request").fadeIn(500);
                            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                        }, 500);
                        setTimeout(function() {location.reload();}, 4000);
                    }
                }    
            });
        }
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for editing the rating on complete service list
    * Date : 12th May'2016
    */  
    /* For getting the saved content to be edit */
    jQuery("button#btnRated").click(function() {
        var rate_id = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/getRating.php',
            data: {rate_id:rate_id},
            success: function(response) {
                jQuery("#body-edit-rate").html(response);
                jQuery("#rated-pop-up").modal('show');
                jQuery('#rate_id').val(rate_id);
                jQuery('#rating-input-edit').on('rating.change', function() {
                    var rate_cnt = jQuery('#rating-input-edit').val();
                    jQuery('#txtRatingEdit').val(rate_cnt);
                });
                
            }        
        });
    });
    /* ---- End ---- */

    /*-- For updating the content into database --*/
    jQuery("#btnSubEditRate").click(function() {
        var rate_id = jQuery('#rate_id').val();
        if (jQuery('#txtRatingEdit').val() == '') {
            jQuery('#rating-input-edit').val();
        } else {
            jQuery('#txtRatingEdit').val();
        }
        jQuery('.rate-service-loader').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing...');
        jQuery('.rate-service-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/processRating.php',
            data: jQuery('#frmRatingEdit').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.msg == 'update') {
                    setTimeout(function() {
                        jQuery('.rate-service-loader').hide();
                        jQuery("#rated-pop-up").modal('hide');
                    }, 500);
                    setTimeout(function() {
                        jQuery("#com-msg-request").html(response.message);
                        jQuery("#com-msg-request").fadeIn(500);
                        jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                    }, 500);
                    setTimeout(function() {location.reload();}, 4000);
                }
            }        
        });

    });
    /* ---- End ---- */

    /*
    * Auther : Aawaan A.
    * Description : Script for front end dashboard link dropdown menu
    * Date : 13th May'2016
    */
	$("button.caret").on('click', function(){
        $("ul#drpMenu").slideToggle();
	});
	/* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for read more link to read full rating comment properly
    * Date : 13th May'2016
    */  
    $("a#read-more").on('click', function(){
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

    /*
    * Auther : Vinek T.
    * Description : Script for read more link to read full rating comment properly
    * Date : 13th May'2016
    */  
    $("#btnUpdate").click(function(){
        var book_id = jQuery(this).val();
        jQuery('#cinfirm_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#cinfirm_loading').show();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/editBooking.php',
            data: jQuery('#frmUpdateCleaning').serialize(),
            success: function(response) {
                setTimeout(function() {
                    jQuery('#cinfirm_loading').hide();
                    jQuery('#back-color').show();
                    jQuery(".modal-body").html(response);
                    jQuery("#success-preview").modal('show');
                }, 1500);
                setTimeout(function(){
                    window.location = baseuri+'/user/pending_services.php';
                }, 8000);
            }
        })
    });
    /* ---- End ---- */

    /*-- Script for previewing the services fields while updating --*/
    jQuery('#btnUpdatePreview').click(function() {
        var formdata = jQuery("#frmUpdateCleaning").serialize();
        var modal_preview = '';
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/preview_update.php',
            data: formdata,
            success: function(response) {
                jQuery("#pre-update").html(response);
                jQuery("#update-preview").modal('show');
            }
        });
    });
    /* ---- End ---- */

    jQuery('#user-notify').click(function () {
        jQuery.ajax({
            type: 'POST',
            url: baseuri+'/includes/getUserNotification.php',
            data: {complete_nitify:'complete_nitify'},
            success: function(response) {
                jQuery('#user-notifications').slideToggle('fast');
                jQuery('#user-notifications').html(response);
            }
        })
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for employee application form
    * Date : 1st June'2016
    */
    /* Script for changing the sizes for mens and womens*/
    jQuery("input:radio[name=txtTshirtPreference]").click(function(){
        var gender = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/get_sizes.php',
            data: {gender:gender},
            success: function(response){
                jQuery("#txtTshirtSize").html(response);
            }
        });
    });
    /* ---- End ---- */

    /* Script for clear the application form data */
    jQuery("#btnClear").click(function(){
        jQuery('#frm-Application').trigger("reset");
    });
    /* ---- End ---- */

    /* Script for submiting the employee application form */
    jQuery("#btnApplication").click(function(){
        var fname = jQuery('#txtFirstName').val();
        var lname = jQuery('#txtLastName').val();
        var mailaddr = jQuery('#txtMailingAddr').val();
        var city = jQuery('#txtState').val();
        var state = jQuery('#txtCity').val();
        var zipcode = jQuery('#txtZipcode').val();
        var experience = jQuery('#txtWorkExp').val();
        var paidcleaning = jQuery('#txtPaidCleaning').val();
        var aboutUC = jQuery('#txtHearAbout').val();
        var tshirtsize = jQuery('#txtTshirtSize').val();
        
        if ((fname == "") || (lname == "") || (city == 0) || (state == 0) || (zipcode == "") || (experience == "") || (paidcleaning == "") || (aboutUC == 0) || (tshirtsize == 0)) {
            jQuery('.alert-danger').html('Please fill all required (*) fields');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            return false
        } else if (!$("input[name='txtEligibleToWork']:checked").val()) {
            jQuery('.alert-danger').html('Please select the eligibility criteria');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            return false
        } else if(!isValidEmailAddress(mailaddr)) {
            jQuery('.alert-danger').html('Please enter a valid mail address');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            return false
        } else if(zipcode.length < 4) {
            jQuery('.alert-danger').html('Please provide valid zipcode');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            return false
        } else if(!$("input#txtAgreeTerms").is(":checked")) {
            jQuery('.alert-danger').html('Please accept the terms and conditions');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
            return false
        } 
    });
    /* ---- End ---- */

    /*
    * Auther : Vinek T.
    * Description : Script for submitting employee application form and quiz section
    * Date : 7st June'2016
    */
    jQuery("#btnSubQuiz").click(function(){
        jQuery('#applform_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#applform_loading').show();
        var formdata = $("#frm-Empquiz").serialize();
        count = jQuery("#hidQueCount").val();
        newCount = 0;
        values = new Array();
        for(i=0; i<=count; i++){
            $("input[id='txtAnswer"+i+"']:checked").each(function(){
                que_val = $(this).attr("data-queid");
                ans_val = $(this).val();
                values.push(que_val,ans_val);
                newCount++;
            });
        }
        if(newCount == count) {
            // console.log(values);
            jQuery.ajax({
                type: 'POST',
                url: 'form-wizard/quizResult.php',
                data: {values:values, formdata:formdata},
                success: function(response) {
                    setTimeout(function() {
                        jQuery('#applform_loading').hide();
                        jQuery('#back-color').show();
                        jQuery(".modal-body").html(response);
                        jQuery("#success-preview").modal('show');
                    }, 2000);
                    setTimeout(function(){
                        window.location = baseuri;
                    }, 8000);
                }
            })
        } else {
            jQuery('#applform_loading').hide();
            jQuery('.alert-danger').html('Please solve all the questions first.');
            jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
            jQuery('.alert-danger').show();
            jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
        }
    });
    /* ---- End ---- */

})


/*
* Auther : Vinek T.
* Description : Script for validating the booking form
* Date : 2nd May'2016
*/
function validateBookingForm() {
    var bedroom = document.getElementById("txtBedroom").value;
    if(bedroom == "0"){
        alert("Please select the Bedroom Numbers");
        document.getElementById("txtBedroom").focus();
        return false;
    }
    var service_date = document.getElementById("txtServiceDate").value;
    if(service_date == ""){
        alert("Please select the Date of Service");
        document.getElementById("txtServiceDate").focus();
        return false;
    }
    var service_time = document.getElementById("txtServiceTime").value;
    if(service_time == ""){
        alert("Please select the Time of Service");
        document.getElementById("txtServiceTime").focus();
        return false;
    }
}
/* ---- End ---- */


/*
* Auther : Vinek T.
* Description : Script for making notification for user dashboard
* Date : 23th May'2016
*/
(function showUserNotty(){
    setTimeout(showUserNotty, 10000);
    var baseuri = window.location.origin+'/cleaning';
    jQuery.ajax({
        type: 'POST',
        url: baseuri+'/includes/getUserNotification.php',
        data: {count:'count'},
        success: function(response) {
            jQuery('#user-notifications').html(response);
            var tot_noti = jQuery('input[name=hidUserNottyTot]').val();
            jQuery('#showUserNotyTot').html(tot_noti);
        }
    })
})();
/* ---- End ---- */

/*
* Auther : Vinek T.
* Description : Script for making the adding or substracting the services on edit and let it go to checkout on at time
* Date : 2nd June'2016
*/
function calTotal() {
    var tip = document.getElementById('txtServiceTip').value;
    var service = document.getElementById('hidtotal').value;
    var extraservice = document.getElementById('txtExtraServiceAmt').value;
    var tot = parseInt(tip) + parseInt(service) + parseInt(extraservice);
    var old_tot = document.getElementById('hidOldGrandTot').value;
    if (tot > old_tot) {
        document.getElementById('btnUpdate').style.display = 'none';
        document.getElementById('btnpay').style.display = 'block    ';
    } else {
        document.getElementById('btnUpdate').style.display = 'block';
        document.getElementById('btnpay').style.display = 'none';
    }
    var tot_diff = parseInt(tot) - parseInt(old_tot);
    document.getElementById('hidTotDiff').value = tot_diff;
}
/* ---- End ---- */


/*
* Auther : Vinek T.
* Description : Script for checking the mail address is present or not
* Date : 2nd June'2016
*/
function checkMailAddr(email) {
    jQuery.ajax({
        type: "POST",
        url: "form-wizard/checkMailAddr.php",
        data: {email : email},
        dataType: "json",
        success: function(response) {
            if (response.error == 'no') {
                var suc_mesg = JSON.stringify(response.message);
                suc_mesg = suc_mesg.replace(/^"/, "");
                suc_mesg = suc_mesg.replace(/"$/, "");
                jQuery('.alert-danger').html(suc_mesg);
                jQuery('.alert-danger').css({'font-size':'15','font-weight':'bold'});
                jQuery('.alert-danger').show();
                jQuery('html, body').animate({scrollTop: $('body').offset().top}, 500);
                jQuery('#btnApplication').attr('disabled','disabled');
            } else if (response.error == 'yes') {
                jQuery('#btnApplication').removeAttr('disabled');
                jQuery('.alert-danger').hide();
            }
        }
    }) 
}
