<?php
session_start();
require_once './dbconnection/databaseConnection.php';
if(!empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['login']) ){
    $host = "ldap://uon.com";
    $ldap = ldap_connect($host);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $uonldaprdn = 'uon' . "\\" . $username;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = @ldap_bind($ldap, $uonldaprdn, $password);

    if ($bind) {
        echo "SuccessFully logded in";
        // $dn = "OU=student,DC=uon,DC=com";
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=UON,dc=COM",$filter);
        $results = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$results["count"]; $i++)
        {
            if($results['count'] > 1)
                break;
            $userDn = $results[$i]["distinguishedname"][0];
            $ou = explode('=', $userDn);
            $users_ou=$ou['2'];
            $user_ou = explode(",", $users_ou);
            echo $user_ou[0]; 
          $session_user_name= $_POST['username'];
if ( $user_ou[0] == "teacher" ) {
$_SESSION['login']='true';
$session_role= "teacher";
    echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");
}elseif ( $user_ou[0] == "year1student") {
	$_SESSION['login']='true';
$session_role= "student";
$session_year= "1";
   echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");
}elseif ( $user_ou[0] == "year2student" ) {
$_SESSION['login']='true';
$session_role= "student";
$session_year= "2";
       echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");

}elseif ($users_ou[0] == "year3student") {
$_SESSION['login']='true';
$session_role= "student";
$session_year= "3";
echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");
}elseif ($users_ou[0] == "admin") {
	$_SESSION['login']='true';
	$session_role= "admin";
	echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");
}

        }
        @ldap_close($ldap);
    } else {
           echo "<script>alert('Invalid Username or password')</script>";

    }

}
?>

<!-- <?php 
session_start();
	require_once './dbconnection/databaseConnection.php';
if (isset($_POST['login'])) {
$username= $_POST['username'];
$password= $_POST['password'];
$session_year="";
$usernameCheck = $pdo -> prepare('SELECT * FROM users WHERE username =:Username');
$userName = [':Username' => $_POST['username']];
$usernameCheck -> execute($userName);
$users = $usernameCheck->fetch(PDO::FETCH_ASSOC);
$session_user_name= $users['username'];
$session_role= $users['user_role'];
$session_year= $users['year'];
if ($users <= 0) {
	echo '<script>alert("Username Does Not exit")</script>';
}
if (password_verify($_POST['password'], $users['user_password'])) {
      $_SESSION['user_name']=$session_user_name;
      $_SESSION['role']=$session_role;
      $_SESSION['year']=$session_year;
      $_SESSION['login']='true';
        echo "<script>alert('Successfully Login!!!Wellcome to Nile');</script>";
		    header("Location:index.php");	       
}else{
	echo '<script>alert("Password not Matched")</script>';
	die();
}
}
 ?> -->