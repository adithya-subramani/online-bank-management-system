<?php
        session_start();
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
<div class="login"></div>
<div class="login-box">
<form class="container" method="post" autocomplete="off" onpaste="return false" oncopy="return false">
<h1>ADMIN LOGIN</h1>
<div class="user-box">
        <input type="text" name="un" required>
        <label>Username</label>
</div>
<div class="user-box">
        <input type="password" name="pwd" required>
        <label>Password</label>
</div>

<input type="submit" name="login" class="login-btn" value="Login"><br>
</form>
</div>
<?php 
if (isset($_POST['login'])){
  $username= $_POST['un'];
  $password = $_POST['pwd'];
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
    $SELECT = "SELECT username,pass from ad_details WHERE username='$username'";
    $RESULT =  mysqli_query($conn,$SELECT);
    $num = mysqli_num_rows($RESULT);
    $row = mysqli_fetch_array($RESULT);
    echo "<div id='p01'>";
    if($row>0){
        if($row['username']==$username && $row['pass']==$password){
                echo "<div class='success'>";
                echo "Connected successfully.<br>";
                header("Location: ad_dash.php");
                echo "</div>";

    }
   else {
                echo "<div class='error'>";
                echo "Incorrect username or password";
                echo "</div>";
                echo "</div>";
        }
    $conn->close();
    
  }
}
}
?>
</body>
</html>