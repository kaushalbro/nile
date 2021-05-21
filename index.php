<?php 
require_once './authentication/authentication.php'; 
// require_once 'databaseConnection.php';
        // else{
if ( isset($_SESSION['role'])&& $_SESSION['role'] == "admin" ) {
  header("Location:AdminIndex.php");
}
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/singel.css">

</head>
<body>
<div class="banner">

    <div class="header">
            <div class="logo">
              <img src="images/logo.jpg">
            </div><!--logo end-->

  </div><!--header end-->

  <nav class="nav">
    <div class="navbar-header">
      <ul class="nav">
           
            <li class="nav-link"><a href="index.php">Home</a></li>
            <li class="nav-link"><a href="#">Courses</a></li>
            <li class="nav-link"><a href="studentMaterial.php">Moduels</a></li>
            <li class="nav-link"><a href="#">News</a></li>
            <li class="nav-link"><a href="#">People</a></li>
            <?php 

if ( !isset($_SESSION['login']) ) {
   
  echo '<li class="nav-link"><a href="login-form.php">Login</a></li>';
 // header("Location:index.php");
}else{
  echo '<li class="nav-link"><a href="logout.php">LOGOUT</a></li>'."Name:".$_SESSION['user_name']." Role:".$_SESSION['role'];

}
             

             ?>
             
      </ul> 
    </div>
</nav><!--nav end-->
</div><!--banner end-->



<div class="content">
          <div class="m-box1">
     <h4>NILE(northampton integrated learning enviroment)</h4>
   <?php 

      ?>
     <!-- <p class="m-1"><a href="studentMaterial.php">MODULE MATERIAL</a></p> -->
     <p class="m-2"><a href="index.php?timetable=true">TIMETABLE</a></p>
     <p class="m-2"><a href="#">LIBRARY</a></p>
     
     </div>

     <div class="m-box2">
<?php 

if (isset($_GET['timetable'])) {
      ?>
<img src="timetable.png" height="100%" width="100%">



  
  <?php 
}else{

echo "
 <h1>Announcement</h1>
            <p>Hawassa University New Announcement 2021/2022; See details on Hawassa University New Announcement 2021/2022 For current news and announcements visit our official website but for inquiries regarding academics, kindly contact our help lines for further assistance. Hawassa University New Announcement 2021/2022; See details on Hawassa University New Announcement 2021/2022 For current news and announcements visit our official website but for inquiries regarding academics, kindly contact our help lines for further assistance.Hawassa University New Announcement 2021/2022; See details on Hawassa University New Announcement 2021/2022 For current news and announcements visit our official website but for inquiries regarding academics, kindly contact our help lines for further assistance.</p>


";
}
 ?>
           
     </div>


</div><!--content end-->





<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>