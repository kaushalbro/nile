<?php 
require_once './authentication/authentication.php'; 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="./css/singel.css">

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
            <li class="nav-link"><a href="addUsers.php?addUser=admin">Add Administrator</a></li>
            <li class="nav-link"><a href="addUsers.php?addUser=staff">Add Staff</a></li>
            <li class="nav-link"><a href="addUsers.php?addUser=student">Add Student</a></li>
            <li class="nav-link"><a href="#">Delete Users</a></li>
            <?php 

if ( !isset($_SESSION['login']) ) {
   
  echo '<li class="nav-link"><a href="login-form.php">Login</a></li>';
 // header("Location:index.php");
}else{
  echo '<li class="nav-link"><a href="logout.php">LOGOUT</a></li>'."<br>Name:".$_SESSION['user_name']." Role:".$_SESSION['role'];

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

            <h1>Wellcome To Admin Area</h1>
            <p> This is an admin section here admin can login and Add user   </p>
     </div>


</div><!--content end-->





<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>