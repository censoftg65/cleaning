/*
 * Author : Ratnadip K.
 * Description : For Booking Calculation and ajax call
 * Date : 30th March 2016
 */
 /*#################################################################*/
 $(document).ready(function() {

    /*  $("#step2_booking").prop("disabled",true);
        $("#step3_confirm").prop("disabled",true);
        $("#btnSaveBookingForm").prop("disabled",true);
        */
    /*    var _date = new Date();
    _today = _date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();*/

    /*for date in step2*/
    $('#txtServiceDateTime').datetimepicker({
        format: 'dd-mm-yy hh:ii P',
        showMeridian: true,
        autoclose: true,
    });

    /*for step1 preview*/
    $(".next-step1-preview").click(function() {
        if ($(".form-horizontal").valid()) {
            var formdata = $(".form-horizontal").serializeArray();
            var step1_model_preview = '';
            $.each(formdata, function(index, field) {
                if (field.name == "is_step_2") {
                    return false;
                }
                if (field.value) {
                    step1_model_preview += '<div class="col-sm-6"><div class="form-group">';
                    step1_model_preview += '<label for="country" class="col-sm-6 control-label">' + field.name.replace('txt', '') + ' : </label>';
                    step1_model_preview += '<div class="col-sm-6">' + field.value.replace('txt', '') + '</div></div></div>';
                }
            });
            $(".modal-body").html(step1_model_preview);
            $("#step1-preview").modal('show');
            /*$("#step2_booking").prop("disabled",false);*/
        };
    })
    /*for step2 preview*/
    $(".next-step2-preview").click(function() {
        if ($("#bookingForm").valid()) {
            var formdata = $("#bookingForm").serializeArray();
            var step2_model_preview = '';
            var extra_service_arr = '';
            var check_flag = 0;
            $.each(formdata, function(index, field) {
                if ((field.value) && (index > 10)) { /*10 index for hidden element XXXX*/
                    var for_extra_ser = field.value.indexOf("@") + 1;
                    if (for_extra_ser) {
                        extra_service_arr += field.value.substring(for_extra_ser) + ',';
                        check_flag++;
                        return;
                    } else {
                        field_value = field.value;
                    }
                    step2_model_preview += '<div class="col-sm-6"><div class="form-group">';
                    step2_model_preview += '<label for="country" class="col-sm-6 control-label">' + field.name.replace('txt', '') + ' : </label>';
                    step2_model_preview += '<div class="col-sm-6">';

                    if (check_flag > 0) {
                        step2_model_preview += extra_service_arr.slice(0, -1);
                        check_flag = 0;
                    } else {
                        step2_model_preview += field_value;
                    }
                    step2_model_preview += '</div></div></div>';
                }
            });
$(".modal-body").html(step2_model_preview);
$("#step2-preview").modal('show');
/*$("#step3_confirm").prop("disabled",false);*/
};
})

$(".gotoStep2").click(function() {
    $("#step2_booking").trigger('click');
})
$(".gotoStep3").click(function() {
    $("#step3_confirm").trigger('click');
    /*$("#btnSaveBookingForm").prop("disabled",false);*/
})
})

/*for booking calculation*/
$(document).ready(function() {

    /*##### Initilise all variable #####*/
    var bathroom = [
    [],
    [1, 2],
    [1, 2],
    [1, 2, 3],
    [1, 2, 3, 4],
    [1, 2, 3, 4, 5],
    [1, 2, 3, 4, 5, 6]
    ];

    var bathrooms;
    var service_price = 0;
    var bedroom = 0;
    var price = 0;
    var bathroom_options = $("#txtBathroom");
    var hours_options = $("#txtServiceHours");
    var prices_options = $("#txtTotal");
    var price_options = $("#txtTotal option");
    /*##### End Initilise all variable #####*/


    /*###Both bathroom and prices###*/
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
        }]
    };

    /*On change bedroom Selection*/
    $("#txtBedroom").change(function() {
        filter_type = 'bedroom';
        bedroom = $(this).val();
        hours_options.html('');
        prices_options.html('');
        bathroom_options.html('');
        if (bedroom !== null || bedroom !== "") {
            if (filter_type == 'bedroom') {
                $(':checkbox').each(function() {
                    if ($(this).prop("checked") === true) {
                        price = Number($(this).attr('data-serviceprice')); /*Add Extra Charge*/
                    }
                });
                $.each(cal_data[bedroom], function(index, jsonObject) {
                    $.each(jsonObject, function(index, value) {
                        hours_options.append(new Option(index, index));
                        prices_options.append(new Option(Number(value + price).toFixed(2), Number(value + price).toFixed(2)));
                    });
                    $.each(bathroom[bedroom], function(index, value) {
                        bathroom_options.append(new Option(value, value));
                    });
                });
            }
        }
    });

