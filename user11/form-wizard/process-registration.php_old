  <?php
  /*=============================
  *filename :  process-registration.php
  *description : frontend registration
  ===============================
  */
  ?>
  <?php require_once(dirname(dirname(__DIR__)) . '/inc/config.inc.php');?>
  <?php require_once(dirname(dirname(__DIR__)) . '/inc/function.inc.php');?>
  <?php include_once(dirname(dirname(__DIR__)) . '/PHPMailer/PHPMailerAutoload.php');?>


  <?php
  $db = new Config();

  /*#######Login Start Here#########*/

  $registration_arr = $_POST;

  $seperator = ',';
  $registration_data = '';
  $output = "Unexpected Error Occured Contact admin";
  
  $txtEmail = $registration_arr['txtEmail'];
  $checkEmailExist = checkUser($txtEmail);/*check email exist*/

  if($checkEmailExist > 0){
    $output = "Email - '".$txtEmail."'already exist";
    echo $output;
    exit;
  }else{
     
    $verifyCode = rand();
    $txtUsername = strtolower($db->getParam('txtFirstname')."".$db->getParam('txtLastname'));
    $txtPassword = randomPassword();

    $registration_arr['txtUsername'] = $txtUsername;
    $registration_arr['txtPassword'] = $txtPassword;
    $registration_arr['txtUserLevel'] = "";
    $registration_arr['txtIpAddress'] = $ip_address;
    //$registration_arr['txtStatus'] = 1;

    foreach ($registration_arr as $value) {
      $registration_data .= "'" . $value . "'" . $seperator;
    }

    $registration_data = substr($registration_data, 0, -1);

    $adminEmail = "censoftg78@gmail.com";

    /*Insert in Cleaning User */
 echo   $query_user = "INSERT INTO 
    `" . _DB_PREFIX . "user`(
      `txtFirstname`, `txtLastname`, `txtAddressLine1`, `txtAddressLine2`, `txtCountry`,
        `txtCity`, `txtState`, `txtZipcode`, `txtEmail`, `txtPhone`,
         `txtUsername`, `txtPassword`, `txtUserLevel`, `txtIpAddress`)
            VALUES(" . $registration_data . ")";
  $result_user = $db->query($query_user);

  if($result_user){

    $output = "success";
    /*====SEND MAIL IF SUCCESS=======*/
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'mail.centurysoftwares.com';
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
              Username : <span>'.$txtUsername.'</span><br>
              Password : <span>'.$txtPassword.'</span>
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
      echo "Error to sent";
    }

    /*END*/
 }
}
  echo $output;

  $db->freeResult();
  $db->close();/*close mysql connection*/

?>