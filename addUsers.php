<?php 
require_once './authentication/authentication.php'; 
if (isset($_POST['add'])) {
$username= trim($_POST['username']);
$email= trim($_POST['email']);
$password= password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
// $password= trim($_POST['password']);
$user_role= $_POST['userRole'];
if ( $_GET['addUser'] =="student") {
$year= $_POST['year'];
}else{
  $_POST['year']= "";
  $year= $_POST['year'];

}
if (!empty($username) && !empty($email) && !empty($password) ) {
$checkUser = $pdo -> prepare('SELECT * FROM users WHERE username =:User LIMIT 1');
$criteria = ['User' => $_POST['username']];
$checkUser -> execute($criteria);
$result = $checkUser->fetch();

if ($result > 0) {
  echo '<script>alert("User Already Exit!!!Can not insert Use another username")</script>';
}else{

$_POST['password'] = password_hash($password,PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users(username,user_password,user_email,year,user_role) VALUES(:username,:password,:email,:years,:user_role)');
$criteria = [
  'username' => $username, 
  'email' => $email,
  'password' => $password,
  'years' => $year,
  'user_role' => $user_role
];

if ($stmt -> execute($criteria)) {
      echo "<script>alert('Successfully register!!! Click OK for login');</script>";
      // header("Location:login.php");
} 
}

}else{
echo '<script>alert("Any field canot be empty")</script>';
}
}


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
            <li class="nav-link"><a href="deleteUser.php?">Delete Users</a></li>
            <?php 

if ( !isset($_SESSION['login']) ) {
   
  echo '<li class="nav-link"><a href="login-form.php">Login</a></li>';
 // header("Location:index.php");
}else{
  echo '<li class="nav-link"><a href="logout.php">LOGOUT</a></li>'."<br>Name:".$_SESSION['user_name']." Role:".$_SESSION['role'];

} ?>
             
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
if ( isset($_GET['addUser']) ) {
 echo ' <h1>Wellcome To Admin Area</h1>';
 echo ' <h1>Create New '.$_GET['addUser'] .' Account Here</h1>';
}

 ?>
    
    <form action="addUsers.php?addUser=<?php echo $_GET['addUser'] ?>" method="post">


      <label><H2>UserName:</H2></label>
      <input type="text" name="username" >
      <label><H2>Email:</H2></label>
      <input type="email" name="email">


 <label><H2>Select User Role:</H2></label>
       <select name="userRole" style="padding: 10px">
        
 <?php 
if ( $_GET['addUser'] =="student" ) {
 ?>
 <option value="student">Student</option>
<?php 
}elseif ( $_GET['addUser'] =="admin" ) {
?>
         <option value="admin">Admin</option>

<?php
}else{
  ?>
         <option value="staff">Staff</option>

  <?php
}
?>

            </select>

      




<?php 
if ( $_GET['addUser'] =="student" ) {

 ?>
    <label><H2>Select Student Year:</H2></label>
<select name="year" style="padding: 10px">
         <option value="1">YEAR 1 STUDENT</option>
         <option value="2">YEAR 2 STUDENT</option>
         <option value="3">YEAR 3 STUDENT</option>
       </select>

<?php 

}
 ?>
      <label><H2>Password:</H2></label>
      <input type="password" name="password">
  <input type="submit" name="add" value="Add User">
<!-- <button type="submit" name="add">Add User</button> -->
    </form>

     </div>


</div><!--content end-->





<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>