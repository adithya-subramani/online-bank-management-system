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
<div class="login2"></div>
<div class="login-box">
<form class="container" method="post" action="newuser.php" autocomplete="off" onpaste="return false" oncopy="return false">
<h1>REGISTER</h1>
<div class="user-box">
        <input type="text" name="fulln" required>
        <label>Fullname</label>
</div>
<div class="user-box">
        <input type="text" name="un"  required>
        <label>Username</label>
</div>
<div class="user-box">
        <input type="number" name="pn" required>
        <label>Phone number</label>
</div>
<div class="user-box">
        <input type="email" name="mail" required>
        <label>Email</label>
</div>
<div class="user-box">
        <input type="password" name="pwd" required>
        <label>Password</label>
</div>
<div class="user-box">
        <input type="number" name="ac" required>
        <label>Account number</label>
</div>
<div class="user-box">
        <input type="text" name="ifsc" required>
        <label>IFSC code</label>
</div>
<div class="user-box">
        <input type="text" name="brch-name" required>
        <label>Branch name</label>
</div>
<h4 id="captcha" style="margin-top:13px;margin-left:115px;position: absolute;"><?php echo $capt1 ?></h4><i></strong>
<img class="cap" src="./img/captcha.jpg" height="50" /> 
<h4 class="cap-text">Enter the captcha shown above</h4>
<div class="user-box">
        <input type="text" name="in_cap"   required>
        <label>Captcha</label>
</div>
<input type="submit" name="login" class="login-btn" value="Sign up"><br>
<a href="login.php">Already signed up?</a>
</form>
</div>
</body>
</html>