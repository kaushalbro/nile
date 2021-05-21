<?php 
require_once './authentication/authentication.php'; 
// require_once 'databaseConnection.php';
if (!isset($_SESSION['login'])) {
    header("Location:login-form.php");
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
   require_once './authentication/authentication.php'; 

  echo '<li class="nav-link"><a href="login-form.php">Login</a></li>';
}else{
  echo '<li class="nav-link"><a href="logout.php">LOGOUT</a></li>'."Name:".$_SESSION['user_name']." Role:".$_SESSION['role'];

} ?>
             
      </ul> 
    </div>
</nav><!--nav end-->
</div><!--banner end-->



<div class="content">
     <div class="m-box1">
     <h4>NILE(northampton integrated learning enviroment)</h4>

     <h3>MODULES</h3>


     <?php 
if (!$_SESSION['role'] == "admin") {
    echo  ' <p class="m-1"><a href="#">MODULE MATERIAL</a></p>';
}
      ?>
    
     <p class="m-2"><a href="index.php?timetable=true">TIMETABLE</a></p>
     <p class="m-2"><a href="#">ANNOUNCEMENT</a></p>
     <p class="m-2"><a href="#">LIBRARY</a></p>
     
     </div>
   <div class="m-box2">
             <h3>MODULES</h3><br>  


<?php 
if ($_SESSION['role'] == "student") {
    echo  '<h3>YEAR' .$_SESSION['year'].'</h3><br>';
}

if ($_SESSION['role']=='student' && $_SESSION['login']=='true' ) {

    $query = $pdo -> prepare (" SELECT * FROM table_materials WHERE year=:st_year ");
    $query->execute([':st_year' => $_SESSION['year']]);
    while ($module_details = $query->fetch(PDO::FETCH_ASSOC)) {
       
       $mod_name=$module_details['module_name'];
       $mod_code=$module_details['module_code'];
       $mod_teacher=$module_details['teacher_name'];
         
?>
             <p class="m-1"><a href="modulesMaterial.php?Moduel=<?php echo $mod_code; ?>"><?php echo $mod_code ." : ". $mod_name  .":   Teacher Name: ". $mod_teacher; ?></a></p>

<?php
    }//while close
}//if close
  ?>
        
<!-- if login as teacher'sccount -->
<?php 
if ($_SESSION['role']=='teacher' && $_SESSION['login']=='true' ) {
 
    $query = $pdo -> prepare (" SELECT * FROM table_materials WHERE teacher_name=:tec_name ");
    $query->execute([':tec_name' => $_SESSION['user_name']]);
    while ($module_details = $query->fetch(PDO::FETCH_ASSOC)) {
       
       $mod_name=$module_details['module_name'];
       $mod_code=$module_details['module_code'];
       // $mod_teacher=$module_details['teacher_name'];
         
?>
             <p class="m-1"><a href="modulesMaterial.php?Moduel=<?php echo $mod_code; ?>"><?php echo $mod_code ." : ". $mod_name ; ?></a></p>

<?php
    }//while close
}//if close
  ?>

         </div>



</div>


<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>