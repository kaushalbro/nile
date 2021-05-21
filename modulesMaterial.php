<?php 
require_once './authentication/authentication.php'; 
// require_once 'databaseConnection.php';

// --------------------------DELETE FILES------------------------------------
if (!isset($_SESSION['login'])) {
    header("Location:login-form.php");
}
$modu_name=$_GET['Moduel'];
if (isset($_GET['del']) && isset($_GET['fileName']) ) {
	$id=$_GET['del'];
$fil_name='files/'.$_GET['fileName'];
$deleteFIle = $pdo -> prepare('DELETE FROM files WHERE file_id =:id LIMIT 1');
$criteria = ['id' => $id];
$deleteFIle -> execute($criteria);
unlink($fil_name);
header('Location:studentMaterial.php');

}

// --------------------------DELETE FILES------------------------------------


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

  <!-- -------------------------------------------------PHP---------------------------------------------------- -->
            <?php 
if ( !isset($_SESSION['login']) ) {
   require_once './authentication/authentication.php'; 

  echo '<li class="nav-link"><a href="login-form.php">Login</a></li>';
}else{
  echo '<li class="nav-link"><a href="logout.php">LOGOUT</a></li>'."Name:".$_SESSION['user_name']." Role:".$_SESSION['role'];

} ?>
    <!-- -------------------------------------------------PHP---------------------------------------------------- -->
           
      </ul> 
    </div>
</nav><!--nav end-->
</div><!--banner end-->



<div class="content">

     <div class="m-box1">
     <h4>NILE(northampton integrated learning enviroment)</h4>

     <h3>MODULES</h3>
  <!-- -------------------------------------------------PHP---------------------------------------------------- -->


     <?php 
if (!$_SESSION['role'] == "admin") {
    echo  ' <p class="m-1"><a href="#">MODULE MATERIAL</a></p>';
}
      ?>
    <?php 
if ($_SESSION['role']=='teacher' && $_SESSION['login']=='true' ) {
 $query = $pdo -> prepare (" SELECT * FROM table_materials WHERE teacher_name=:tec_name ");
    $query->execute([':tec_name' => $_SESSION['user_name']]);
    while ($module_details = $query->fetch(PDO::FETCH_ASSOC)) {
       $mod_name=$module_details['module_name'];
       $mod_code=$module_details['module_code'];
   ?>
             <p class="m-1"><a href="modulesMaterial.php?Moduel=<?php echo $mod_code; ?>"><?php echo $mod_code ." : ". $mod_name ; ?></a></p>
 <?php 
  }
}elseif ($_SESSION['role']=='student' && $_SESSION['login']=='true') {
$query = $pdo -> prepare (" SELECT * FROM table_materials WHERE year=:st_year ");
    $query->execute([':st_year' => $_SESSION['year']]);
    while ($module_details = $query->fetch(PDO::FETCH_ASSOC)) {
       $mod_name=$module_details['module_name'];
       $mod_code=$module_details['module_code'];
       $mod_teacher=$module_details['teacher_name'];
?>
<p class="m-1"><a href="modulesMaterial.php?Moduel=<?php echo $mod_code; ?>"><?php echo $mod_code ." : ". $mod_name ; ?></a></p>
  <?php    
}
}
 ?>
  <!-- -------------------------------------------------PHP---------------------------------------------------- -->

     <p class="m-2"><a href="index.php?timetable=true">TIMETABLE</a></p>
     <p class="m-2"><a href="#">ANNOUNCEMENT</a></p>
     <p class="m-2"><a href="#">LIBRARY</a></p>
     
     </div>
<!-- ----------------------------------------------for right Side---------------------------- -->
   <div class="m-box2">
             <h3>MODULES</h3><br>  
<?php 
if ($_SESSION['role'] == "student") {
    echo  '<h3>YEAR:: ' .$_SESSION['year'].'</h3><br>';
}

 $module=$_GET['Moduel'];
echo "<H2>".$module."</H2>";

  ?>
        
<!-- if login as teacher's account -->
<!-- -----------------------------------------------if Login in as teacher starts------------------------------------- -->

