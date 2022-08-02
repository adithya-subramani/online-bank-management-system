<?php
  $Aadhaar_number = $_GET['ifsc'];
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "e_bank";

  $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
  $query = "DELETE FROM `user_creds` WHERE `ifsc_code`='$Aadhaar_number'";
  $data = mysqli_query($conn,$query);
  if($data){
    header("Location: ad_dash.php");
}
  else{
    echo "Failure";
}

?>