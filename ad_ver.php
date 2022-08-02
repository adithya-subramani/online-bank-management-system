<?php
session_start();

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
<h1>Enter secret key</h1>
<div class="user-box">
    <input type="text" name="seckey"   required>
    <label>Secret key</label>
</div>
<input type="submit" name="verify" class="login-btn" value="Verify">
</form>
</div>
</body>
<?php 
if (isset($_POST['verify'])){
    $otp_in = $_POST['seckey'];
    if ($otp_in == 54548){
        header("Location: ad_login.php");
    }
    else{
        echo "<div class='warning'>";
        echo "Access denied!";
        echo "</div>";
    }
}