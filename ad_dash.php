<html>
<head>
  <title>User details</title>
  <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="./img/logo.ico" type="image"/>
    </head>
    <body>
    <img class="logo" src="./img/logo-left.png" />
  <style>
  table{
    position:absolute;
    top:30%;
    left:50%;
    transform:translate(-50%,-50%);
  }
  table td{
    color:black;
  }
  tbody tr:nth-child(odd) {
  background-color: #85FF2F ;
  }

  tbody tr:nth-child(even) {
  background-color: #2FF7FF;
  }

  tbody tr {
  background-color: white;
  }

  table {
  background-color: #85FF2F ;
  }
  .updatelink:link, .updatelink:visited {
  background-color: yellow;
  color: black;
  border: 2px solid white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.updatelink:hover,.updatelink:active{
  background-color: white;
  color: black;
  border: 2px solid yellow;
}
.deletelink:link, .deletelink:visited {
  background-color: red;
  color: black;
  border: 2px solid white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.deletelink:hover,.deletelink:active{
  background-color: white;
  color: black;
  border: 2px solid red;
}
.normlink, .normlink:visited {
  background-color:  #84FE1D;
  color: black;
  border: 2px solid white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  position: absolute;
  bottom: 10%;
  left: 50%;
}

.normlink:hover,.normlink:active{
  background-color: white;
  color: black;
  border: 2px solid  #84FE1D;
}
  </style>
</head>
<body>
<ul>
<li style="float:right"><a class="deletelink" href="ad_ver.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
</ul>
  <?php
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "e_bank";

  $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
  ?>
  <table border="2">
    <tr>
      <th>Name</th>
      <th>Username</th>
      <th>Phone number</th>
      <th>Email</th>
      <th>Acc. no.</th>
      <th>IFSC</th>
      <th>Branch</th>
</tr>
      <?php
      $query = "SELECT * FROM  user_creds";
    if ($row = $conn->query($query)){
      while ($result = $row->fetch_assoc()) {
        echo "
        <tr>
        <td>".$result['name']."</td>
        <td>".$result['username']."</td>
        <td>".$result['phone_number']."</td>
        <td>".$result['email']."</td>
        <td>".$result['acc_no']."</td>
        <td>".$result['ifsc_code']."</td>
        <td>".$result['branch_name']."</td>
        <td><a class='deletelink' href='delete.php?ifsc=$result[ifsc_code]'><i class='fas fa-trash-alt'>Delete</i></a></td>
        <td><a class='updatelink' href='update.php?n=$result[name]&u=$result[username]&pn=$result[phone_number]&em=$result[email]&ac=$result[acc_no]&ifsc=$result[ifsc_code]&br=$result[branch_name]'><i class='fas fa-user-edit'>Update</i></a></td>
        </tr>
        ";
      }
    }
      ?>
    </tr>
  </table>
  <br><button class="normlink" onclick="javascript:window.print();"><i class="fas fa-print">Print</i></button>
 <!-- <br><a class="normlink" href='display.php'>All students...</a>
  <br><a class="normlink" href='sortdisplay.php'>Sorted table...</a>
  <br><a class="normlink" href='sbdisplay.php'>State board students...</a>
  <br><a class="normlink" href='cbsedisplay.php'>CBSE students...</a>
  <br><a class="normlink" href='cutdisplay.php'>Students who got a cutoff of 100 and above...</a>
  <br><a class="normlink" href='cshdisplay.php'>Students whose name has a pattern 'sh'...</a> -->
</body>
</html>