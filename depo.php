<?php
session_start();
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
      <a><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $balance1?> /-</a></li>
    </ul>
    </div>
    <marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
    Welcome back.
    </marquee>
<div class="login"></div>
<div class="login-box">
<form class="container" method="post" action="pgRedirect.php"  onpaste="return false" oncopy="return false">
<h1>TRANSACTION</h1>
<div class="user-box">
        <input type="number" step="0.01" id="TXN_AMOUNT" name="TXN_AMOUNT" required>
        <label>Enter Amount </label>
</div>
<input type="submit" name="submit" class="login-btn" value="Deposit">
</form>
</div>
</body>
</html>
<?php
}
else{
    header("Location: login.php");
}

?>