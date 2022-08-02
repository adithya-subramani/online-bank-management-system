<?php
    require 'vendor/autoload.php';
    use \Mailjet\Resources;
    
session_start();
$username = $_SESSION['username'];
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "e_bank";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
$SELECT = "SELECT email from user_creds WHERE username='$username'";
$RESULT =  mysqli_query($conn,$SELECT);
$rows = mysqli_fetch_array($RESULT);
$row = mysqli_num_rows($RESULT);
$email = $rows['email'];
if($row>0){
    $otp = rand(111111,999999);
    $msg = "Your OTP for login is ".$otp ;
    $mj = new \Mailjet\Client('926a2d8b6c373fe03ce9b97ccb487c74','dc262af927e8543da75f84c27d683c97',true,['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "asrbankoffl@gmail.com",
            'Name' => "ASR Bank"
          ],
          'To' => [
            [
              'Email' => $email,
            ]
          ],
          'Subject' => "OTP Verification",
          'TextPart' => "OTP Verification",
          'HTMLPart' => "$msg",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success() && var_dump($response->getData());
    $_SESSION['otp']= $otp;
    header("Location: otp_val.php");
}
else{
	echo "Email does not exist";
}

?>
