<?php 

session_start();
// ob_start();
if (isset($_SESSION['login'])) {
     session_destroy();//session willl destroyed
   unset($_SESSION['user_name']);
   unset($_SESSION['role']);
   unset($_SESSION['year']);
   unset($_SESSION['login']);

 header("Location:index.php");

}

 ?>