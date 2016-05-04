
/*
* Auther : Vinek T.
* Description : Script for user dashboard & booking form functonalities
* Date : 26th April'16
*/
$(document).ready(function(){
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

	jQuery('#txtServiceTime').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia',
    });
    /*-- End --*/

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
        var baseuri = window.location.origin+'/cleaning';
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
    var prices_options = $("#txtTotal");
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

    /*On change bedroom Selection*/
    $("#txtBedroom").change(function() {
        filter_type = 'bedroom';
        bedroom = $(this).val();
        bathroom_options.html('');
        hours_options.html('');
        prices_options.html('');
        if (bedroom !== null || bedroom !== "") {
            if (filter_type == 'bedroom') {
                $(':checkbox').each(function() {
                    if ($(this).prop("checked") === true) {
                        price = Number($(this).attr('data-serviceprice')); /*Add Extra Charge*/
                    }
                });
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
                    var tot_sel = $('#txtTotal option:selected').val();
                    $('#hidtotal').val(tot_sel);
                });
            }
        }
		
    });
    /*-- End --*/

    /*-- Change total on hours selection --*/
	$("#txtServiceHours").change(function() {
        var selectedIndex = $(this)[0].selectedIndex;
        var price_options = $('#txtTotal option').eq(selectedIndex).prop('selected', true);
        var obj_val = $( "#txtTotal option:selected" ).val();
        $('#hidtotal').val(obj_val);
    });
	/*-- End --*/

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
    /*-- End --*/
    
    /*
    * Auther : Vinek T.
    * Description : Script for coupon code functionality in booking form
    * Date : 30th April'2016
    */
    /*-- Script for applying coupon code --*/
    jQuery("#btnPromoCode").click(function() {
        var baseuri = window.location.origin+'/cleaning';
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
    /*-- End --*/
    
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
    /*-- End --*/

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

    /*
    * Auther : Vinek T.
    * Description : Script for cancel the present booking and confirm the booking and pay for service
    * Date : 4th May'2016
    */
    /*-- Script for cancel booking  --*/
    $('#btnCancelBooking').click(function(){
        var baseuri = window.location.origin+'/cleaning';
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
    /*-- End --*/

    /*-- Script for confirm booking and pay for service --*/
    $('#btnConfirmBooking').click(function(){
        var baseuri = window.location.origin+'/cleaning';
        jQuery('#cinfirm_loading').html('<img src="'+baseuri+'/images/new_loader.gif"> Processing... ');
        jQuery('#cinfirm_loading').show();
        jQuery.ajax({
            type: 'POST',
            url: 'form-wizard/processBooking.php',
            data: $('#frm-ConfirmBooking').serialize(),
            success: function(response) {
                setTimeout(function() {
                    jQuery('#cinfirm_loading').hide();
                    jQuery("#back-color").show();
                    jQuery(".modal-body").html(response);
                    jQuery("#success-preview").modal('show');
                }, 3000);
                setTimeout(function(){
                    window.location = baseuri+'/home.php';
                }, 10000);
            } 
        }) 
    });
    /*-- End --*/
   
})


/*
* Auther : Vinek T.
* Description : Script for validating the booking form
* Date : 2nd May'2016
*/
function validateBookingForm() {
    var bedroom = document.getElementById("txtBedroom").value;
    if(bedroom == "0"){
        alert("Please select bedrooms.");
        document.getElementById("txtBedroom").focus();
        return false;
    }
    var service_date = document.getElementById("txtServiceDate").value;
    if(service_date == ""){
        alert("Please select service date.");
        document.getElementById("txtServiceDate").focus();
        return false;
    }
    var service_time = document.getElementById("txtServiceTime").value;
    if(service_time == ""){
        alert("Please select service date.");
        document.getElementById("txtServiceTime").focus();
        return false;
    }
}
