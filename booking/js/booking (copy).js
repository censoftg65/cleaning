$(document).ready(function(){
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
$(".next-step1-preview").click(function(){
	if($(".form-horizontal").valid()){
		var formdata = $(".form-horizontal").serializeArray();
		var step1_model_preview = '';
		$.each(formdata, function(index,field) {
			if(field.name == "is_step_2"){
				return false;
			}
			if(field.value){
				step1_model_preview += '<div class="col-sm-6"><div class="form-group">';
				step1_model_preview += '<label for="country" class="col-sm-6 control-label">'+field.name.replace('txt','')+' : </label>';
				step1_model_preview += '<div class="col-sm-6">'+field.value.replace('txt','')+'</div></div></div>';
			}
		});
		$(".modal-body").html(step1_model_preview);
		$("#step1-preview").modal('show');
		/*$("#step2_booking").prop("disabled",false);*/
	};
})

$(".next-step2-preview").click(function(){
	if($("#bookingForm").valid()){
		var formdata = $("#bookingForm").serializeArray();
		var step2_model_preview = '';
		var extra_service_arr = '';
		var check_flag = 0;
		$.each(formdata, function(index, field) {
			if((field.value) && (index > 10)){ /*10 index for hidden element XXXX*/
				var for_extra_ser = field.value.indexOf("@") + 1;
				if(for_extra_ser){
					extra_service_arr += field.value.substring(for_extra_ser)+',';
					check_flag++;
					return;
				}else{
					field_value = field.value;
				}
				step2_model_preview += '<div class="col-sm-6"><div class="form-group">';
				step2_model_preview += '<label for="country" class="col-sm-6 control-label">'+field.name.replace('txt','')+' : </label>';
				step2_model_preview += '<div class="col-sm-6">';
				
				if(check_flag > 0){
					step2_model_preview += extra_service_arr.slice(0, -1);
					check_flag = 0;
				}	else{
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

$(".gotoStep2").click(function(){
	$("#step2_booking").trigger('click');
})
$(".gotoStep3").click(function(){
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
			type        : 'POST',
			url         : "form-wizard/process-booking.php",
			data        : formdata,
			beforeSend: function() {
				if($('#bookingForm').valid() === false){
					return false;
				}else{
					$("body").addClass("faderclass");
				}
			},
			success:function(data){
				$("body").removeClass("faderclass");
				$("#succ-resp").html(data);
           // $("#succ-resp").html("Thanks for booking, we will get back to you very soon");
           // $('#bookingForm')[0].reset();
       },
       error:function(data){
       	$("body").removeClass("faderclass");
       	$("#succ-resp").html('Unexpected Error occured, please contact admin');
       },
   })
	});
});
/*######## End Ajax Booking-form #########*/


/*for booking calculation*/
$(document).ready(function(){
	var bedroom = $("#txtBedroom");
	bedroom.change(function(){
		if(bedroom.val() || bedroom.val() !== null){
		alert($(this).val());
		}
	})
	
})