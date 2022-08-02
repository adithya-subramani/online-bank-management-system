<?php
session_start();
if (isset($_SESSION['username'])){
$balance1 = $_SESSION['baal1'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="icon" href="./img/logo.ico" type="image"/>
</head>
<body>
<img class="wallpaper" src="./img/home.jpeg" /> 
<img class="logo" src="./img/logo-left.png" />
<div class="login1"></div>
<div class="login-box">
<form class="container" method="post" autocomplete="off" onpaste="return false" oncopy="return false">
<h1>Enter OTP</h1>
<div class="user-box">
    <input type="text" name="otp"   required>
    <label>OTP</label>
</div>
<input type="submit" name="verify" class="login-btn" value="Verify">
</form>
</div>
</body>
<?php 
if (isset($_POST['verify'])){
$otp_in = $_POST['otp'];
if ($otp_in == $_SESSION['otp']){
    $acc_no= $_SESSION['tr_acc_no'];
    $amount = $_SESSION['tr_amt'];
    if ($balance1 < $amount){
        echo "<div class='warning'>";
        echo "You don't have enough money in your account";
        echo "</div>";
    }
    else{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "e_bank";
    //Create connection
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        die('Connection error('.mysqli_connect_error().')'.mysqli_connect_error());
    }
    else{
        $SELECT2 = "SELECT username,acc_no,ifsc_code from user_creds WHERE acc_no='$acc_no'";
        $RESULT2 =  mysqli_query($conn,$SELECT2);
        $num2 = mysqli_num_rows($RESULT2);
        $rw2 = mysqli_fetch_array($RESULT2);
        $rec_ifsc = $rw2['ifsc_code'];
        $acc_no2 = $rw2['acc_no'];
        $username2 = $rw2['username'];
        $SELECT3 = "SELECT acc_no,ifsc_code from user_creds WHERE username='$username'";
        $RESULT3 =  mysqli_query($conn,$SELECT3);
        $rw3 = mysqli_fetch_array($RESULT3);
        $sen_ifsc = $rw3['ifsc_code'];
        $acc_no1 = $rw3['acc_no'];
        echo "<div id='p01'>";
        if($rw2>0){
            date_default_timezone_set("Asia/Calcutta");
            $date1 =  date("d/m/Y").' '.date("h:i:sa");
            $SELECT1 = "SELECT * FROM `user_bal` WHERE username = '$username'";
            $RESULT1 =  mysqli_query($conn,$SELECT1);
            $row1 = mysqli_fetch_array($RESULT1);
            $balance1 = $row1['balance'];
            $bal1 = $balance1-$amount;
            $SELECT4 = "SELECT * FROM `user_bal` WHERE username = '$username2'";
            $RESULT4 =  mysqli_query($conn,$SELECT4);
            $row2 = mysqli_fetch_array($RESULT4);
            $balance2 = $row2['balance'];
            $bal2 = $balance2+$amount;
            $INSERT1 = "INSERT INTO `$rec_ifsc`(`id`,`date1`,`info`,`rec_ac_no`,`withdrawal`,`deposit`,`balance`)
            VALUES(DEFAULT,'$date1','FUND TRANSFER','$acc_no1',0,$amount,'$bal2')";
            $INSERT2 = "INSERT INTO `$sen_ifsc`(`id`,`date1`,`info`,`rec_ac_no`,`withdrawal`,`deposit`,`balance`)
            VALUES(DEFAULT,'$date1','FUND TRANSFER','$acc_no2',$amount,0,'$bal1')";
            $UPDATE1 = "UPDATE `user_bal` SET `balance`='$bal1' WHERE `username`='$username'";
            $UPDATE2 = "UPDATE `user_bal` SET `balance`='$bal2' WHERE `username`='$username2'";
            if(($conn->query($INSERT1))&&($conn->query($INSERT2))
            &&($conn->query($UPDATE1))&&($conn->query($UPDATE2))){
                header("Location: tran_otp_val.php");
            }
            else {
            echo "Error:".$INSERT1."<br>".$conn->error;
            echo "Error:".$INSERT2."<br>".$conn->error;
            echo "Error:".$UPDATE1."<br>".$conn->error;
            echo "Error:".$UPDATE2."<br>".$conn->error;
            }
        }
        else {
                    echo "<div class='error'>";
                    echo "An account with the entered account number doesn't exist!";
                    echo "</div>";
                    echo "</div>";
            }
        $conn->close();
    header("Location: trans_success.php");
}
}
}
else{
    echo "<div class='warning'>";
    echo "Access denied!";
    echo "</div>";
}
}
}
else{
    header("Location: login.php");
}