/*Change Total On change Hours Selection*/
$("#txtServiceHours").change(function() {
    var price_options = $('#txtTotal option');
    var selectedIndex = $(this)[0].selectedIndex;
    price_options.eq(selectedIndex).prop('selected', true);
});

/*On click extra services*/
$("input[type=checkbox]").click(function() {
    var price_options = $('#txtTotal option');
    var price_value;
    var price_text;
    if ($(this).prop("checked") === true) {
        service_price = Number($(this).attr('data-serviceprice')); /*Add Extra Charge*/
        $.map(price_options, function(option) {
            price_value = Number(option.value) + service_price;
            price_text = Number(option.label) + service_price;
            option.value = price_value.toFixed(2);
            option.text = price_text.toFixed(2);
        });
    } else {
        service_price = Number($(this).attr('data-serviceprice')); /*Substract Extra Charge*/
        $.map(price_options, function(option) {
            price_value = Number(option.value) - service_price;
            price_text = Number(option.label) - service_price;
            option.value = price_value.toFixed(2);
            option.text = price_text.toFixed(2);
        });
    }
});
})


/*########AjaxJqueryInsertion for Booking-form inside bookings/index.php #########*/

/*##for Personal Section##*/
$(document).ready(function() {
    var form_request;
    var field_value;
    var city = $('#txtCity');
    var zipcode = $('#txtZipcode');
    var result;
    /*#########for Personal Section#########*/
    /*For State*/
    $('#txtState').change(function(e) {
        formdata = $(this).val();
        form_request = "state";
        $.ajax({
            type: 'POST',
            url: _SITE_URL+"/booking/form-wizard/process-personal-data.php",
            data: {
                form_request,
                formdata
            },
            success: function(data) {
                result = data.split('@');
                city.html(result[0]);
                zipcode.html(result[1]);
            }
        })
    });

    /*For City*/
    $('#txtCity').change(function(e) {
        formdata = $(this).val();
        form_request = "city";
        $.ajax({
            type: 'POST',
            url: _SITE_URL+"/booking/form-wizard/process-personal-data.php",
            data: {
                form_request,
                formdata
            },
            success: function(data) {
                zipcode.html(data);
            }
        })
    });
});

/*##---for Booking Section----##*/
$(document).ready(function() {
    $('#bookingForm').submit(function(e) {
        e.preventDefault();
        var formdata = $("#bookingForm").serialize();
        $.ajax({
            type: 'POST',
            url : _SITE_URL+"/booking/form-wizard/process-booking.php",
            data: formdata,
            beforeSend: function() {
                if ($('#bookingForm').valid() === false) {
                    return false;
                } else {
                    $("body").addClass("faderclass");
                }
            },
            success: function(data) {
                $("body").removeClass("faderclass");
                $("#succ-resp").html(data);
                // $("#succ-resp").html("Thanks for booking, we will get back to you very soon");
                // $('#bookingForm')[0].reset();
            },
            error: function(data) {
                $("body").removeClass("faderclass");
                $("#succ-resp").html('Unexpected Error occured, please contact admin');
            }
        })
    });
});

/*######## End Ajax Booking-form #########*/