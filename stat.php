
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
$ifsc = $row['ifsc_code'];
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
      <li><a href="acc_det.php">Account details</a></li>
      <li><a class="active" href="stat.php">Statements</a></li>
      <li><a href="trans.php">Fund transfer</a></li>
      <li style="float:right"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
      <li title="Your account balance" class="acc_bal" style="float:right">
      <a href="depo.php"><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $row1['balance']?> /-</a></li>
    </ul>
    </div>
    <marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
    Statements.
    </marquee>
    <table border="2" class="statement">
    <tr>
      <th>Sl.no</th>
      <th>Date & time</th>
      <th>Info</th>
      <th>Sender's/Receiver's acc. no.</th>
      <th>Withdrawal</th>
      <th>Deposit</th>
      <th>Balance</th>
</tr>
      <?php
      $query = "SELECT * FROM `$ifsc` ";
    if ($row2 = $conn->query($query)){
      while ($result = $row2->fetch_assoc()) {
        echo "
        <tr>
        <td>".$result['id']."</td>
        <td>".$result['date1']."</td>
        <td>".$result['info']."</td>
        <td>".$result['rec_ac_no']."</td>
        <td>".$result['withdrawal']."</td>
        <td>".$result['deposit']."</td>
        <td>".$result['balance']."</td>
        </tr>
        ";
      }
    }
      ?>
    </tr>
  </table>
  <button class="stat-print" onclick="javascript:window.print();">Print page</button>
    </body>
    </html>
<?php
}
else{
    header("Location: login.php");
}

?>

