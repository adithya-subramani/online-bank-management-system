
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
      <li style="float:right"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
      <li title="Your account balance" class="acc_bal" style="float:right">
      <a href="depo.php"><i class="fas fa-wallet"></i> Account balance: &#8377 <?php echo $row1['balance']?> /-</a></li>
    </ul>
    </div>
    <marquee class="marq" width="60%" direction="right" height="150px"><i class="fas fa-info-circle"></i>
    Welcome back <b><?php echo $username ?></b>.
    </marquee>
    

	<div id="container" class="cont">
		<div id="chat" class="chat">
			<div id="messages" class="messages"></div>
            <input id="input" type="text" placeholder="Say something..." autocomplete="off" autofocus="true" />
		</div>
<button class="bot-btn" onclick="disp()"></button>
	</div>
  <div class="sldshow">
  <div class="slideshow-container">

<div class="mySlides fade">
  <img src="img/card.jpeg" style="width:100%">
  <!--<div class="text">Caption Text</div>-->
</div>

<div class="mySlides fade">
  <img src="img/graph.jpeg" style="width:55%">
</div>

<div class="mySlides fade">
  <img src="img/save.jpeg" style="width:80%">
</div>
</div>
<br>

<div class="dashrd" style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
</div>
<div class="dashupd">
<h1><i class="fas fa-bullhorn"></i>UPDATES!</h1>
<ul><li>Users will get their Credit/Debit card anytime soon..</li>
<li>Users are requested to contact the admin to update any of their details.</li>
<li>Users are requested to avoid visiting the bank in person</li></ul>
</div>
    <script>
      var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
        var click= 0;
function disp(){
if(click%2==0){
  document.getElementById("chat").style.visibility="visible";
  click+=1;
}
else{
  document.getElementById("chat").style.visibility="hidden";
  click+=1;
}
}
    </script>
    <script src="index.js" ></script>
    <script src="constants.js" ></script>
    <script src="speech.js" ></script>
    </body>
    </html>
<?php
}
else{
    header("Location: login.php");
}

?>

