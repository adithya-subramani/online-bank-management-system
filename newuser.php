<?php
date_default_timezone_set("Asia/Calcutta");
$date1 =  date("d/m/Y").' '.date("h:i:sa");
$name = $_POST['fulln'];
$username= $_POST['un'];
$email= $_POST['mail'];
$ph_no= $_POST['pn'];
$password = $_POST['pwd'];
$acc_no= $_POST['ac'];
$ifsc= $_POST['ifsc'];
$branch= $_POST['brch-name'];
$pass1 = $password.$ifsc;
$pass = hash('sha256',$pass1);

//conn
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
    $INSERT = "INSERT INTO `user_creds`(`name`, `username`,`phone_number`, `email`, `pass`, 
    `acc_no`, `ifsc_code`, `branch_name`) VALUES ('$name','$username','$ph_no','$email','$pass',
    '$acc_no','$ifsc','$branch')";
    $INSERT1 = "INSERT INTO `user_bal` (`username`) VALUES ('$username')";
    $sql = "CREATE TABLE `$ifsc` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date1 VARCHAR(20) NOT NULL,
        info VARCHAR(50) NOT NULL,
        rec_ac_no VARCHAR(50),
        withdrawal FLOAT,
        deposit FLOAT,
        balance FLOAT
        )";
    $INSERT2 = "INSERT INTO `$ifsc`(`id`,`date1`,`info`,`rec_ac_no`,`withdrawal`,`deposit`,`balance`)
    VALUES(DEFAULT,'$date1','INITIAL DEPOSIT','---',0,200,200)";
    $SELECT = "SELECT * FROM `user_creds` WHERE username = '$username'";
    $RESULT = mysqli_query($conn,$SELECT);
    $count = mysqli_num_rows($RESULT);
    if($count!=0){
        header("Location: login.php");
    }
    else{
        if(($conn->query($INSERT))&&($conn->query($INSERT1))
        &&($conn->query($sql))&&($conn->query($INSERT2))){
        header("Location: login.php");
        }
        else {
        echo "Error:".$INSERT."<br>".$conn->error;
        echo "Error:".$INSERT1."<br>".$conn->error;
        echo "Error:".$sql."<br>".$conn->error;
        }
        $conn->close();
        
    }
}

?>