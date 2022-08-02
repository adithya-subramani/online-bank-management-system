<?php
session_start();
require 'vendor/autoload.php';
use \Mailjet\Resources;
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "e_bank";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
$SELECT1 = "SELECT * FROM `user_bal` WHERE username = '$username'";
$RESULT1 =  mysqli_query($conn,$SELECT1);
$row1 = mysqli_fetch_array($RESULT1);
$balance1 = $row1['balance'];
$_SESSION['baal1'] = $balance1;
?>
<!DOCTYPE html>
<html>
<head>
<title>ASR login page</title>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">
<link rel="icon" href="./img/logo.ico" type="image"/>
</head>
<body>
<img class="logo" src="./img/logo-left.png" />
    <div class="nav_bar">
    <ul>
      <li><a  href="dashboard.php">Home</a></li>
      <li><a href="acc_det.php">Account details</a></li>
      <li><a href="stat.php">Statements</a></li>
      <li><a class="active" href="trans.php">Fund transfer</a></li>
      <li style="float:right"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
      <li title="Your account balance" class="acc_bal" style="float:right">
      <a href="depo.php"><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $balance1?> /-</a></li>
    </ul>
    </div>
    <marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
    Welcome back.
    </marquee>
<div class="login"></div>
<div class="login-box">
<form class="container" method="post"  onpaste="return false" oncopy="return false">
<h1>TRANSACTION</h1>
<div class="user-box">
        <input type="number" name="ac" required>
        <label>Account number</label>
</div>
<div class="user-box">
        <input type="number" step="0.01" min="0" name="amt" required>
        <label>Amount</label>
</div>
<input type="submit" name="submit" class="login-btn" value="Send">
</form>
</div>
<?php 
if (isset($_POST['submit'])){
$_SESSION['tr_acc_no'] = $_POST['ac'];
$_SESSION['tr_amt'] = $_POST['amt'];
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
        $msg = "Your OTP for verification of the ongoing transaction is ".$otp ;
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
        header("Location: trans_otp_val.php");
    }

    else{
        echo "Email does not exist";
    }
}?>
<?php
}
else{
    header("Location: login.php");
}
?>