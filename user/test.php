  <?php
  /*=============================
  *filename :  process-registration.php
  *description : frontend registration
  ===============================
  */
  ?>
 <?php require_once(dirname(__DIR__) . '/inc/config.inc.php');?>
  <?php require_once(dirname(__DIR__) . '/inc/function.inc.php');?>
  <?php include_once(dirname(__DIR__) . '/PHPMailer/PHPMailerAutoload.php');?>
  <?php include_once(dirname(__DIR__) . '/PHPMailer/PHPMailerAutoload.php');?>



  <?php
  
    $adminEmail = "censoftg78@gmail.com";
    $txtEmail = "censoftg78@gmail.com";
    echo $verifyCode = rand();

    /*====SEND MAIL IF SUCCESS=======*/
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'mail.centurysoftwares.com';
    //$mail->Host = "ssl://smtp.gmail.com"; 

    echo !extension_loaded('openssl')?"Not Available":"Available";

    $mail->Port = '25';
    $mail->SMTPAuth = true;
    $mail->Username = 'centurys';
    $mail->Password = 'PYUkj47@$[]M$!M';
    $mail->SMTPSecure = '';

    $mail->From = 'info@unwrittencleaning.com';
    $mail->FromName = 'Unwritten Cleaning';
    $mail->addAddress($txtEmail, '');
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addBCC($adminEmail);
    $mail->WordWrap = 50;
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
    $mail->isHTML(true);
    $mail->Subject = 'New User Registration';
    $mail->Body    = '<b>Thank you for registering on UNWRITTEN CLEANING.</b><br><br>
              Your login details are : <br><br>
              <b>
              Username : <span>Username</span><br>
              Password : <span>Password</span>
              </b>
              <br><br>
              Please click on below mentioned link to activate your account.<br><br>
                      http://centurysoftwares.com/cleaning/user/login.php?virifycode='.base64_encode($verifyCode).'&mail='.base64_encode($txtEmail).'<br><br>
                      <br><br>
                      <b>
                      Thanks & Regards,<br>
                      Unwritten Cleaning
                      </b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if(!$mail->send()){
      echo "Error  - ".$mail->ErrorInfo;
    }else{
      echo "mail sent";
    }

    /*END*/

?>