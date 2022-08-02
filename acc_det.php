<?php
session_start();
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "e_bank";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
$SELECT = "SELECT * from user_creds WHERE username ='$username'";
$SELECT1 = "SELECT * FROM `user_bal` WHERE username = '$username'";
$RESULT =  mysqli_query($conn,$SELECT);
$RESULT1 =  mysqli_query($conn,$SELECT1);
$row = mysqli_fetch_array($RESULT);
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
<li><a  href="dashboard.php">Home</a></li>
  <li><a class="active" href="acc_det.php">Account details</a></li>
  <li><a href="stat.php">Statements</a></li>
  <li><a href="trans.php">Fund transfer</a></li>
  <li style="float:right"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
  <li title="Your account balance" class="acc_bal" style="float:right">
  <a href="depo.php"><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $row1['balance']?> /-</a></li>
</ul>
</div>
<marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
User details.
</marquee>
<div class="table100 ver6">
<table data-vertable="ver6">
<tbody>
<tr class="row100">
<td class="column100 column1" data-column="column1">Name: </td>
<td class="column100 column2" data-column="column2"><?php echo $row['name'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">Username: </td>
<td class="column100 column2" data-column="column2"><?php echo $row['username'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">Phone number: </td>
<td class="column100 column2" data-column="column2"><?php echo $row['phone_number'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">Email:</td>
<td class="column100 column2" data-column="column2"><?php echo $row['email'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">Account number:</td>
<td class="column100 column2" data-column="column2"><?php echo $row['acc_no'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">IFSC code:</td>
<td class="column100 column2" data-column="column2"><?php echo $row['ifsc_code'] ?></td>
</tr>
<tr class="row100">
<td class="column100 column1" data-column="column1">Branch name:</td>
<td class="column100 column2" data-column="column2"><?php echo $row['branch_name'] ?></td>
</tr>
</tbody>
</table>
</div>
</body>
</html>
<?php
}
else{
    header("Location: dashboard.php");
}
?>
