<?php
        session_start();
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $capt1 = substr(str_shuffle($str_result), 0, 6);
        setcookie('captcha_real', $capt1, time() - 120 , "/");
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
<img class="wallpaper" src="./img/home.jpeg" /> 
<img class="logo" src="./img/logo-left.png" />
<div class="login"></div>
<div class="login-box">
<form class="container" method="post" autocomplete="off" onpaste="return false" oncopy="return false">
<h1>LOGIN</h1>
<div class="user-box">
        <input type="text" name="un" required>
        <label>Username</label>
</div>
<div class="user-box">
        <input type="password" name="pwd" required>
        <label>Password</label>
</div>

<h4 id="captcha" style="margin-top:13px;margin-left:115px;position: absolute;"><?php echo $capt1 ?></h4><i></strong>
<img class="cap" src="./img/captcha.jpg" height="50" /> 
<h4 class="cap-text">Enter the captcha shown above</h4>
<div class="user-box">
        <input type="text" name="in_cap" required>
        <label>Captcha</label>
</div>
<input type="submit" name="login" class="login-btn" value="Login"><br>
<a href="signup.php">Don't have an account?</a>
</form>
</div>
<?php 
if (isset($_POST['login'])){
  $username= $_POST['un'];
  $password = $_POST['pwd'];
  $captchaaa = $_POST['in_cap'];
  $_SESSION['username'] = $username;
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
    $SELECT = "SELECT username,pass,ifsc_code from user_creds WHERE username='$username'";
    $RESULT =  mysqli_query($conn,$SELECT);
    $num = mysqli_num_rows($RESULT);
    $row = mysqli_fetch_array($RESULT);
    echo "<div id='p01'>";
    if($row>0){
        $ifsc = $row['ifsc_code'] ;
        $pass1 = $password.$ifsc;
        $pass_ver = hash('sha256',$pass1);
        if($row['username']==$username && $row['pass']==$pass_ver){
                if($captchaaa==$_COOKIE['captcha_real']){
                echo "<div class='success'>";
                echo "Connected successfully.<br>";
                header("Location: otp_gen.php");
                //header("Location: dashboard.php");
                echo "</div>";
                }
                else{
                        echo "<div class='warning'>";
                        echo "Invalid captcha";
                        echo "</div>";
                }
                setcookie('captcha_real', $capt1, time() + 120 , "/");
    }}
   else {
                echo "<div class='error'>";
                echo "Incorrect username or password";
                echo "</div>";
                echo "</div>";
        }
    $conn->close();
    
  }
}
?>
</body>
</html>