/*===================================================================
 * Author : Ratnadip K.
 * Description : Registration
 * Date : 5th Apr 2016
 */
 /*==================================================================*/

 /*##---For Click Registration----##*/
 $(document).ready(function() {
    $(".btn-registration").click(function() {
        if ($("#frm-registration").valid()) {
            var formdata = $("#frm-registration").serialize();
            $.ajax({
                type: 'POST',
                url :  _SITE_URL+"/user/form-wizard/process-registration.php",
                data: formdata,
                beforeSend: function() {
                    if ($('#frm-registration').valid() === false) {
                        return false;
                    } else {
                        $("body").addClass("faderclass");
                    }
                },
                success: function(data) {
                    alert(data);
                    $("body").removeClass("faderclass");
                    $(".response").html(data);
                },
                error: function(data) {
                    $("body").removeClass("faderclass");
                    $("#succ-resp").html('Unexpected Error occured, please contact admin');
                }
            })
        };
    })
})
/*######## End Ajax Booking-form #########*/