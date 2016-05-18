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

  /*#######Logic Start Here#########*/

  $message = "Unexpected error occured, please Contact admin";
  $success = "no";
  $data = array('message' => $message, 'success' => $success);

  $registration_arr = $_POST;
  $seperator = ',';
  $registration_data = '';

  
  $txtEmail = $registration_arr['txtEmail'];
  $checkEmailExist = checkUser($txtEmail);/*check email exist*/

  if($checkEmailExist > 0){
    $message = "User already register with us. Please try again..!";
    $success = "no";
  }else{
     
    $verifyCode = rand();
    $txtUsername = strtolower($db->getParam('txtFirstname')."".$db->getParam('txtLastname'));
    $txtPassword = randomPassword();

    $registration_arr['txtUsername'] = $txtUsername;
    $registration_arr['txtPassword'] = base64_encode($txtPassword);
    $registration_arr['txtUserLevel'] = "user";
    $registration_arr['txtIpAddress'] = $ip_address;

    foreach ($registration_arr as $value) {
      $registration_data .= "'" . $value . "'" . $seperator;
    }
    $registration_data .= 1;/*Staus 1 fo Registration Activation*/

    $adminEmail = "censoftg78@gmail.com";

    /*=========Insert in Cleaning User==========*/
    $query_user = "INSERT INTO 
    `" . _DB_PREFIX . "user`(
      `txtFirstname`, `txtLastname`, `txtAddressLine1`, `txtAddressLine2`, `txtCountry`,
         `txtState`, `txtCity`, `txtZipcode`, `txtEmail`, `txtPhone`,
            `txtUsername`, `txtPassword`, `txtUserLevel`, `txtIpAddress`, `txtStatus`)
                VALUES(" . $registration_data . ")";
    
    $result_user = $db->query($query_user);

  if($result_user){

    $message = "Thanks for registering us, we will get back you very soon !";
    $success = "yes";

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
                      http://centurysoftwares.com/cleaning/user/login.php?verifycode='.base64_encode($verifyCode).'&mail='.base64_encode($txtEmail).'<br><br>
                      <br><br>
                      <b>
                      Thanks & Regards,<br>
                      Unwritten Cleaning
                      </b>';
    if(!$mail->send()){
      $message .= "<br/>but there might be Server problem to send you email";
    }
    /*END OF EMAIL SENDING*/
 }
}


$db->freeResult();
$db->close();/*close mysql connection*/

$data = array('message' => $message, 'success' => $success);
$output = json_encode($data);
echo $output;
exit;
?>