<?php 
if ($_SESSION['role']=='teacher' && $_SESSION['login']=='true' ) {
    $query = $pdo -> prepare (" SELECT * FROM table_materials WHERE teacher_name=:tec_name AND module_code=:mod_code ");
    $query->execute(
   [
   	':tec_name' => $_SESSION['user_name'],
   	':mod_code' => $module
   ]
);
    while ($module_details = $query->fetch(PDO::FETCH_ASSOC)) {
       
       $mod_name=$module_details['module_name'];
       $mod_code=$module_details['module_code'];
       // $mod_teacher=$module_details['teacher_name'];
         
?>
             <p class="m-1"><a href="modulesMaterial.php?Moduel=<?php echo $mod_code; ?>"><?php echo $mod_code ." : ". $mod_name ; ?></a></p>

<?php
    }//while close

if (isset($_POST['uploadFiles'])) {
	
$year=$_POST['year'];	
$file = $_FILES['the_file']['name'];
// echo $year;
if (empty($file = $_FILES['the_file']['name'])) {
echo "<script>alert('Cannot upload .exe or .bat and empty files')</script>";
	
}else{

$exten = pathinfo($file, PATHINFO_EXTENSION);
if ($exten=="exe" || $exten=="bat" ) {
echo "<script>alert('Cannot upload .exe or .bat  files')</script>";
}else{

$file_temp = $_FILES['the_file']['tmp_name'];
move_uploaded_file("{$file_temp}", "./files/{$file}");

$insert_into_files = "INSERT INTO files (file_name, file_for_module, file_for_year, uploaded_by) VALUES (:fileName,:module, :year, :by)";
    $stmt5 = $pdo->prepare($insert_into_files);
    $stmt5->execute([
     ':fileName'=> $file,
     ':module'=> $module,
     ':year'=>$year,
     ':by'=>$_SESSION['user_name'],
     
    ]);
echo "<script>alert('successfully Uploaded')</script>";

}
}
} ?>
  <!-- -------------------------------------------------PHP---------------------------------------------------- -->

<form action="modulesMaterial.php?Moduel=<?php echo $module; ?>" method="post" enctype="multipart/form-data">
        Upload material for <?php echo $module; ?> here:
        <input type="file" name="the_file" >
        <select name="year"> 
<option value="1">YEAR 1</option>
<option value="2">YEAR 2</option>
<option value="3">YEAR 3</option>

</select>
        <input type="submit" name="uploadFiles" value="UPLOAD FILE">
    </form>

<h3>Files uploaded by <?php echo $_SESSION['user_name']." For Moduel " . $module; ?></h3>
<table style="width:100%" align="center">
			<tr>
			<th>File Name</th>
			<th>Module Name</th>
			<th>Uploaded for year</th>
			<th>Delete</th>
			</tr>
<!-- -------------------------------------------------PHP---------------------------------------------------- -->

<?php
 $get_files = "SELECT * FROM files WHERE file_for_module= :mod AND uploaded_by= :up_by ";
		$get_f = $pdo -> prepare($get_files);
		$get_f->execute(
			[
				':mod' => $module,
				':up_by' => $_SESSION['user_name'],
			]

		);
		while ($up_files = $get_f->fetch(PDO::FETCH_ASSOC)) {
		$file_name= $up_files['file_name'];
		$module_name= $up_files['file_for_module'];
		$for_year= $up_files['file_for_year'];
		$id= $up_files['file_id'];

		?>
      <tr>
		<td><a href="files/<?php echo $file_name ?>"><h4><?php echo $file_name; ?> </h4></a></td>
		<td><?php echo $module_name ?></td>
		<td><?php echo $for_year ?></td>			
		<td><a href="modulesMaterial.php?del=<?php echo $id ?>&fileName=<?php echo $file_name ?>">Delete</a></td>			
      </tr>


<?php }
}//if close
  ?>
    <!-- -------------------------------------------------PHP---------------------------------------------------- -->

</table>
<!-- -----------------------------------------------if Login in as teacher End------------------------------------- -->

<!-- -----------------------------------------------if Login in as Student Starts------------------------------------- -->

<?php 
if ($_SESSION['role']=='student' && $_SESSION['login']=='true' ) {
?> 
<table style="width:100%" align="center">
			<tr>
			<th>File Name</th>
			<th>Module Name</th>
			<th>Uploaded for year</th>
			</tr>

<?php
 $get_files = "SELECT * FROM files WHERE file_for_module= :mod AND file_for_year= :yrs ";
		$get_f = $pdo -> prepare($get_files);
		$get_f->execute(
			[
				':mod' => $_GET['Moduel'],
				':yrs' => $_SESSION['year'],
			]
		);
		while ($up_files = $get_f->fetch(PDO::FETCH_ASSOC)) {
		$file_name= $up_files['file_name'];
		$module_name= $up_files['file_for_module'];
		$for_year= $up_files['file_for_year'];
		?>

      <tr>
		<td><a href="files/<?php echo $file_name ?>"><h4><?php echo $file_name; ?> </h4></a> </td>
		<td><?php echo $module_name ?></td>
		<td><?php echo $for_year ?></td>			
      </tr>

<?php
}
}//if close
  ?>
    <!-- -------------------------------------------------PHP---------------------------------------------------- -->

</table>
<!-- -----------------------------------------------if Login in as Student End------------------------------------- -->

         </div>

</div>
<div class="footer">    
    <div class="copyright">
        <p> &copy; 2021, All Rights Reserved and develop by network group, NILE.com</p>
    </div>
</div><!-- footer end -->

</body>

</html>