<?php
  $name = $_GET['n'];
  $usrn = $_GET['u'];
  $phnum = $_GET['pn'];
  $email = $_GET['em'];
  $acc_no = $_GET['ac'];
  $ifsc = $_GET['ifsc'];
  $brch = $_GET['br'];

  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "e_bank";


  $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

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
<form class="container" method="post" action="updater.php" autocomplete="off" onpaste="return false" oncopy="return false">
<h1>REGISTER</h1>
<div class="user-box">
        <input type="text" name="fulln" value="<?php echo $name ?>" required>
        <label>Fullname</label>
</div>
<div class="user-box">
        <input type="text" name="un" value="<?php echo $usrn ?>"   required>
        <label>Username</label>
</div>
<div class="user-box">
        <input type="number" name="pn" value="<?php echo $phnum ?>" required>
        <label>Phone number</label>
</div>
<div class="user-box">
        <input type="email" name="mail" value="<?php echo $email ?>"  required>
        <label>Email</label>
</div>
<div class="user-box">
        <input type="number" name="ac" value="<?php echo $acc_no ?>"  required>
        <label>Account number</label>
</div>
<div class="user-box">
        <input type="text" name="ifsc" value="<?php echo $ifsc ?>"  required>
        <label>IFSC code</label>
</div>
<div class="user-box">
        <input type="text" name="brch-name" value="<?php echo $brch ?>"  required>
        <label>Branch name</label>
</div>
<input type="submit" name="login" class="login-btn" value="Sign up"><br>
</form>
</div>
</body>
</html>