<?php
session_start();
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$usrn = $_POST["ORDERID"];
$username = substr($usrn,6);
$host = "localhost";
$dbUsername = "root";
$_SESSION['username'] = $username;
$dbPassword = "";
$dbname = "e_bank";
$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
$SELECT1 = "SELECT * FROM `user_bal` WHERE username = '$username'";
$RESULT1 =  mysqli_query($conn,$SELECT1);
$row1 = mysqli_fetch_array($RESULT1);

$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
    
    date_default_timezone_set("Asia/Calcutta");
    $date1 =  date("d/m/Y").' '.date("h:i:sa");
    $SELECT3 = "SELECT acc_no,ifsc_code from user_creds WHERE username='$username'";
    $RESULT3 =  mysqli_query($conn,$SELECT3);
    $rw3 = mysqli_fetch_array($RESULT3);
    $sen_ifsc = $rw3['ifsc_code'];
    $balance1 = $row1['balance'];
    $amount = $_POST['TXNAMOUNT'];
    $bal1 = $balance1 + $amount;
    $INSERT2 = "INSERT INTO `$sen_ifsc`(`id`,`date1`,`info`,`rec_ac_no`,`withdrawal`,`deposit`,`balance`)
    VALUES(DEFAULT,'$date1','DEPOSIT','---',0,$amount,'$bal1')";
    $UPDATE1 = "UPDATE `user_bal` SET `balance`='$bal1' WHERE `username`='$username'";
    if(($conn->query($INSERT2))&&($conn->query($UPDATE1))){
     ?> <form method="post" action="depo_suc.php" name="f1">
      <input type="hidden" name="txn" value="<?php echo $amount ?>">
      <script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
      <?php
    }
  }
  else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}
}
else {
  echo "<b>Checksum mismatched.</b>";
}

?>