<?php
session_start();
$username = $_SESSION['username'];
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "e_bank";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
$SELECT1 = "SELECT * FROM `user_bal` WHERE username = '$username'";
$RESULT1 =  mysqli_query($conn,$SELECT1);
$row1 = mysqli_fetch_array($RESULT1);
?>	
    
    <!DOCTYPE html>
    <html>
    <head>
    <title>ASR Dashboard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="./img/logo.ico" type="image"/>
    </head>
    <body>
    <img class="logo" src="./img/logo-left.png" />
    <div class="nav_bar">
    <ul>
      <li><a class="active" href="dashboard.php">Home</a></li>
      <li><a href="acc_det.php">Account details</a></li>
      <li><a href="stat.php">Statements</a></li>
      <li><a href="trans.php">Fund transfer</a></li>
      <li style="float:right"><a href="trans.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
      <li style="float:right"><a href="stat.php"><i class="fas fa-envelope"></i>Messages</a></li>
      <li title="Your account balance" class="acc_bal" style="float:right">
      <a><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $row1['balance']?> /-</a></li>
    </ul>
    </div>
    <marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
    Success.
    </marquee>
    <div class="success_card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>Transaction was successful;<br>
		&#8377 <?php echo $_POST['txn'] ?> /- has been deposited successfully.<br/></p>
      </div>
      <?php header( "refresh:30;url=dashboard.php" ); ?>
