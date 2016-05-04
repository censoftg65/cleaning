/*
 * Author : Ratnadip K.
 * Description : For Booking Calculation and ajax call
 * Date : 30th March'2016
 */
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
    /*for datetime in step2
    $('#service_time').datetimepicker({
        format:'hh:ii',
        autoclose: true,
        startDate : _today,
        endDate : _today+' 23:59'
    });
*/
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

/*########AjaxJqueryInsertion for Booking-form inside bookings/index.php #########*/

$(document).ready(function() {
    $('#bookingForm').submit(function(e) {
        e.preventDefault();
        var formdata = $("#bookingForm").serialize();
        $.ajax({
            type: 'POST',
            url: "form-wizard/process-booking.php",
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


/*for booking calculation*/
$(document).ready(function() {
    /*  var hours_0 = [];
        var hours_1 = ['2','2.5'];
        /*var hours_1 = [['2','2.5'],['60','75']];
        var hours_2 = ['3','3.5','4','4.5'];
        var hours_3 = ['5','5.5','6','6.5'];
        var hours_4 = ['7','7.5','8','8.5'];
        var hours_5 = ['9','9.5','10','10.5'];
        var hours_5 = ['11','11.5','12','12.5'];
        var hours = [hours_0,hours_1, hours_2, hours_3, hours_4, hours_5];
        var hours_options = $("#txtServiceHours");

        var prices_0 = [];
        var prices_1 = ['60','75'];
        var prices_2 = ['90','105','120','135'];
        var prices_3 = ['150','165','180','195'];
        var prices_4 = ['210','225','240','255'];
        var prices_5 = ['270','285','300','315'];
        var prices_5 = ['330','345','360','375'];
        var prices = [prices_0,prices_1, prices_2, prices_3, prices_4, prices_5];
        
    }*/

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
    var default_service_price = 0;
    var bedroom = 0;
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

    /*function to calculate price and hours*/
    function fun_HourPriceCalulator(bedroom, price) {
        var hours_options = $("#txtServiceHours");
        var prices_options = $("#txtTotal");
        var bathroom_options = $("#txtBathroom");
        hours_options.html('');
        prices_options.html('');
        bathroom_options.html('');
        if (bedroom !== null || bedroom !== "") {
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
    /*end function to calculate price and hours*/


    /*On change bedroom Selection*/
    $("#txtBedroom").change(function() {
        bedroom = $(this).val();
        fun_HourPriceCalulator(bedroom, default_service_price);
    });
    /*On change Hours Selection*/
    $("#txtServiceHours").change(function() {
        hours_options.html('');
        prices_options.html('');
        bathroom_options.html('');
        var bedroom = $(this).val();
        if (bedroom !== null || bedroom !== "") {
            $.each(cal_data[bedroom], function(index, jsonObject) {
                $.each(jsonObject, function(index, value) {
                    hours_options.append(new Option(index, index));
                    prices_options.append(new Option(value, value));
                });
                $.each(bathroom[bedroom], function(index, value) {
                    bathroom_options.append(new Option(value, value));
                });
            });
        }
    });

    /*On click extra services*/
    $("input[type=checkbox]").click(function() {
        if ($(this).prop("checked") === true) {
            service_price += Number($(this).attr('data-serviceprice'));
        } else {
            service_price -= Number($(this).attr('data-serviceprice'));
        }
        fun_HourPriceCalulator(bedroom, service_price);
    });
})