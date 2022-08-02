<?php
$name = $_POST['fulln'];
$username= $_POST['un'];
$email= $_POST['mail'];
$ph_no= $_POST['pn'];
$acc_no= $_POST['ac'];
$ifsc= $_POST['ifsc'];
$branch= $_POST['brch-name'];

  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "e_bank";


  $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

  $query = "UPDATE `user_creds` SET `name`='$name',`username`='$username',`phone_number`='$ph_no',
  `email`='$email',`acc_no`='$acc_no',`branch_name`='$branch' WHERE `ifsc_code`='$ifsc'";
  $data = mysqli_query($conn,$query);
  if($data){
    header("Location: ad_dash.php");
  }
  else{
    echo "Failure";
  }

?>