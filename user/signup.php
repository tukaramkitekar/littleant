<?php
include '../database/dbconnect.php';
if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mob = mysqli_real_escape_string($conn, $_POST['mob']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));


$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'uploaded_img/'.$image;
$select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
if(mysqli_num_rows($select) > 0){
   $message[] = 'user already exist'; }
   else{
if($pass != $cpass){
   $message[] = 'confirm password not matched!';}
   elseif($image_size > 2000000){
          $message[] = 'image size is too large!';}
   else{
        $insert = mysqli_query($conn, "INSERT INTO `users`(name, email, mob, dob, address, password, image) VALUES('$name', '$email', '$mob', '$dob', '$address', '$pass', '$image')") or die('query failed');
if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:signin.php');}
   else{
            $message[] = 'registeration failed!';}
}
}
}
?>



<!DOCTYPE html>
<html lang="en">
<Head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <title>Newtry</title>
    <style>
          *{margin:0; padding:0;}
          nav{background:black; height:65px; width:100%;}
          .form-container{width:350px; height:650px; background:blue; margin-inline:500px;}
          .formdiv1{width:350px; height:50px; background:blue;}
          .formdiv2{width:350px; height:600px; background:linear-gradient(orange,green); border-top-left-radius:15px; border-top-right-radius:15px;}
    </style>
</Head>


<Body>
<Header>
<nav>
    <center><img src="../assets/logo.png" width="100px" style="margin-top:4px;"></center>
</nav>
</Header>

<Main>
<h1 style="margin-inline:10px; margin-top:10px"><i class="fa-solid fa-arrow-left"></i></h1>
<br><br>
<div class="form-container">
<form action="" method="post" enctype="multipart/form-data">
   <div class="formdiv1">
   <h1 align="center" style="color:white; font-family:cursive">Create An Account</h1>
</div>
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<div class="message">'.$message.'</div>';
      }
   }
   ?>
<div class="formdiv2">
<br><Br>
   <center>
      
   <input type="text" name="name" placeholder="enter username" class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
   <input type="email" name="email" placeholder="enter email" class="box" required style="width:235px; height:35px; outline:none; border-color:black;" ><br><br>
   <input type="number" name="mob" placeholder="enter mobile" class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
   <input type="text" name="dob" placeholder="enter dob" class="box" style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
   <input type="text" name="address" placeholder="enter address" class="box" style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
   <input type="password" name="password" placeholder="enter password" class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
   <input type="password" name="cpassword" placeholder="confirm password" class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
  <h1 > <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"></h1><br><br>

   <input type="submit" name="submit" value="register now" class="btn" style="width:130px; height:35px; border-radius:20px; font-size:20px;">
</center>
<br>
   <p style="font-family:cursive; color:white; margin-inline:10px;">already have an account? <a href="signin.php" style="color:white">login now</a></p>
</div>
</form>
</div>
</Main>
<br><br><br>
</Body>
</HTML>