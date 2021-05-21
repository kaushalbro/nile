<?php
require_once './authentication/authentication.php'; 
// require_once 'databaseConnection.php'; 
if (isset($_SESSION['login'])) {
  echo '<script>alert("Already logged in!!First logout and Login ")</script>';
    header("Location:index.php");
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

<div class="loin-container">
  <div class="main_login_container">
       <form action="login-form.php" method="POST">

    <label for="username"><b>Username</b></label>
    
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <input type="submit" name="login" value="Log In"> 
    
    <div class="btn">
    <button type="button"><a href="#">Sign up</a></button>
    </div>
    
</form>
  </div>

  <div class="boxes">

    <div class="box1">
      <h4>change maker resources center</h4>
      <p><a href="#">A changemaker gives themselves the permission to do something about a social problem</a>.</p>
    </div>

    <div class="box2">
      <h4>login problems? new NILE user?</h4>
      <h6>New to nile ?</h6>
      <p>if you are new to nile click here for a <a href="#">quick guide</a>.</p>
      <h6>New to nile ?</h6>
      <p>please first try to <a href="#">reset or generate a new Password</a>. if your password is expried, you will stillbe able to login to the user portal to reset yourself.</p>

    </div>

  </div>

</div>



<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>